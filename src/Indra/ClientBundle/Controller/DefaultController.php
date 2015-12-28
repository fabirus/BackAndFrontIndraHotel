<?php

namespace Indra\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IndraClientBundle:Default:index.html.twig', array('name' => $name));
    }
}
