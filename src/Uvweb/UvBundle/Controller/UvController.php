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

/*		$comment = new Comment();
		$comment->setAuthor("tkeunebr");
		$comment->setSemester("P13");
		$comment->setComment("Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. ");
		$comment->setGlobalrate(6);
		$comment->setUtility("Utile");
		$comment->setWorkamount("Moyenne");
		$comment->setInterest("Très intéressant");
		$comment->setPedagogy("Nul");

		// On récupère l'EntityManager
		$em = $this->getDoctrine()->getManager();
		$em->persist($comment);
		$em->flush();*/


		//hardcoded uv

		$uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
		$uv = $uvRepository->find(1);



		$commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
		$comments = $commentRepository->findAll();

		return $this->render('UvwebUvBundle:Uv:detail.html.twig', array(
			'uv' => $uv,
			'comments' => $comments
		));
	}
}
?>