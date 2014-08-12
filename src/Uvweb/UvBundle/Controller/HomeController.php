<?php
 
namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Uvweb\UvBundle\Entity\Uv;

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

    public function aboutIosAction($part)
    {
        return $this->render('UvwebUvBundle:Common:about_ios/about_ios.html.twig', array('part' => $part, 'about_ios' => true));
    }

    public function setuvdefinitionsAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $categoryRepository = $manager->getRepository("UvwebUvBundle:Category");

        $categories = array(
            'GI' => $categoryRepository->findOneByCategory('GI'),
            'GM' => $categoryRepository->findOneByCategory('GM'),
            'GSM' => $categoryRepository->findOneByCategory('GSM'),
            'GB' => $categoryRepository->findOneByCategory('GB'),
            'TSH' => $categoryRepository->findOneByCategory('TSH'),
            'GSU' => $categoryRepository->findOneByCategory('GSU'),
            'GP' => $categoryRepository->findOneByCategory('GP'),
            'TC' => $categoryRepository->findOneByCategory('TC'),
            'MASTER' => $categoryRepository->findOneByCategory('MASTER'),
            'DOCT' => $categoryRepository->findOneByCategory('DOCT')
            );

        $uvsJSON = json_decode(file_get_contents('../uvs.json'), true);

        foreach($uvsJSON as $uvName => $uvContent)
        {
            $uv = $uvRepository->findOneByName($uvName);

            if($uv !== null)
            {
                $uv->setMaxStudent($uvsJSON[$uvName]['places']);
                $uv->setTitle($uvsJSON[$uvName]['nom']);
                $uv->setCredits($uvsJSON[$uvName]['ects']);
                $uv->setCourseHours($uvsJSON[$uvName]['cours']);
                $uv->setTdHours($uvsJSON[$uvName]['td']);

                if($uvsJSON[$uvName]['tp'] === 'oui')
                    $uv->setTp(true);
                else
                    $uv->setTp(false);


                if($uvsJSON[$uvName]['final'] === 'oui')
                    $uv->setFinal(true);
                else
                    $uv->setFinal(false);

                $uv->setTeacher($uvsJSON[$uvName]['resp']);

                if($uvsJSON[$uvName]['cat'] !== 'TSH')
                {
                    $cat = $uvsJSON[$uvName]['branches'];

                    foreach($cat as $c => $cname)
                    {
                        if($c === 'MASTER')
                        {
                            $categories[$c]->addUv($uv);
                        }

                        if($c === 'DOCT')
                        {
                            $categories[$c]->addUv($uv);
                        }
                    }
                }

                $semestreArray = $uvsJSON[$uvName]['semestre'];
                if(count($semestreArray) === 2)
                {
                    $uv->setSemester('AP');
                }
                elseif($semestreArray[0] === 'automne')
                {
                    $uv->setSemester('A');
                }
                else
                {
                    $uv->setSemester('P');
                }

                echo $uvName . ' NOT NULL <br/>';

                $manager->persist($uv);

                $manager->flush();
            }
            else
            {
                $newUv = new Uv();

                $newUv->setArchived(false);
                $newUv->setName($uvName);
                $newUv->setMaxStudent($uvsJSON[$uvName]['places']);
                $newUv->setTitle($uvsJSON[$uvName]['nom']);
                $newUv->setCredits($uvsJSON[$uvName]['ects']);
                $newUv->setCourseHours($uvsJSON[$uvName]['cours']);
                $newUv->setTdHours($uvsJSON[$uvName]['td']);

                if($uvsJSON[$uvName]['tp'] === 'oui')
                    $newUv->setTp(true);
                else
                    $newUv->setTp(false);


                if($uvsJSON[$uvName]['final'] === 'oui')
                    $newUv->setFinal(true);
                else
                    $newUv->setFinal(false);

                $newUv->setTeacher($uvsJSON[$uvName]['resp']);

                if($uvsJSON[$uvName]['cat'] === 'TSH')
                {
                        $categories['TSH']->addUv($newUv);
                }
                else
                {
                    $cat = $uvsJSON[$uvName]['branches'];

                    foreach($cat as $c => $cname)
                    {
                        if(array_key_exists($c, $categories))
                        {
                            $categories[$c]->addUv($newUv);
                        }
                    }
                }

                $semestreArray = $uvsJSON[$uvName]['semestre'];
                
                if(count($semestreArray) === 2)
                {
                    $newUv->setSemester('AP');
                }
                elseif($semestreArray[0] === 'automne')
                {
                    $newUv->setSemester('A');
                }
                else
                {
                    $newUv->setSemester('P');
                }

                echo $uvName . ' <br/>';

                $manager->persist($newUv);

                $manager->flush();
            }
        }

        foreach($categories as $category => $catObject)
        {
            $manager->persist($catObject);
        }

        $manager->flush();

        return new Response('Done');
    }
}

?>