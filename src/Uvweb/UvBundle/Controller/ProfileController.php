<?php

namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Uvweb\UvBundle\Entity\User;
use Uvweb\UvBundle\Form\UserType;
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
            'comments' => $comments
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
                    $this->grandUserRole($user);

                    //One more connection for the user
                    $user->setConnections($user->getConnections() + 1);
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

        $user = new User();

        //Generate for from Symfony2 forms
        $form = $this->createForm(new UserType, $user);

        $request = $this->getRequest();

        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid()) 
            {
                $user->setLogin($session->get('newUserLogin'));
                $user->setPassword('1234');
                $user->setIsadmin(0);
                $user->setConnections(1);
                $user->setFirstSemester($user->getFirstSemester() . ($user->getFirstYear() % 100));

                try
                {
                    $manager->persist($user);
                    $manager->flush();
                }
                catch(\Exception $e)
                {
                    //Insertion failed: invite the user to try again, displaying the errors
                    return $this->render('UvwebUvBundle:Profile:user_form.html.twig', array(
                        'login' => $session->get('newUserLogin'),
                        'add_user_form' => $this->createForm(new UserType, new User())
                    ));                
                }

                //Correctly inserted into the DB
                $session->remove('newUserLogin'); //No longer usefull

                //Auto authentication
                $this->grandUserRole($user);

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


    /* ====== Private functions                                                                         ======= */

    private function grandUserRole(\Uvweb\UvBundle\Entity\User $user)
    {
        $token;

        if($user->getIsadmin())    
            $token = new UsernamePasswordToken($user, null, 'main', array('ROLE_ADMIN')); //Use the symfony2 security system to protect the whole admin controller with a firewall
        else
            $token = new UsernamePasswordToken($user, null, 'main', array('ROLE_USER'));  //User is not admin: USER_ROLE

        $this->container->get('security.context')->setToken($token);

        $this->getRequest()->getSession()->set('_security_main',  serialize($token));
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