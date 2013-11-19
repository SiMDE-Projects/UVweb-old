<?php

namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Uvweb\UvBundle\Entity\User;
use Uvweb\UvBundle\Form\UserType;
use Uvweb\UvBundle\Form\UserEditType;
use Uvweb\UvBundle\Form\MigrationType;
use \SimpleXMLElement;
use \Httpful\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ProfileController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function displayAction($userid)
    {
        /** those lines allow redirection after submitting search bar form */
        if ($redirect = $this->initSearchBar()) 
        {
            return $redirect;
        }

        $manager = $this->getDoctrine()->getManager();
        $userRepository = $manager->getRepository("UvwebUvBundle:User");
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');

        $user = $userRepository->find($userid);
        if ($user == null) throw $this->createNotFoundException("Cet utilisateur n'existe pas ou plus");

        $comments = $commentRepository->findBy(
            array('author' => $user, 'moderated' => true),
            array('date' => 'desc'),
            20,
            0);

        return $this->render("UvwebUvBundle:Profile:profile.html.twig", array(
            'searchbar' => $this->searchBarForm->createView(),
            'user' => $user,
            'comments' => $comments,
            'userView' => true
        ));
    }

    public function loginAction()
    {
        $session = $this->getRequest()->getSession();

        $loginUrl = $this->generateUrl('uvweb_login', array(), true); //Absolute url to this controller action

        if($currentUser = $this->getUser() === null)
        {
            //User not connected: he has to connect through the UTC CAS
            if($ticket = $this->getRequest()->query->get('ticket'))
            {
                //The login controller was called after the CAS registration
                try
                {
                   $userLogin = $this->checkCASReturn($ticket, $loginUrl); //username used by UTC students on CAS
                }
                catch(\UnexpectedValueException $e)
                {
                    return new Response($e->getMessage());
                }

                $manager = $this->getDoctrine()->getManager();
                $userRepository = $manager->getRepository("UvwebUvBundle:User");

                $user = $userRepository->findOneByLogin($userLogin);

                if ($user == null)
                {
                    //No user with this login from UTC exists in UVWeb: show him the new user form

                    $session = $this->getRequest()->getSession();
                    $session->set('newUserLogin', $userLogin); //Will be used to register the new user

                    return $this->redirect($this->generateUrl('uvweb_user_add'));
                }
                else
                {
                    $this->grantUserRole($user);

                    //One more connection for the user
                    $user->setConnections($user->getConnections() + 1);
                    $user->setLast(new \Datetime());
                    $manager->persist($user);
                    $manager->flush();

                    return $this->redirect($this->generateUrl('uvweb_uv_homepage'));
                }
            }
            else 
                //The user has to register on the UTC CAS
                return $this->redirect($this->container->getParameter('cas_login_url') . '?service=' . $loginUrl);
        }
        else
        {
            //No need to log again
            return $this->redirect($this->generateUrl('uvweb_uv_homepage'));
        }
    }

    public function addUserAction()
    {
        //Should not be accessible if the user did not register on the UTC CAS or if he is already registered on UVweb
        $session = $this->getRequest()->getSession();

        if($this->getUser() !== null)
            return $this->redirect($this->generateUrl('uvweb_uv_homepage'));

        if($session->get('newUserLogin') === null)
            return $this->redirect($this->generateUrl('uvweb_uv_homepage'));

        $manager = $this->getDoctrine()->getManager();
        $userRepository = $manager->getRepository("UvwebUvBundle:User");

        $user;

        if($session->get('previousUVWebUser') !== null)
        {
            //The user had an account on UVweb: he is already in the DB
            $user = $userRepository->findOneByLogin($session->get('previousUVWebUser'));
            $user->setIdentity($user->getLogin());
        }
        else
            $user = new User();

        //Generate form from Symfony2 forms
        $form = $this->createForm(new UserType, $user);

        $request = $this->getRequest();

        if ($request->isMethod('POST'))
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
                if($session->get('previousUVWebUser') === null) //New user: never used UVWeb1
                {
                    $user->setIsAdmin(false);
                    $user->setConnections(1);
                }
                else //Previous UVWeb1 user
                {
                    $user->setIsAdmin($userRepository->findOneByLogin($session->get('previousUVWebUser'))->getIsAdmin()); //Make sure that only a previous admin will be admin
                    $user->setConnections($user->getConnections() + 1);
                }

                $user->setLogin($session->get('newUserLogin'));
                $user->setPassword(null);
                $user->setLast(new \Datetime());

                $user->setFirstSemester($user->getFirstSemester());

                try
                {
                    $manager->persist($user);
                    $manager->flush();
                }
                catch(\Exception $e)
                {
                    $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de l'ajout du compte.");

                    //Insertion failed: invite the user to try again, displaying the errors
                    return $this->render('UvwebUvBundle:Profile:user_form.html.twig', array(
                        'login' => $session->get('newUserLogin'),
                        'add_user_form' => $this->createForm(new UserType, new User())->createView()
                    ));                
                }

                //Correctly inserted into the DB
                $session->remove('newUserLogin'); //No longer useful

                if($session->get('previousUVWebUser') !== null)
                    $session->remove('previousUVWebUser');

                //Auto authentication
                $this->grantUserRole($user);

                return $this->render('UvwebUvBundle:Profile:user_added.html.twig', array(
                    'user' => $user
                ));
            }
        }

        return $this->render('UvwebUvBundle:Profile:user_form.html.twig', array(
            'login' => $session->get('newUserLogin'),
            'add_user_form' => $form->createView()
        ));
    }

    public function editUserAction($userid)
    {
        if($this->getUser()->getId() != $userid)
        {
            $this->container->get('uvweb_uv.fbmanager')->addFlashMessage("Vous n'êtes pas autorisé à modifier le profil des autres utilisateurs.");
            return $this->redirect($this->generateUrl('uvweb_uv_homepage'));
        }

        $manager = $this->getDoctrine()->getManager();
        $userRepository = $manager->getRepository("UvwebUvBundle:User");

        $user = $userRepository->findOneById($this->getUser()->getId());

        //Generate form from Symfony2 forms
        $form = $this->createForm(new UserEditType, $user);

        $request = $this->getRequest();

        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
                try
                {
                    $manager->persist($user);
                    $manager->flush();
                }
                catch(\Exception $e)
                {
                    $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite la modification du compte.");

                    //Insertion failed: invite the user to try again, displaying the errors
                    return $this->render('UvwebUvBundle:Profile:user_edit.html.twig', array(
                        'edit_user_form' => $this->createForm(new UserEditType, $user)->createView()
                    ));
                }

                //Correctly updated: change the current user in session, and display a confirmation message to the user
                $this->grantUserRole($user);
                $this->get('uvweb_uv.fbmanager')->addFlashMessage('Profil mis à jour avec succès !', 'success');

                return $this->redirect($this->generateUrl('uvweb_uv_profile', array('userid' => $this->getUser()->getId())));
            }
        }

        return $this->render('UvwebUvBundle:Profile:user_edit.html.twig', array(
            'edit_user_form' => $form->createView()
        ));
    }

    //Used to allow previous uvweb users to register on UVWeb 2.0
    public function migrationAction()
    {
        if($this->getUser() !== null)
            return $this->redirect($this->generateUrl('uvweb_uv_homepage'));

        $manager = $this->getDoctrine()->getManager();
        $userRepository = $manager->getRepository("UvwebUvBundle:User");

        $form = $this->createForm(new MigrationType);

        $request = $this->getRequest();

        if ($request->isMethod('POST'))
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
                $formData = $form->getData();
                $user = $userRepository->findOneByLogin($formData['login']);

                if($user === null)
                    $this->container->get('uvweb_uv.fbmanager')->addFlashMessage("Les identifiants transmis ne correspondent à aucun utilisateur.");
                else
                {
                    if($user->getPassword() === md5($formData['password']))
                    {
                        $this->getRequest()->getSession()->set('previousUVWebUser', $user->getLogin()); //Will be used to register the new user
                        return $this->redirect($this->generateUrl('uvweb_login'));
                    }
                    else
                        $this->container->get('uvweb_uv.fbmanager')->addFlashMessage("Les identifiants transmis ne correspondent à aucun utilisateur.");
                }

            }
        }

        return $this->render('UvwebUvBundle:Profile:migration.html.twig', array('form_migration' => $form->createView()));
    }

    /* ====== Private functions                                                                         ======= */

    private function grantUserRole(\Uvweb\UvBundle\Entity\User $user)
    {
        $token;

        if($user->getIsadmin())    
            $token = new UsernamePasswordToken($user, null, 'main', array('ROLE_ADMIN')); //Use the symfony2 security system to protect the whole admin controller with a firewall
        else
            $token = new UsernamePasswordToken($user, null, 'main', array('ROLE_USER'));  //User is not admin: USER_ROLE

        $this->container->get('security.context')->setToken($token);

        $this->getRequest()->getSession()->set('_security_main', serialize($token));
    }

    /* ====== Private helpers to manage CAS connection. Not in a service as it will only be used here. ======= */

    // Thank you, Payutc for the XML parsing, simple but efficient code ! 
    private function checkCASReturn($ticket, $service)
    {
        //Create a request to the CAS validator containing the previously returned ticket and our login controller function as the service
        $request = Request::get($this->getCASValidateUrl($ticket, $service))
          ->sendsXml()
          ->timeoutIn(10)
          ->send();

        $request->body = str_replace("\n", "", $request->body);
        try 
        {
            $xml = new SimpleXMLElement($request->body);
        }
        catch (\Exception $e) 
        {
            throw new \UnexpectedValueException("Return cannot be parsed : '{$request->body}'");
        }
        
        $namespaces = $xml->getNamespaces();
        
        $serviceResponse = $xml->children($namespaces['cas']);
        $user = $serviceResponse->authenticationSuccess->user;
        
        if ($user)
        {
            return (string)$user; // cast simplexmlelement to string
        }
        else 
        {
            $authFailed = $serviceResponse->authenticationFailure;
            if ($authFailed) 
            {
                $attributes = $authFailed->attributes();
                throw new \UnexpectedValueException($authFailed);
            }
            else 
            {
                throw new \UnexpectedValueException($request->body);
            }
        }
    }

    private function getCASValidateUrl($ticket, $service)
    {
        return $this->container->getParameter('cas_service_validate_url') . "?ticket=".urlencode($ticket)."&service=".urlencode($service);
    }
}