<?php

namespace Indra\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChambreController extends Controller
{
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('IndraAdminBundle:CategorieChambre')->findAll();

        return $this->render('IndraClientBundle:Chambre:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}
