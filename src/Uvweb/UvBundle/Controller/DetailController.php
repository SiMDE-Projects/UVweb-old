<?php

namespace Uvweb\UvBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Uvweb\UvBundle\Entity\Comment;

class DetailController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function detailAction($uvname)
    {
        /** those lines allow redirection after submitting search bar form */
        if ($redirect = $this->initSearchBar()) {
            return $redirect;
        }

        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $pollRepository = $manager->getRepository('UvwebUvBundle:Poll');

        $uv = $uvRepository->findOneByName($uvname);
        if ($uv == null) throw $this->createNotFoundException("Cette UV n'existe pas ou plus");

        $comments = $commentRepository->findBy(
            array('uv' => $uv, 'moderated' => true),
            array('date' => 'desc'),
            20,
            0);

        foreach ($comments as $comment) {
            try {
                $author = $comment->getAuthor()->getLogin();
            } catch (EntityNotFoundException $e) {
                $userRepository = $manager->getRepository("UvwebUvBundle:User");
                $author = $userRepository->find(2543);
                $comment->setAuthor($author);
            }
        }

        $polls = $pollRepository->findBy(
            array('uv' => $uv),
            array('year' => 'desc'),
            4,
            0);

        $averageRate = $commentRepository->averageRate($uv);


        return $this->render('UvwebUvBundle:Uv:detail.html.twig', array(
            'uv' => $uv,
            'comments' => $comments,
            'polls' => $polls,
            'firstPoll' => $polls[0],
            'averageRate' => $averageRate,
            'searchbar' => $this->searchBarForm->createView(),
        ));
    }

    public function postAction($uvname) {

        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $userRepository = $manager->getRepository("UvwebUvBundle:User");

        $uv = $uvRepository->findOneByName($uvname);
        if ($uv == null) throw $this->createNotFoundException("Cette UV n'existe pas ou plus");


        $comment = new Comment();
        $comment->setUv($uv);
        $form = $this->createFormBuilder($comment)
            ->add('comment', 'textarea', array(
                'label' => 'Ton commentaire'
            ))
            ->add('interest', 'choice', array(
                'choices' => array('Passionnant' => 'Passionnant', 'Très intéressant' => 'Très intéressant',
                    'Intéressant' => 'Intéressant', 'Peu intéressant' => 'Peu intéressant', 'Bof' => 'Bof', 'Nul' => 'Nul'),
                'label' => 'Intérêt'
            ))
            ->add('pedagogy', 'choice', array(
                'choices' => array('Passionnant' => 'Passionnant', 'Très intéressant' => 'Très intéressant',
                    'Intéressant' => 'Intéressant', 'Peu intéressant' => 'Peu intéressant', 'Bof' => 'Bof', 'Nul' => 'Nul'),
                'label' => 'Qualité de la pédagogie'
            ))
            ->add('utility', 'choice', array(
                'choices' => array('Indispensable' => 'Indispensable', 'Très importante' => 'Très importante',
                    'Utile' => 'Utile', 'Pas très utile' => 'Pas très utile', 'Très peu utile' => 'Très peu utile', 'Inutile' => 'Inutile'),
                'label' => 'Utilité'
            ))
            ->add('workamount', 'choice', array(
                'choices' => array('Symbolique' => 'Symbolique', 'Faible' => 'Faible',
                    'Moyenne' => 'Moyenne', 'Importante' => 'Importante', 'Très importante' => 'Très importante'),
                'label' => 'Quantité de travail'
            ))
            ->add('passed', 'choice', array(
                'choices' => array('obtenue' => 'Obtenue', 'ratée' => 'Ratée', 'en cours' => 'En cours'),
                'label' => 'As-tu obtenu '.$uv->getName().' ?'
            ))
            ->add('semester', 'choice', array(
                'choices' => array('P13' => 'P13', 'A12' => 'A12', 'P12' => 'P12'),
                'label' => 'Semestre lors duquel l\'a effectuée '
            ))
            ->add('globalRate', 'choice', array(
                'choices' => array('10' => '10', '9' => '9', '8' => '8', '7' => '7', '6' => '6'
                , '5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1', '0' => '0'),
                'label' => 'Ta note pour '.$uv->getName()
            ))
            ->getForm();

        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {

                $author = $userRepository->find(2543);
                $comment->setDate(new \DateTime());
                $comment->setModerated(true);
                $comment->setAuthor($author);

                $manager->persist($comment);
                $manager->flush();

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