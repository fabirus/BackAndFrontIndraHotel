<?php

namespace Indra\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChambreController extends Controller
{
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('IndraAdminBundle:Chambre')->findAll();

        return $this->render('IndraAdminBundle:Chambre:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}
