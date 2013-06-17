<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexandre
 * Date: 26/05/13
 * Time: 12:15
 * To change this template use File | Settings | File Templates.
 */

namespace Uvweb\UvBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class BaseController extends Controller
{

    protected $searchBarForm;
    protected $encoders;

    public function __construct()
    {
        $this->encoders = array(new JsonEncoder());
    }

    /**
     * that method allows us to generate search bar form from anywhere
     */
    protected function initSearchBar()
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('statement', 'text', array('required' => false));
        $this->searchBarForm = $formBuilder->getForm();

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $this->searchBarForm->bind($request);
            if ($this->searchBarForm->isValid()) {
                return $this->redirect($this->generateUrl('uvweb_uv_detail', array('uvname' => $this->searchBarForm->getData()['statement'])));
            }
        }
    }
}