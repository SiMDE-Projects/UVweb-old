<?php
 
namespace Uvweb\UvBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Uvweb\UvBundle\Entity\Comment;

class UvController extends Controller
{
	public function detailAction($uvname)
	{
		$manager = $this->getDoctrine()->getManager();


		//hardcoded uv

		$uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
		$uv = $uvRepository->findOneByName($uvname);
		if($uv == null) throw $this->createNotFoundException("Cette UV n'existe pas");
		
		$commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
		$comments = $commentRepository->findBy(array('uv' => $uv),
												array('date' => 'desc'),
												20,
												0);

		return $this->render('UvwebUvBundle:Uv:detail.html.twig', array(
			'uv' => $uv,
			'comments' => $comments
		));
	}

	public function uvTitleAction() {
		$manager = $this->getDoctrine()->getManager();
		$uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
		$uvs = $uvRepository->findBy(array('title' => ''),
                                     array('name' => 'desc'),
                                     100,
                                     0);
		include('uvtitlefetcher/simple_html_dom.php');
		foreach ($uvs as $uv) {

			// Include the library
			
			 
			// Retrieve the DOM from a given URL
			$html = file_get_html('http://cap.utc.fr/portail_UV/detailuv.php?uv='.$uv->getName().'&page=uv&lang=FR');


			// Find the DIV tag with an id of "myId"
			foreach($html->find('span#titre') as $e) {
				$arr = split(" - ", $e->innertext);
				$title = $arr[1];
				$uv->setTitle(html_entity_decode($title));

				$manager->persist($uv);
				echo $uv->getName()." : ".$title;
				echo "<br>";
			}
		}
		$manager->flush();
		$response = new Response;
		$response->setContent("<body></body>");
		return $response;

	}
}
?>