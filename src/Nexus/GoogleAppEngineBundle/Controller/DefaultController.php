<?php

namespace Nexus\GoogleAppEngineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller{

    public function test($max = 1){
        return "the max is ". $max;
    }

    public function indexAction(){
        return $this->render('NexusGoogleAppEngineBundle:Default:index.html.twig');
    }
}
