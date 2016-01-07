<?php

namespace Indra\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    public function indexAction(){

        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('IndraAdminBundle:Employe')->findBy(
            array('del' => '0')
        );

        return $this->render('IndraClientBundle:AboutUs:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}
