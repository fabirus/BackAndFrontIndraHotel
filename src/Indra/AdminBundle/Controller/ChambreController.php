<?php

namespace Indra\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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

    public function searchAction()
    {
        $request    = $this->get('request');
        $json       = array();
        $searchText = '';
        $searchText = $request->query->get('searchText');
        $em         = $this->getDoctrine()->getManager();
        if($request->isXmlHttpRequest()) {

            if ($searchText !== '') {
                $query = $this->getDoctrine()
                    ->getRepository('IndraAdminBundle:Chambre')
                    ->createQueryBuilder('c')
                    ->select('c')
                    ->leftJoin('c.categorie', 'ct')
                    ->addSelect('ct')
                    ->where('ct.prix LIKE :searchText OR ct.nom LIKE :searchText OR c.numero LIKE :searchText')
                    ->setParameter('searchText', '%'.$searchText.'%')
                    ->getQuery()
                ;
                $entities = $query->getArrayResult();
            }
            else {
                $entities = $em->getRepository('IndraAdminBundle:Chambre')->findAll();
            }

            $json['view'] = $this->renderView('IndraAdminBundle:Chambre:search.html.twig',
                array(
                    'entities' => $entities,
                    'searchText' => $searchText
                ));

            $response = new Response(json_encode($json));
            return $response;
        }
        else{
            $this->indexAction();

        }
    }
}
