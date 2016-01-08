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
        $votes   = $em->getRepository('IndraAdminBundle:Rating')->findBy(
            array(),
            array('updatedAt' => 'desc'),
            6
        );

        return $this->render('IndraClientBundle:Home:index.html.twig', array(
            'entities'    => $entities,
            'partenaires' => $partenaires[0],
            'votes'       => $votes
        ));
    }

    public function lastArticleAction()
    {
        $em          = $this->getDoctrine()->getManager();
        $articles   = $em->getRepository('IndraAdminBundle:Article')->findBy(
            array(),
            array('updatedAt' => 'desc'),
            4
        );

        return $this->render('IndraClientBundle:Home:lastArticle.html.twig', array(
            'articles'    => $articles
        ));
    }
}
