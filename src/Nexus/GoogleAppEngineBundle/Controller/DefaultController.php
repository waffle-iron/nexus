<?php

namespace Nexus\GoogleAppEngineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller{

    public function indexAction(){
        return $this->render('NexusGoogleAppEngineBundle:Default:index.html.twig');
    }
}
