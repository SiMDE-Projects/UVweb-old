<?php
 
namespace Uvweb\UvBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UvController extends Controller
{
	public function detailAction($uvname)
	{
		//fake uv
		$uv = array(
			'name' => $uvname,
			'fullname' => "Algèbre linéaire",
			'averagerate' => 3.78
		);

		//fake comments
		$comment = array(
			'author' => 'amasciul',
			'authormail' => 'fdp@lol.com',
			'date' => new \Datetime(),
			'semester' => 'A12',
			'comment' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. ',
			'globalrate' => 5,
			'utility' => 'Utile',
			'workamount' => 'Moyenne',
			'interest' => 'Très intéressant',
			'pedagogy' => 'Nul'
		);
		$comments = array($comment, $comment, $comment, $comment);

		return $this->render('UvwebUvBundle:Uv:detail.html.twig', array(
			'uv' => $uv,
			'comments' => $comments
		));
	}
}
?>