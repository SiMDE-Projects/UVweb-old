<?php
 
namespace Uvweb\UvBundle\Controller;

use CG\Tests\Generator\Fixture\Entity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Uvweb\UvBundle\Entity\Comment;
use Uvweb\UvBundle\Form\CommentRestType;

class WebServiceController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Return an array of UVs in JSON.
     * groupedByLetter: true: return array of type [A] => array of UVs starting by A, [B] => array of UVs starting by B. false : simple array of UVs
     */
    public function uvListAction($category, $order, $groupedByLetter)
    {
        $manager = $this->getDoctrine()->getManager();
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');

        $uvArray = array();

        if($order === 'name')
        {
            //Order by name
            $uvs = $commentRepository->uvsOrderedByName(0, $category, true);

            $sub = '';

            if($groupedByLetter === 'false')
            {
                return new Response(json_encode($uvs));
            }

            foreach($uvs as $uv)
            {
                $sub = substr($uv['name'], 0, 1);
                $uvArray[$sub][] = $uv;
            }
        }
        else if($order === 'rate')
        {
            //Order by rate
            $uvs = $commentRepository->uvsOrderedByRate(0, true, 0, $category, true);

            if($groupedByLetter === false)
            {
                return new Response(json_encode($uvs));
            }

            foreach($uvs as $uv)
            {
                $uvArray[ceil($uv['globalRate'])][] = $uv;
            }
        }

        $response = new Response(json_encode($uvArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;
    }

    public function uvDetailsAction($uvname)
    {
        if(empty($uvname))
        {
            return new Response(json_encode(array('status' => 'error')));
        }

        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $pollRepository = $manager->getRepository('UvwebUvBundle:Poll');

      //  $uv = $uvRepository->findOneBy(array('name' => $uvname, 'archived' => 0));

        $uv = $uvRepository
            ->createQueryBuilder('u')
            ->select('u.id, u.name, u.title, u.tp, u.final')
            ->where('u.name = :uvname')
            ->andWhere('u.uni = NULL')
            ->setParameter('uvname', $uvname)
            ->getQuery()
            ->getArrayResult();

        if (!$uv)
        {
           return new Response(json_encode(array('status' => 'error')));
        }

        //Array containing only one entry
        $uv = $uv[0];

        $comments = $commentRepository
                    ->createQueryBuilder('c')
                    ->join('c.uv', 'u')
                    ->join('c.author', 'us')
                    ->select('c.id, c.globalRate, c.date, c.semester, c.passed, c.comment, us.identity as identity')
                    ->where('u.name = :uvname')->setParameter('uvname', $uvname)
                    ->andWhere('c.moderated = :moderated')->setParameter('moderated', true)
                    ->getQuery()
                    ->getArrayResult();

        foreach($comments as &$comment)
        {
            $comment['comment'] = strip_tags($comment['comment']);
            $comment['date'] = $comment['date']->format('d/m/Y');
        }

        $averageRate = $commentRepository->averageRate($uvRepository->findOneByName($uvname));

        $polls = $pollRepository
                    ->createQueryBuilder('p')
                    ->select('p.successRate, p.year, p.season')
                    ->where('p.uvName = :uvname')->setParameter('uvname', $uvname)
                    ->orderBy('p.year', 'desc')
                    ->addOrderBy('p.season', 'asc')
                    ->setMaxResults(3)
                    ->getQuery()
                    ->getArrayResult();

        $details = array(
            'uv' => $uv,
            'comments' => $comments,
            'averageRate' => $averageRate,
            'polls' => $polls
        );

        $response = new Response(json_encode(array('status' => 'success', 'details' => $details)));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;
    }

    public function recentActivityAction()
    {
        $commentRepository = $this->getDoctrine()->getManager()->getRepository('UvwebUvBundle:Comment');

        $comments = $commentRepository
                    ->createQueryBuilder('c')
                    ->select('c.id, c.globalRate, c.semester, c.passed, c.comment, c.date, us.identity as identity, u.name as name, u.title as title')
                    ->join('c.uv', 'u', 'WITH', 'u.uni = NULL')
                    ->join('c.author', 'us')
                    ->where('c.moderated = :moderated')->setParameter('moderated', true)
                    ->setMaxResults(30)
                    ->setFirstResult(0)
                    ->orderBy('c.id', 'DESC')
                    ->getQuery()
                    ->getArrayResult();

        foreach($comments as &$comment)
        {
            $comment['comment'] = strip_tags($comment['comment']);
            $comment['date'] = $comment['date']->format('d/m/Y');
        }

        $response = new Response(json_encode(array('status' => 'success', 'comments' => $comments)));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;
    }

    public function postCommentAction($uvname)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        $currentUser = $this->getUser();

        $manager = $this->getDoctrine()->getManager();

        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $userRepository = $manager->getRepository("UvwebUvBundle:User");

        $author = $userRepository->find($currentUser->getId());
        $uv = $uvRepository->findOneBy(array('name' => $uvname, 'archived' => 0, 'uni' => null));

        if ($uv == null)
        {
            $response->setContent(json_encode("Cette UV n'existe pas ou plus."));
            $response->setStatusCode(404);
            return $response;
        }

        //Has the user already commented this UV in the past?
        if($commentRepository->userAlreadyCommentedUv($author, $uv))
        {
            $response->setContent(json_encode("UV déjà commentée."));
            $response->setStatusCode(500);
            return $response;
        }

        $comment = new Comment();
        $comment->setUv($uv);

        $form = $this->createForm(new CommentRestType($uv, $this->get('uvweb_comment.commenthelper')), $comment);
        $this->createFormBuilder($comment);

        $request = $this->getRequest();

        $requestData = json_decode($request->getContent(), true);

        //Did not work with $form->bind($requestData)...
        $form->bind(array(
                'comment' => $requestData['comment'],
                'pedagogy' => $requestData['pedagogy'],
                'workAmount' => $requestData['workAmount'],
                'semester' => $requestData['semester'],
                'interest' => $requestData['interest'],
                'globalRate' => $requestData['globalRate'],
                'passed' =>  $requestData['passed'],
                'utility' => $requestData['utility']
            ));

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
                $response->setContent(json_encode("Erreur lors de l'insertion.\n" . $e->getMessage()));
                $response->setStatusCode(500);
                return $response;
            }
        }
        else
        {
            $response->setContent(json_encode(array("Erreur lors de la validation du formulaire.")));
            $response->setStatusCode(500);
            return $response;
        }

        return new Response(json_encode('Commentaire ajouté avec succès.'));
    }

    public function userAllowedToCommentAction($uvname)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        $currentUser = $this->getUser();

        $manager = $this->getDoctrine()->getManager();

        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');
        $uvRepository = $manager->getRepository("UvwebUvBundle:Uv");
        $userRepository = $manager->getRepository("UvwebUvBundle:User");

        $author = $userRepository->find($currentUser->getId());
        $uv = $uvRepository->findOneBy(array('name' => $uvname, 'archived' => 0, 'uni' => null));

        if ($uv == null)
        {
            $response->setContent(json_encode("Cette UV n'existe pas ou plus."));
            $response->setStatusCode(404);
            return $response;
        }

        //Has the user already commented this UV in the past?
        if($commentRepository->userAlreadyCommentedUv($author, $uv))
        {
            $response->setContent(json_encode(array("alreadyCommented" =>true)));
            return $response;
        }

        //UV exists and was not commented by the user
        $response->setContent(json_encode(array("alreadyCommented" => false)));

        return $response;
    }
}
?>
