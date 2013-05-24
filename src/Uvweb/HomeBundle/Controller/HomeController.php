<?php
 
namespace Uvweb\HomeBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Uvweb\UvBundle\Entity\Comment;

class HomeController extends Controller
{
	public function indexAction() {
		$manager = $this->getDoctrine()->getManager();
		$commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
		$comments = $commentRepository->findBy(
			array('moderated' => true),
			array('date' => 'desc'),
			20,
			0);
		return $this->render('UvwebHomeBundle:Home:index.html.twig', array('comments' => $comments ));
	}
}
?>