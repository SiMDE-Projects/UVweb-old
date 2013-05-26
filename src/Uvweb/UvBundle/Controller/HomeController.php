<?php
 
namespace Uvweb\UvBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Uvweb\UvBundle\Forms\SearchStatement;

class HomeController extends Controller
{
	public function indexAction() {

        $search = new SearchStatement;
        $formBuilder = $this->createFormBuilder($search);
        $formBuilder->add('statement', 'text');
        $form = $formBuilder->getForm();



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
            'form' => $form->createView()
        ));
	}
}
?>