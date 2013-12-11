<?php

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

        $data = $this->searchBarForm->getData();

        if ($request->getMethod() == 'POST') {
            $this->searchBarForm->bind($request);
            if ($this->searchBarForm->isValid()) {
                return $this->redirect($this->generateUrl('uvweb_uv_detail', array('uvname' => $data['statement'])));
            }
        }
    }
}