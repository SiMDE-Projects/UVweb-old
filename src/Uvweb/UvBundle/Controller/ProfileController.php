<?php

namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Uvweb\UvBundle\Entity\User;
use Uvweb\UvBundle\Form\UserAppPasswordType;
use Uvweb\UvBundle\Form\UserType;
use Uvweb\UvBundle\Form\UserEditType;
use Uvweb\UvBundle\Form\MigrationType;
use Uvweb\UvBundle\Form\ForgottenAccountType;
use Uvweb\UvBundle\Form\CommentType;
use \SimpleXMLElement;
use \Httpful\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Util\SecureRandom;

class ProfileController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function displayAction($userid)
    {
        $manager = $this->getDoctrine()->getManager();
        $userRepository = $manager->getRepository("UvwebUvBundle:User");
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');

        $user = $userRepository->find($userid);
        if ($user === null) throw $this->createNotFoundException("Cet utilisateur n'existe pas ou plus");

        $comments = $commentRepository->findBy(
            array('author' => $user, 'moderated' => true),
            array('id' => 'desc')
        );

        $currentUser = $this->getUser();
        $notValidatedComments = array(); //Array that might contain the current user not validated comments

        if($currentUser !== null && $currentUser->getId() == $userid)
        {
            $notValidatedComments = $commentRepository->findBy(
                array('author' => $user, 'moderated' => false),
                array('id' => 'desc')
            );
        }

        return $this->render("UvwebUvBundle:Profile:profile.html.twig", array(
            'user' => $user,
            'comments' => $comments,
            'notValidatedComments' => $notValidatedComments,
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

        if($request->isMethod('POST'))
        {
            $form->bind($request);

            if($form->isValid()) 
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
                $user->setUvwebOriginalPassword(null);
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
                        'add_user_form' => $form->createView()
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
        $userForm = $this->createForm(new UserEditType, $user);
        $userAppPasswordForm = $this->createForm(new UserAppPasswordType());

        $request = $this->getRequest();

        if ($request->isMethod('POST')) 
        {
            //Have to check if password or user form was submitted
            if($request->request->has($userForm->getName()))
            {
                $userForm->bind($request);

                if ($userForm->isValid())
                {
                    try
                    {
                        $manager->persist($user);
                        $manager->flush();
                    }
                    catch(\Exception $e)
                    {
                        $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de la modification du compte.");

                        //Insertion failed: invite the user to try again, displaying the errors
                        return $this->render('UvwebUvBundle:Profile:user_edit.html.twig', array(
                                'edit_user_form' => $userForm->createView(),
                                'user_app_password_form' => $userAppPasswordForm->createView()
                            ));
                    }

                    //Correctly updated: change the current user in session, and display a confirmation message to the user
                    $this->grantUserRole($user);
                    $this->get('uvweb_uv.fbmanager')->addFlashMessage('Profil mis à jour avec succès !', 'success');

                    return $this->redirect($this->generateUrl('uvweb_uv_profile', array('userid' => $this->getUser()->getId())));
                }
            }
            else
            {
                //User wants to change his password
                $userAppPasswordForm->bind($request);

                if ($userAppPasswordForm->isValid())
                {
                    $formData = $userAppPasswordForm->getData();

                    if($formData['password'] == $formData['password_confirmation'] && strlen($formData['password']) >= 8)
                    {
                        //New password is ok
                        $newPassword = hash('sha512', $formData['password']);
                        $user->setPassword($newPassword);

                        try
                        {
                            $manager->persist($user);
                            $manager->flush();
                        }
                        catch(\Exception $e)
                        {
                            $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de la modification du mot de passe.");

                            //Insertion failed: invite the user to try again, displaying the errors
                            return $this->render('UvwebUvBundle:Profile:user_edit.html.twig', array(
                                    'edit_user_form' => $userForm->createView(),
                                    'user_app_password_form' => $userAppPasswordForm->createView()
                                ));
                        }

                        $this->grantUserRole($user);
                        $this->get('uvweb_uv.fbmanager')->addFlashMessage('Mot de passe pour les applications mobiles modifié avec succès.', 'success');
                    }
                    else
                    {
                        $this->get('uvweb_uv.fbmanager')->addFlashMessage('Mots de passe entrés différents ou inférieurs à 8 caractères.', 'error');
                    }

                    return $this->redirect($this->generateUrl('uvweb_user_edit', array('userid' => $this->getUser()->getId())));
                }
            }
        }

        return $this->render('UvwebUvBundle:Profile:user_edit.html.twig', array(
            'edit_user_form' => $userForm->createView(),
            'user_app_password_form' => $userAppPasswordForm->createView()
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
                    if($user->getUvwebOriginalPassword() === md5($formData['password']))
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

    //Sends an email to a user who has forgotten his UVweb 1 password, so that he can register on UVweb 2.0
    public function forgottenAccountAction()
    {
        if($this->getUser() !== null)
            return $this->redirect($this->generateUrl('uvweb_uv_homepage'));

        $manager = $this->getDoctrine()->getManager();
        $userRepository = $manager->getRepository("UvwebUvBundle:User");

        $form = $this->createForm(new ForgottenAccountType);

        $request = $this->getRequest();

        if ($request->isMethod('POST'))
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $formData = $form->getData();
                $user = $userRepository->findOneByEmail($formData['email']);

                if($user === null)
                    $this->container->get('uvweb_uv.fbmanager')->addFlashMessage("L'adresse email indiquée ne correspond à aucun utilisateur.");
                else
                {
                    if($user->getUvwebOriginalPassword() !== null)
                    {
                        //UVweb 1 user

                        //Creating a new password for the user and inserting it in the DB
                        $generator = new SecureRandom();
                        $newPassword = bin2hex($generator->nextBytes(12));

                        $user->setUvwebOriginalPassword(md5($newPassword));

                        try
                        {
                            $manager->persist($user);
                            $manager->flush();
                        }
                        catch(\Exception $e)
                        {
                            $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de la requête.");

                            //Update failed: invite the user to try again, displaying the errors
                            return $this->render('UvwebUvBundle:Profile:user_edit.html.twig', array(
                                'form_forgotten_account' => $form->createView()
                            ));
                        }

                        $mailer = $this->get('mailer');

                        $message = \Swift_Message::newInstance()
                            ->setSubject('Identifiants oubliés')
                            ->setFrom('uvweb@assos.utc.fr')
                            ->setTo($user->getEmail())
                            ->setBody($this->renderView('UvwebUvBundle:Mail:password.txt.twig', array('login' => $user->getLogin(), 'password' => $newPassword)));

                        $mailer->send($message);

                        $this->container->get('uvweb_uv.fbmanager')->addFlashMessage("Un mail vient d'être envoyé à l'adresse indiquée !", 'success');

                        return $this->redirect($this->generateUrl('uvweb_migration'));
                    }
                    else
                        $this->container->get('uvweb_uv.fbmanager')->addFlashMessage("L'adresse email indiquée ne correspond à aucun utilisateur.");
                }

            }
        }

        return $this->render('UvwebUvBundle:Profile:forgotten_account.html.twig', array('form_forgotten_account' => $form->createView()));
    }

    public function editCommentAction($commentid)
    {
        $currentUser = $this->getUser();

        $manager = $this->getDoctrine()->getManager();

        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $userRepository = $manager->getRepository("UvwebUvBundle:User");

        $comment = $commentRepository->find($commentid);

        if($comment->getAuthor()->getId() !== $currentUser->getId())  //Not the author of the comment: not allowed to edit it
            return $this->redirect($this->generateUrl('uvweb_uv_homepage'));

        //Commented UV
        $uv = $comment->getUv();

        if ($uv->getArchived())
        {
            $this->get('uvweb_uv.fbmanager')->addFlashMessage("Cette UV est archivée, il est impossible de modifier un commentaire sur celle-ci.");

            return $this->redirect($this->generateUrl('uvweb_uv_profile', array('userid' => $currentUser->getId())));
        }

        $form = $this->createForm(new CommentType($uv, $this->get('uvweb_comment.commenthelper')), $comment);
        $this->createFormBuilder($comment);

        $request = $this->getRequest();

        if($request->isMethod('POST'))
        {
            $form->bind($request);

            if($form->isValid()) 
            {
                $comment->setDate(new \DateTime());
                $comment->setModerated(false);

                try
                {
                    $manager->persist($comment);
                    $manager->flush();
                }
                catch(\Exception $e)
                {
                    $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de la modification de l'avis.");

                    //Update failed: invite the user to try again, displaying the errors
                    return $this->render('UvwebUvBundle:Uv:post.html.twig', array(
                        'uv' => $uv,
                        'add_comment_form' => $form->createView()
                    ));
                }

                $this->get('uvweb_uv.fbmanager')->addFlashMessage("Avis modifié avec succès ! Il doit maintenant être validé par un modérateur pour être visible par tout le monde.", 'success');

                return $this->redirect($this->generateUrl('uvweb_uv_profile', array('userid' => $currentUser->getId())));
            }
        }

        return $this->render('UvwebUvBundle:Uv:post.html.twig', array(
            'uv' => $uv,
            'add_comment_form' => $form->createView()
        ));
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