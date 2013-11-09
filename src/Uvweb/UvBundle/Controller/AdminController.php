<?php
 
namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

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
            array('moderated' => true),
            array('date' => 'desc')
        );

        $news = $newsRepository->findLastNews();

        return $this->render('UvwebUvBundle:Admin:home.html.twig', array(
            'comments' => $comments,
            'news' => $news
        ));
    }

    public function validateCommentAction($commentid)
    {
        return new Response('etst');
    }

    public function refuseCommentAction($commentid)
    {
        return new Response('refuse');
    }
}
?>