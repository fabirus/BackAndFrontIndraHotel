<?php

namespace Indra\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction(){
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('IndraAdminBundle:Article')->findAll();

        return $this->render('IndraClientBundle:Blog:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function showAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('IndraAdminBundle:Article')->find($id);

        return $this->render('IndraClientBundle:Blog:show.html.twig', array(
            'entity' => $entity,
        ));
    }
}
