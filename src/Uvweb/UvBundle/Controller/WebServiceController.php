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
}
?>