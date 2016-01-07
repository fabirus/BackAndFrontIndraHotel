<?php

namespace Indra\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestaurantBarController extends Controller
{
    public function indexAction(){
        $em         = $this->getDoctrine()->getManager();
        $plats      = $em->getRepository('IndraAdminBundle:Restaurant')->findAll();
        $boissons   = $em->getRepository('IndraAdminBundle:Bar')->findAll();


        return $this->render('IndraClientBundle:RestaurantBar:index.html.twig', array(
            'plats'     => $plats,
            'boissons'  => $boissons
        ));
    }

    public function showBarAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('IndraAdminBundle:Bar')->find($id);

        return $this->render('IndraClientBundle:RestaurantBar:show.html.twig', array(
            'entity' => $entity,
        ));
    }

    public function showRestoAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('IndraAdminBundle:Restaurant')->find($id);

        return $this->render('IndraClientBundle:RestaurantBar:show.html.twig', array(
            'entity' => $entity,
        ));
    }
}
