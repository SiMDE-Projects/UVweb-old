<?php
 
namespace Uvweb\HomeBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
class HomeController extends Controller
{
	public function indexAction() {
		return $this->render('UvwebHomeBundle:Home:index.html.twig');
	}
}
?>