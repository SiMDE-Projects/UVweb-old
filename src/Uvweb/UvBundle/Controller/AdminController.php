<?php
 
namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Uvweb\UvBundle\Entity\News;
use Uvweb\UvBundle\Form\NewsType;

class AdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function homeAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $newsRepository = $manager->getRepository('UvwebUvBundle:News');

        $comments = $commentRepository->findBy(
            array('moderated' => false),
            array('id' => 'desc')
        );

        $news = $newsRepository->findLastNews();

        return $this->render('UvwebUvBundle:Admin:home.html.twig', array(
            'comments' => $comments,
            'news' => $news,
            'adminView' => true
        ));
    }

    public function validateCommentAction($commentid)
    {
        $manager = $this->getDoctrine()->getManager();
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');

        $comment = $commentRepository->findOneBy(
            array('id' => $commentid, 'moderated' => false)
        );

        if($comment === null) //Comment can't be approved anymore or does not exist: redirection
        {
            $this->container->get('uvweb_uv.fbmanager')->addFlashMessage("Le commentaire a déjà été validé, supprimé, ou n'existe pas.");
            return $this->redirect($this->generateUrl('uvweb_admin_home'));
        }

        $request = $this->getRequest();
        
        if ($request->isMethod('POST'))
        {
            try
            {
                $comment->setModerated(true);
                $comment->setModerator($this->getDoctrine()->getManager()->getRepository('UvwebUvBundle:User')->findOneById($this->getUser()->getId()));
                $manager->persist($comment);
                $manager->flush();
            }
            catch(\Exception $e)
            {
                //Validation failed: notification for user

                //Getting the view for the confirmation message to display
                $response =  new Response(json_encode(array('messageHTML' => $this->renderView('UvwebUvBundle:Common:message-info.html.twig', array(
                                'message' => array(
                                    'type' => 'error', 
                                    'content' => "Une erreur s'est produite lors de la validation de l'avis."
                                    )
                                )))));

                //We are sending json
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }

            $ajax = $request->get('ajax', false);

            if(!$ajax) //User does not have javascript: redirection
            {
                $this->get('uvweb_uv.fbmanager')->addFlashMessage('Avis de ' . $comment->getAuthor()->getIdentity() . ' sur ' . $comment->getUv()->getName() . ' validé avec succès.', 'success');

                return $this->redirect($this->generateUrl('uvweb_admin_home'));
            }

            //Getting the view for the confirmation message to display
            $response =  new Response(json_encode(array('messageHTML' => $this->renderView('UvwebUvBundle:Common:message-info.html.twig', array(
                            'message' => array(
                                'type' => 'success', 
                                'content' => 'Avis de ' . $comment->getAuthor()->getIdentity() . ' sur ' . $comment->getUv()->getName() . ' validé avec succès.'
                                )
                            )))));

            //We are sending json
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }

        return $this->render('UvwebUvBundle:Admin:validate_comment.html.twig', array(
            'comment' => $comment
        ));
    }

    public function refuseCommentAction($commentid)
    {
        $manager = $this->getDoctrine()->getManager();
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');

        $comment = $commentRepository->findOneBy(
            array('id' => $commentid, 'moderated' => false)
        );

        if($comment === null) //Comment can't be approved anymore or does not exist: redirection
        {
            $this->container->get('uvweb_uv.fbmanager')->addFlashMessage("Le commentaire a déjà été validé, supprimé, ou n'existe pas.");
            return $this->redirect($this->generateUrl('uvweb_admin_home'));
        }

        $request = $this->getRequest();

        if ($request->isMethod('POST'))
        {
            $refuseMotive = $request->get('refuse-mail-text');

            if($refuseMotive === '')
            {
                //Admin did not give a motive for the refuse: he has to do so
                $response =  new Response(json_encode(array(
                    'status' => 'error',
                    'messageHTML' => $this->renderView('UvwebUvBundle:Common:message-info.html.twig', array(
                                'message' => array(
                                    'type' => 'error', 
                                    'content' => "Il faut préciser un motif de refus pour refuser un avis (avis trop peu précis, non respectueux...)."
                                    )
                                )))));

                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }

            try
            {
                $author = $comment->getAuthor();
                
                $mailer = $this->get('mailer');

                $message = \Swift_Message::newInstance()
                    ->setSubject('Commentaire refusé')
                    ->setFrom('a@gmail.com')
                    ->setTo($author->getEmail())
                    ->setBody($this->renderView('UvwebUvBundle:Mail:refused_comment.txt.twig', array(
                                        'userIdentity' => $author->getIdentity(),
                                        'comment' => $comment->getComment(),
                                        'adminComment' => $refuseMotive,
                                        'uvname' => $comment->getUv()->getName()
                            )));

                $mailer->send($message);

                $manager->remove($comment);
                $manager->flush();
            }
            catch(\Exception $e)
            {
                //Deletion failed: notification for user

                //Getting the view for the confirmation message to display
                $response =  new Response(json_encode(array(
                    'status' => 'error',
                    'messageHTML' => $this->renderView('UvwebUvBundle:Common:message-info.html.twig', array(
                                'message' => array(
                                    'type' => 'error', 
                                    'content' => "Une erreur s'est produite lors de la suppression de l'avis."
                                    )
                                )))));

                //We are sending json
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }

            $ajax = $request->get('ajax', false);

            if(!$ajax) //Javascript does not work: redirection
            {
                $this->get('uvweb_uv.fbmanager')->addFlashMessage('Avis de ' . $comment->getAuthor()->getIdentity() . ' sur ' . $comment->getUv()->getName() . ' supprimé avec succès.', 'success');

                return $this->redirect($this->generateUrl('uvweb_admin_home'));
            }

            //Getting the view for the confirmation message to display
            $response =  new Response(json_encode(array(
                'status' => 'success',
                'messageHTML' => $this->renderView('UvwebUvBundle:Common:message-info.html.twig', array(
                            'message' => array(
                                'type' => 'success', 
                                'content' => 'Avis de ' . $comment->getAuthor()->getIdentity() . ' sur ' . $comment->getUv()->getName() . ' supprimé avec succès.'
                                )
                            )))));

            //We are sending json
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }

        return $this->render('UvwebUvBundle:Admin:refuse_comment.html.twig', array(
            'comment' => $comment
        ));
    }

    public function addNewsAction()
    {
        $news = new News();

        //Generate form from Symfony2 forms
        $form = $this->createForm(new NewsType, $news);

        $request = $this->getRequest();

        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid()) 
            {   
                try
                {
                    $news->setAuthorId($this->getUser()->getId());

                    //Saving the news
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($news);
                    $manager->flush();
                }
                catch(\Exception $e)
                {
                    //Insertion failed: invite the user to try again
                    $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de l'ajout de la news.");

                    return $this->render('UvwebUvBundle:Admin:add_news.html.twig', array(
                        'news_form' => $this->createForm(new NewsType, new News())->createView()
                    ));
                }

                //Ok: news was inserted correctly
                $this->get('uvweb_uv.fbmanager')->addFlashMessage('News ajoutée avec succès, merci !', 'success');

                return $this->redirect($this->generateUrl('uvweb_admin_home'));
            }
        }

        return $this->render('UvwebUvBundle:Admin:add_news.html.twig', array(
            'news_form' => $form->createView()
        ));
    }

    public function editNewsAction($newsid)
    {
        $manager = $this->getDoctrine()->getManager();
        $newsRepository = $manager->getRepository("UvwebUvBundle:News");

        $news = $newsRepository->findOneById($newsid);

        $form = $this->createForm(new NewsType, $news);

        $request = $this->getRequest();

        if ($request->isMethod('POST')) 
        {
            $form->bind($request);

            if ($form->isValid())
            {   
                try
                {
                    $news->setAuthorId($this->getUser()->getId());

                    $manager->persist($news);
                    $manager->flush();
                }
                catch(\Exception $e)
                {
                    //Insertion failed: invite the user to try again
                    $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de la modification de la news.");

                    return $this->render('UvwebUvBundle:Admin:edit_news.html.twig', array(
                        'news_form' => $this->createForm(new NewsType, $news)->createView()
                    ));                
                }

                //Ok: news was inserted correctly
                $this->get('uvweb_uv.fbmanager')->addFlashMessage('News modifiée avec succès, merci !', 'success');

                return $this->redirect($this->generateUrl('uvweb_admin_home'));
            }
        }

        return $this->render('UvwebUvBundle:Admin:edit_news.html.twig', array(
            'news_form' => $form->createView()
        ));    
    }

    public function deleteNewsAction($newsid)
    {
        $manager = $this->getDoctrine()->getManager();
        $newsRepository = $manager->getRepository("UvwebUvBundle:News");

        $news = $newsRepository->findOneById($newsid);

        $request = $this->getRequest();

        if ($request->isMethod('POST')) 
        {
            try
            {
                $manager->remove($news);
                $manager->flush();
            }
            catch(\Exception $e)
            {
                //Deletion failed: notification for user

                //Getting the view for the confirmation message to display
                $response =  new Response(json_encode(array('messageHTML' => $this->renderView('UvwebUvBundle:Common:message-info.html.twig', array(
                                'message' => array(
                                    'type' => 'error', 
                                    'content' => "Une erreur s'est produite lors de la suppression de la news."
                                    )
                                )))));

                //We are sending json
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }

            $ajax = $request->get('ajax', false);

            if(!$ajax) //User does not have javascript: redirection
            {
                $this->get('uvweb_uv.fbmanager')->addFlashMessage('News "' . $news->getTitle() . '" supprimée avec succès.', 'success');

                return $this->redirect($this->generateUrl('uvweb_admin_home'));
            }

            //Getting the view for the confirmation message to display
            $response =  new Response(json_encode(array('messageHTML' => $this->renderView('UvwebUvBundle:Common:message-info.html.twig', array(
                            'message' => array(
                                'type' => 'success', 
                                'content' => 'News "' . $news->getTitle() . '" supprimée avec succès.'
                                )
                            )))));

            //We are sending json
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }

        return $this->render('UvwebUvBundle:Admin:delete_news.html.twig', array(
            'news' => $news
        ));
    }
}

?>