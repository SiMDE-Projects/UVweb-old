<?php

namespace Uvweb\UvBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class ProfileController extends BaseController{
    public function displayAction($userid) {
        return new Response("<body></body>");
    }
}