<?php

namespace Indra\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('IndraAdminBundle:CategorieChambre')->findAll();

        return $this->render('IndraClientBundle:Home:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}
