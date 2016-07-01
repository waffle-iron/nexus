<?php

namespace Nexus\GentelellaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NexusGentelellaBundle:Default:index.html.twig', array('name' => $name));
    }
}
