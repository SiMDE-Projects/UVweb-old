<?php
 
namespace Uvweb\UvBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
	public function indexAction() {
		$manager = $this->getDoctrine()->getManager();
		$commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $newsRepository = $manager->getRepository('UvwebUvBundle:News');


		$comments = $commentRepository->findBy(
			array('moderated' => true),
			array('date' => 'desc'),
			20,
			0);

        $news = $newsRepository->findLastNews();

		return $this->render('UvwebUvBundle:Home:index.html.twig', array('comments' => $comments, 'news' => $news));
	}
}
?>