<?php
 
namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class WebServiceController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retourne un tableau contenant la liste des UVs en JSON
     */
    public function uvListAction($category, $order)
    {
        $manager = $this->getDoctrine()->getManager();
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');

        if($order === 'name')
        {
            //Order by name
            $uvs = $commentRepository->uvsOrderedByName(0, $category, true);

            $groupedUvs = array(); //Will contain an array of type ['letter'] => array(UV1, UV2) with UV1, UV2 like 'letter%'
            $sub = '';

            foreach($uvs as $uv) 
            {
                $sub = substr($uv['name'], 0, 1);
                $groupedUvs[$sub][] = $uv;
            }
        }
        else if($order === 'rate')
        {
            //Order by rate
            $uvs = $commentRepository->uvsOrderedByRate(0, true, 0, $category, true);

            $groupedUvs = array();
            foreach($uvs as $uv)
            {
                $groupedUvs[ceil($uv['globalRate'])][] = $uv;
            }
        }

        return new Response(json_encode($groupedUvs));
    }

    public function uvDetailsAction()
    {
        $uvname = $this->getRequest()->request->get('uvname');

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
            ->where('u.name = :uvname')
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
                    ->select('c.id, c.globalRate, c.semester, c.passed, c.comment, us.identity as identity')
                    ->where('u.name = :uvname')->setParameter('uvname', $uvname)
                    ->andWhere('c.moderated = :moderated')->setParameter('moderated', true)
                    ->getQuery()
                    ->getArrayResult();

        foreach($comments as &$comment)
            $comment['comment'] = strip_tags($comment['comment']);

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

        return new Response(json_encode(array('status' => 'success', 'details' => $details)));
    }

    public function recentActivityAction()
    {
        $commentRepository = $this->getDoctrine()->getManager()->getRepository('UvwebUvBundle:Comment');

        $comments = $commentRepository
                    ->createQueryBuilder('c')
                    ->select('c.id, c.globalRate, c.semester, c.passed, c.comment, us.identity as identity, u.name as name, u.title as title')
                    ->join('c.uv', 'u')
                    ->join('c.author', 'us')
                    ->where('c.moderated = :moderated')->setParameter('moderated', true)
                    ->setMaxResults(30)
                    ->setFirstResult(0)
                    ->orderBy('c.id', 'DESC')
                    ->getQuery()
                    ->getArrayResult();

        foreach($comments as &$comment)
            $comment['comment'] = strip_tags($comment['comment']);

        return new Response(json_encode(array('status' => 'success', 'comments' => $comments)));
    }
}
?>