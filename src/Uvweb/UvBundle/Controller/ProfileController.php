<?php

namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class ProfileController extends BaseController{
    public function displayAction($userid) {
        /** those lines allow redirection after submitting search bar form */
        if ($redirect = $this->initSearchBar()) {
            return $redirect;
        }

        $manager = $this->getDoctrine()->getManager();
        $userRepository = $manager->getRepository("UvwebUvBundle:User");
        $commentRepository = $manager->getRepository('UvwebUvBundle:Comment');

        $user = $userRepository->find($userid);
        if ($user == null) throw $this->createNotFoundException("Cet utilisateur n'existe pas ou plus");

        $comments = $commentRepository->findBy(
            array('author' => $user, 'moderated' => true),
            array('date' => 'desc'),
            20,
            0);

        return $this->render("UvwebUvBundle:Profile:profile.html.twig", array(
            'searchbar' => $this->searchBarForm->createView(),
            'user' => $user,
            'comments' => $comments
        ));
    }
}