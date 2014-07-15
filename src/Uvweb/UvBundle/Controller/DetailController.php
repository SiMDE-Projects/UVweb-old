<?php

namespace Uvweb\UvBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Uvweb\UvBundle\Entity\Comment;
use Uvweb\UvBundle\Entity\Poll;
use Uvweb\UvBundle\Form\CommentType;

class DetailController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function detailAction($uvname = '')
    {
        $ajaxRequest = $this->getRequest()->isXmlHttpRequest(); //Can be called from the dynamic list view

        //Parameter from symfony route
        if(empty($uvname))
        {
            //If is empty: is there a get parameter?
            $uvname = $this->getRequest()->query->get('uvname');

            if(empty($uvname))
            {
                $this->get('uvweb_uv.fbmanager')->addFlashMessage("Vous devez entrer un nom d'UV.");

                if(!$ajaxRequest)
                    return $this->redirect($this->generateUrl('uvweb_uv_homepage'));
                else
                    return new Response(json_encode(array('status' => 'error')));
            }
        }

        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $pollRepository = $manager->getRepository('UvwebUvBundle:Poll');

        $uv = $uvRepository->findOneBy(array('name' => $uvname, 'archived' => 0));

        if ($uv === null)
        {
            $this->get('uvweb_uv.fbmanager')->addFlashMessage("Non d'UV invalide : cette UV n'existe pas ou n'existe plus.");

            if(!$ajaxRequest)
                return $this->redirect($this->generateUrl('uvweb_uv_homepage'));
            else
                return new Response(json_encode(array('status' => 'error')));
        }

        $comments = $commentRepository->findBy(
            array('uv' => $uv, 'moderated' => true),
            array('id' => 'desc'), //Ordering by id: better than date for perf + if there are two comments the same day the order is respected
            22,
            0
        );

        $polls = $pollRepository->findBy(
            array('uvName' => $uvname),
            array('year' => 'desc', 'season' => 'asc'),
            5,
            0
        );

        $averageRate = $commentRepository->averageRate($uv);

        $viewParameters = array(
            'uv' => $uv,
            'comments' => $comments,
            'polls' => $polls,
            'averageRate' => $averageRate,
        );

        if($ajaxRequest)
        {
            return new Response(json_encode(array('status' => 'success', 'html' => $this->renderView('UvwebUvBundle:Uv:detail_body.html.twig', $viewParameters))));
        }

        return $this->render('UvwebUvBundle:Uv:detail.html.twig', $viewParameters);
    }

    public function postAction($uvname) 
    {
        //Is the user registered ?
        $session = $this->getRequest()->getSession();
        $currentUser = $this->getUser();

        if($currentUser === null)  //Not registered: redirection to the login controller
            return $this->redirect($this->generateUrl('uvweb_login'));

        $manager = $this->getDoctrine()->getManager();

        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $userRepository = $manager->getRepository("UvwebUvBundle:User");

        $author = $userRepository->find($currentUser->getId());
        $uv = $uvRepository->findOneBy(array('name' => $uvname, 'archived' => 0));

        if ($uv == null) throw $this->createNotFoundException("Cette UV n'existe pas ou plus");

        //Has the user already commented this UV in the past?
        if($commentRepository->userAlreadyCommentedUv($author, $uv))
        {
            $this->container->get('uvweb_uv.fbmanager')->addFlashMessage('Tu as déjà donné ton avis sur cette UV.');

            return $this->redirect($this->generateUrl('uvweb_uv_detail', array(
                'uvname' => $uv->getName()
            )));
        }

        $comment = new Comment();
        $comment->setUv($uv);

        $form = $this->createForm(new CommentType($uv, $this->get('uvweb_comment.commenthelper')), $comment);
        $this->createFormBuilder($comment);

        $request = $this->getRequest();
        
        if($request->isMethod('POST')) 
        {
            $form->bind($request);

            if($form->isValid()) 
            {
                $comment->setDate(new \DateTime());
                $comment->setModerated(false);
                $comment->setAuthor($author);

                try
                {
                    $manager->persist($comment);
                    $manager->flush();
                }
                catch(\Exception $e)
                {
                    $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de l'ajout de l'avis.");

                    //Insertion failed: invite the user to try again, displaying the errors
                    return $this->render('UvwebUvBundle:Uv:post.html.twig', array(
                        'uv' => $uv,
                        'add_comment_form' => $form->createView()
                    ));
                }

                return $this->render('UvwebUvBundle:Uv:posted.html.twig', array(
                    'uv' => $uv
                ));
            }
        }

        return $this->render('UvwebUvBundle:Uv:post.html.twig', array(
            'uv' => $uv,
            'add_comment_form' => $form->createView()
        ));
    }

    public function uvTitleAction()
    {
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
            $html = file_get_html('http://cap.utc.fr/portail_UV/detailuv.php?uv=' . $uv->getName() . '&page=uv&lang=FR');


            // Find the DIV tag with an id of "myId"
            foreach ($html->find('span#titre') as $e) {
                $arr = split(" - ", $e->innertext);
                $title = $arr[1];
                $uv->setTitle(html_entity_decode($title));

                $manager->persist($uv);
                echo $uv->getName() . " : " . $title;
                echo "<br>";
            }
        }
        $manager->flush();
        $response = new Response;
        $response->setContent("<body></body>");
        return $response;

    }

    public function uvNametoUvIdAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $pollRepository = $manager->getRepository("UvwebUvBundle:Poll");

        $polls = $pollRepository->findAll();
        foreach ($polls as $poll) {

            if ($poll->getUv() != null) continue;

            $uv = $uvRepository->findOneByName($poll->getUvName());

            if ($uv != null) {
                echo "uv found : " . $uv->getName() . "<br>";
                $poll->setUv($uv);
            } else {
                echo "uv not found : " . $poll->getUvName() . "<br>";
            }

        }
        $manager->flush();

        return new Response;

    }

    public function pollSemesterToYearAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $pollRepository = $manager->getRepository('UvwebUvBundle:Poll');

        $polls = $pollRepository->findAll();

        $i = 0;

        foreach ($polls as $poll) {
            if ($i >= 500) break;
            $semester = $poll->getSemester();

            if ($poll->getSeason() != "Automne" && $poll->getSeason() != "Printemps") {

                echo $poll->getSemester() . " ";
                if (strtoupper(substr($semester, 0, 1)) == 'P') {
                    echo "printemps ";
                    $poll->setSeason("Printemps");
                } else if (strtoupper(substr($semester, 0, 1)) == 'A') {
                    echo "automne ";
                    $poll->setSeason("Automne");
                } else {
                    echo "ERROR ";
                }
                echo "<br>";

                $i++;

            }

            if ($poll->getYear() == 0) {
                echo "annnee 20" . substr($semester, 1, 3) . '<br>';
                $poll->setYear('20' . substr($semester, 1, 3));
                $i++;
            }
        }

        $manager->flush();

        return new Response;
    }

    public function listAllAction($order)
    {
        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository('UvwebUvBundle:Uv');

        if($order === 'name')
        { 
            //Order by name
            $uvs = $uvRepository->uvsOrderedByName();
            
            $groupedUvs = array(); //Will contain an array of type ['letter'] => array(UV1, UV2) with UV1, UV2 like 'letter%'
            $sub = '';

            foreach($uvs as $uv) 
            {
                $sub = substr($uv['name'], 0, 1);
                $groupedUvs[$sub][] = $uv;
            }

            return $this->render('UvwebUvBundle:Uv:all_ordered_category.html.twig', array('order' => $order, 'groupedUvs' => $groupedUvs));
        }

        //Order by rate
        $uvs = $uvRepository->uvsOrderedByRate();

        $groupedUvs = array();
        foreach($uvs as $uv)
        {
            $groupedUvs[ceil($uv['globalRate'])][] = $uv;
        }

        return $this->render('UvwebUvBundle:Uv:all_ordered_by_rate.html.twig', array('order' => $order, 'groupedUvs' => $groupedUvs));
    }

    public function listCategoryAction($category, $order)
    {
        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository('UvwebUvBundle:Uv');

        if($order === 'name' || $order === 'dynamic')
        {
            //Order by name
            $uvWithoutComment = ($order !== 'dynamic');

            $uvs = $uvRepository->uvsOrderedByName(0, $category, false, $uvWithoutComment);

            $groupedUvs = array(); //Will contain an array of type ['letter'] => array(UV1, UV2) with UV1, UV2 like 'letter%'
            $sub = '';

            foreach($uvs as $uv) 
            {
                $sub = substr($uv['name'], 0, 1);
                $groupedUvs[$sub][] = $uv;
            }

            if($order === 'dynamic') //Dynamic: pass the UV names to the appropriate view
                return $this->render('UvwebUvBundle:Uv:all_ordered_category_ajax.html.twig', array('order' => $order, 'categoryName' => strtoupper($category), 'groupedUvs' => $groupedUvs));
            
            return $this->render('UvwebUvBundle:Uv:all_ordered_category.html.twig', array('order' => $order, 'categoryName' => strtoupper($category), 'groupedUvs' => $groupedUvs));
        }
        else if($order === 'rate')
        {
            //Order by rate
            $uvs = $uvRepository->uvsOrderedByRate(0, true, 0, $category);

            $groupedUvs = array();
            foreach($uvs as $uv)
            {
                $groupedUvs[ceil($uv['globalRate'])][] = $uv;
            }

            return $this->render('UvwebUvBundle:Uv:all_ordered_by_rate.html.twig', array('order' => $order, 'categoryName' => strtoupper($category), 'groupedUvs' => $groupedUvs));
        }
    }

    public function catalogAction()
    {
        return $this->render('UvwebUvBundle:Uv:catalog.html.twig');
    }

    public function appDetailAction($uvname)
    {
        $manager = $this->getDoctrine()->getManager();
        $commentRepository = $manager->getRepository("UvwebUvBundle:Comment");
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");

        $uv = $uvRepository->findOneByName($uvname);
        if ($uv == null) throw $this->createNotFoundException("Cette UV n'existe pas ou plus");

        $comments = $commentRepository->findBy(
            array('uv' => $uv, 'moderated' => true),
            array('date' => 'desc'),
            20,
            0
        );

        foreach ($comments as $comment) {
            try {
                $author = $comment->getAuthor()->getLogin();
            } catch (EntityNotFoundException $e) {
                $userRepository = $manager->getRepository("UvwebUvBundle:User");
                $author = $userRepository->find(2543);
                $comment->setAuthor($author);
            }
        }


        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setIgnoredAttributes(array('moderator', 'date', 'last', 'utcLogin', 'password', 'email', 'id', 'moderated', 'uv', 'isadmin', 'author'));

        $serializer = new Serializer(array($normalizer), $this->encoders);

        $response = new Response();
        $response->setContent($serializer->serialize($comments, 'json'));

        return $response;
    }

    public function searchAction($searchtext)
    {
        if (preg_match("/^[a-zA-Z]{2}+[0-9]{2}$/", $searchtext)) {
            return $this->redirect($this->generateUrl('uvweb_uv_detail', array('uvname' => $searchtext)));
        } else {
            return $this->render('UvwebUvBundle:Uv:search.html.twig');
        }
    }

    public function appListAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");

        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $this->encoders);

        $uvs = $uvRepository->findAll();

        $response = new Response();
        $response->setContent($serializer->serialize($uvs, 'json'));
        return $response;
    }
}

?>