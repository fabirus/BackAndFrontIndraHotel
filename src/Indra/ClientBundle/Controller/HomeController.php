<?php

namespace Indra\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $em          = $this->getDoctrine()->getManager();
        $entities    = $em->getRepository('IndraAdminBundle:CategorieChambre')->findAll();
        $partenaires = $em->getRepository('IndraAdminBundle:Gallery')->findBy(
            array('nom' => 'partenaires')
        );

        return $this->render('IndraClientBundle:Home:index.html.twig', array(
            'entities'    => $entities,
            'partenaires' => $partenaires[0]
        ));
    }
}
