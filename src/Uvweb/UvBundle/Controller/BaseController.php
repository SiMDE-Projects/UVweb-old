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
use Uvweb\UvBundle\Forms\SearchStatement;


class BaseController extends Controller{

    protected $searchBarForm;

    /**
     * that method allows us to generate search bar form from anywhere
     */
    protected function initSearchBar() {
        $search = new SearchStatement;
        $formBuilder = $this->createFormBuilder($search);
        $formBuilder->add('statement', 'text');
        $this->searchBarForm = $formBuilder->getForm();

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $this->searchBarForm->bind($request);
            if ($this->searchBarForm->isValid()) {
                return $this->redirect($this->generateUrl('uvweb_uv_detail', array('uvname' => $search->getStatement())));
            }
        }
    }
}