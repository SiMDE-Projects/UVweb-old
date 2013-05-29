<?php

namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class ProfileController extends BaseController{
    public function displayAction($userid) {
        /** those lines allow redirection after submitting search bar form */
        if ($redirect = $this->initSearchBar()) {
            return $redirect;
        }


        return $this->render("UvwebUvBundle:Profile:profile.html.twig", array(
            'searchbar' => $this->searchBarForm->createView()
        ));
    }
}