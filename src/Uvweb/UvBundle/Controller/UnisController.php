<?php
 
namespace Uvweb\UvBundle\Controller;

use Uvweb\UvBundle\Entity\University;
use Uvweb\UvBundle\Entity\Uv;
use Uvweb\UvBundle\Form\UniversityType;
use Uvweb\UvBundle\Form\UvType;

class UnisController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function unisListAction() {
        $manager = $this->getDoctrine()->getManager();
        $uniRepository = $manager->getRepository('UvwebUvBundle:University');

        $unis = $uniRepository->getWithMinimalInfo();

        return $this->render('UvwebUvBundle:Unis:all_ordered_by_country.html.twig', array('countries' => $unis));
    }

    public function listCategoryAction($category, $order, $uniId)
    {
        $manager = $this->getDoctrine()->getManager();
        $uvRepository = $manager->getRepository('UvwebUvBundle:Uv');

        $uniRepository = $manager->getRepository('UvwebUvBundle:University');
        $uni = $uniRepository->find($uniId);

        // If no category selected
        if ($category == 'all') $category = '';

        $categoryName = strtoupper($category);

        if (is_null($uni))
        {
            $this->get('uvweb_uv.fbmanager')->addFlashMessage("Université introuvable.");
            return $this->redirect($this->generateUrl('uvweb_unis_list'));
        }

        if($order === 'name' || $order === 'dynamic')
        {
            //Order by name
            $uvWithoutComment = ($order !== 'dynamic');

            $uvs = $uvRepository->uvsOrderedByName(0, $category, false, $uvWithoutComment, $uniId);

            $groupedUvs = array(); //Will contain an array of type ['letter'] => array(UV1, UV2) with UV1, UV2 like 'letter%'
            $sub = '';

            foreach($uvs as $uv) 
            {
                $sub = substr($uv['name'], 0, 1);
                $groupedUvs[$sub][] = $uv;
            }

            //return new Response('<html><body>ok</body></html>');

            if($order === 'dynamic') //Dynamic: pass the UV names to the appropriate view
            {
                return $this->render('UvwebUvBundle:Uv:all_ordered_category_ajax.html.twig', array('order' => $order, 'categoryName' => $categoryName, 'groupedUvs' => $groupedUvs));
            }
            
            return $this->render('UvwebUvBundle:Unis:all_ordered_category.html.twig', array('order' => $order, 'categoryName' => $categoryName, 'groupedUvs' => $groupedUvs, 'uni' => $uni));
        }
        else if($order === 'rate')
        {
            //Order by rate
            $uvs = $uvRepository->uvsOrderedByRate(0, true, 0, $category, false, true, $uniId);

            $groupedUvs = array();
            foreach($uvs as $uv)
            {
                $groupedUvs[ceil($uv['globalRate'])][] = $uv;
            }

            //return new Response('<html><body>ok</body></html>');

            return $this->render('UvwebUvBundle:Unis:all_ordered_by_rate.html.twig', array('order' => $order, 'categoryName' => $categoryName, 'groupedUvs' => $groupedUvs, 'uni' => $uni));
        }
    }

    public function createAction()
    {
        $uni = new University();

        $form = $this->createForm(new UniversityType(), $uni);
        $this->createFormBuilder($uni);

        $manager = $this->getDoctrine()->getManager();

        if($this->getRequest()->isMethod('POST'))
        {
            $form->bind($this->getRequest());
            if ($form->isValid())
            {
                try
                {
                    $uni->setAddedBy($userRepository->findOneById($this->getUser()->getId()));

                    $manager->persist($uni);
                    $manager->flush();
                }
                catch(\Exception $e)
                {
                    $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de l'ajout de l'université.");

                    //Insertion failed: invite the user to try again, displaying the errors
                    return $this->render('UvwebUvBundle:Unis:post.html.twig', array(
                        'add_university_form' => $form->createView()
                    ));
                }
                return $this->render('UvwebUvBundle:Unis:posted.html.twig', array('uni' => $uni));
            }
        }
        return $this->render('UvwebUvBundle:Unis:post.html.twig', array(
            'add_university_form' => $form->createView()
        ));
    }

    public function addClassAction($uniId)
    {
        $manager = $this->getDoctrine()->getManager();
        $uni = $manager->getRepository('UvwebUvBundle:University')->find($uniId);

        if (is_null($uni))
        {
            $this->get('uvweb_uv.fbmanager')->addFlashMessage("Université introuvable.");
            return $this->redirect($this->generateUrl('uvweb_unis_list'));
        }

        $uv = new Uv();

        $form = $this->createForm(new UvType(), $uv);
        $this->createFormBuilder($uv);

        if($this->getRequest()->isMethod('POST'))
        {
            $form->bind($this->getRequest());
            if ($form->isValid())
            {
                try
                {
                    $uv->setAddedBy($manager->getRepository('UvwebUvBundle:User')->findOneById($this->getUser()->getId()));
                    $uv->setUni($uni);
                    $uv->setArchived(false);
                    $uv->setApproved(false);

                    $manager->persist($uv);
                    $manager->flush();
                }
                catch(\Exception $e)
                {
                    var_dump($e);
                    $this->get('uvweb_uv.fbmanager')->addFlashMessage("Une erreur s'est produite lors de l'ajout du cours.");

                    //Insertion failed: invite the user to try again, displaying the errors
                    return $this->render('UvwebUvBundle:Unis:post_class.html.twig', array(
                        'uni' => $uni,
                        'add_uv_form' => $form->createView()
                    ));
                }
                return $this->render('UvwebUvBundle:Unis:posted_class.html.twig', array('uni' => $uni, 'uv' => $uv));
            }
        }
        return $this->render('UvwebUvBundle:Unis:post_class.html.twig', array(
            'uni' => $uni,
            'add_uv_form' => $form->createView()
        ));

    }

    public function validateUniAction($uniId)
    {
        $manager = $this->getDoctrine()->getManager();

        $uniRepository = $manager->getRepository('UvwebUvBundle:University');
        $uni = $uniRepository->find($uniId);

        if (is_null($uni))
        {
            $this->get('uvweb_uv.fbmanager')->addFlashMessage("Université introuvable.");
            return $this->redirect($this->generateUrl('uvweb_unis_list'));
        }

        $uni->setApproved(true);

        $manager->persist($uni);
        $manager->flush();

        return $this->redirect($this->generateUrl('uvweb_admin_home'));
    }

    public function refuseUniAction($uniId)
    {
        $manager = $this->getDoctrine()->getManager();

        $uniRepository = $manager->getRepository('UvwebUvBundle:University');
        $uni = $uniRepository->find($uniId);

        if (is_null($uni))
        {
            $this->get('uvweb_uv.fbmanager')->addFlashMessage("Université introuvable.");
            return $this->redirect($this->generateUrl('uvweb_unis_list'));
        }

        $manager->remove($uni);
        $manager->flush();

        return $this->redirect($this->generateUrl('uvweb_admin_home'));
    }

    public function validateClassAction($classId)
    {
        $manager = $this->getDoctrine()->getManager();

        $uvRepository = $manager->getRepository('UvwebUvBundle:Uv');
        $uv = $uvRepository->find($classId);

        if (is_null($uv))
        {
            $this->get('uvweb_uv.fbmanager')->addFlashMessage("UV introuvable.");
            return $this->redirect($this->generateUrl('uvweb_unis_list'));
        }

        $uv->setApproved(true);

        $manager->persist($uv);
        $manager->flush();

        return $this->redirect($this->generateUrl('uvweb_admin_home'));
    }

    public function refuseClassAction($classId)
    {
        $manager = $this->getDoctrine()->getManager();

        $uvRepository = $manager->getRepository('UvwebUvBundle:Uv');
        $uv = $uvRepository->find($classId);

        if (is_null($uv))
        {
            $this->get('uvweb_uv.fbmanager')->addFlashMessage("UV introuvable.");
            return $this->redirect($this->generateUrl('uvweb_unis_list'));
        }

        $manager->remove($uv);
        $manager->flush();

        return $this->redirect($this->generateUrl('uvweb_admin_home'));
    }
}
