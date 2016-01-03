<?php

namespace Indra\WikiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Indra\WikiBundle\Entity\Category;

class WikiController extends Controller
{
    public function indexAction(){

        $em         = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('IndraWikiBundle:Category')->findBy(array('parent' => null));

        return $this->render('IndraWikiBundle:Wiki:index.html.twig', array(
            'categories' => $categories,
            'infos'      => 'Catégories'
        ));
    }

    public function articlesAction($id){

        $em         = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('IndraWikiBundle:Category')->findBy(array('parent' => $id));
        $articles   = $em->getRepository('IndraWikiBundle:Article')->findBy(array('category' => $id));
        $category   = $em->getRepository('IndraWikiBundle:Category')->find($id);

        if (count($categories) > 0) {
            return $this->render('IndraWikiBundle:Wiki:index.html.twig', array(
                'categories' => $categories,
                'infos'      => 'Sous-Catégories'
            ));
        }
        else {
//            count($category->getArticles());

            return $this->render('IndraWikiBundle:Wiki:article.html.twig', array(
                'articles' => $articles,
                'category' => $category
            ));
        }
    }

    public function showAction($id, $idCat){
        $em         = $this->getDoctrine()->getManager();
        $article    = $em
            ->getRepository('IndraWikiBundle:Article')
            ->find($id);

        return $this->render('IndraWikiBundle:Wiki:show.html.twig', array(
            'article' => $article,
            'idCat'   => $idCat
        ));

    }
}
