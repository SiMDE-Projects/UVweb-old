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

	public function indexAction() 
    {
		$manager = $this->getDoctrine()->getManager();
		$commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $newsRepository = $manager->getRepository('UvwebUvBundle:News');

		$comments = $commentRepository->findBy(
			array('moderated' => true),
			array('id' => 'desc'),
			20,
			0);

        $bestUvs = $commentRepository->uvsOrderedByRate(6, true, 5);
        $worstUvs = $commentRepository->uvsOrderedByRate(6, false, 5);

        $news = $newsRepository->findLastNews();

		return $this->render('UvwebUvBundle:Home:index.html.twig', array(
            'comments' => $comments,
            'news' => $news,
            'bestUvs' => $bestUvs,
            'worstUvs' => $worstUvs,
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

    public function getUvNamesLikeAction()
    {
        $uvLike = $this->getRequest()->query->get('uvLike');

        //Limite the results
        $limit = (int) $this->getRequest()->query->get('limit');
        if($limit < 0)
            $limit = 0;

        if($uvLike === null || $uvLike === '')
        {
            return new Response(json_encode(array(
                'error' => true,
                'message' => 'No string given'
            )));
        }

        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");

        $uvs = $uvRepository->getUvNamesLike($uvLike, $limit); //Array of type 'name' => 'NF16'...

        $uvNames = array();

        //Keeping only the uv names
        foreach ($uvs as $uv) {
            $uvNames[] = $uv['name'];
        }

        return new Response(json_encode($uvNames));
    }

    public function aboutAction()
    {
        return $this->render('UvwebUvBundle:Common:about.html.twig', array('about' => true));
    }
}
?>