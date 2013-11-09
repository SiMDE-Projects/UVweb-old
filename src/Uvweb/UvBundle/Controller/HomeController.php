<?php
 
namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

	public function indexAction() {
        /** those lines allow redirection after submitting search bar form */
        if( $redirect = $this->initSearchBar()) {
            return $redirect;
        }

		$manager = $this->getDoctrine()->getManager();
		$commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $newsRepository = $manager->getRepository('UvwebUvBundle:News');

		$comments = $commentRepository->findBy(
			array('moderated' => true),
			array('date' => 'desc'),
			20,
			0);

        $news = $newsRepository->findLastNews();

		return $this->render('UvwebUvBundle:Home:index.html.twig', array(
            'comments' => $comments,
            'news' => $news,
            'searchbar' => $this->searchBarForm->createView()
        ));
	}

    public function appNewsfeedAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $commentRepository = $manager->getRepository("UvwebUvBundle:Comment");
        $newsRepository = $manager->getRepository("UvwebUvBundle:News");

        $comments = $commentRepository->findBy(
            array('moderated' => true),
            array('date' => 'desc'),
            20,
            0);

        $news = $newsRepository->findLastNews();

        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setIgnoredAttributes(array('moderator', 'date', 'last', 'utcLogin', 'password', 'email', 'id', 'moderated', 'uv', 'isadmin', 'author'));

        $serializer = new Serializer(array($normalizer), $this->encoders);

        $response = new Response();
        $response->setContent($serializer->serialize($comments, 'json'));

        return $response;
    }
}
?>