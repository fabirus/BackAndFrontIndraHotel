<?php

namespace Indra\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
class AdminController extends Controller
{
    public function indexAction()
    {
//        $em                 = $this->getDoctrine()->getManager();
//        $contrats           = $em->getRepository('JanetTransitAdminBundle:Contrat')->findAll();
//
//        $depenses           = $em->getRepository('JanetTransitAdminBundle:Depense')->findBy(
//            array('del' => 0)
//        );
//        $employes           = $em->getRepository('JanetTransitAdminBundle:Employe')->findBy(
//            array('del' => 0)
//        );

        return $this->render('IndraAdminBundle:Admin:index.html.twig', array(
//            'contrat'       => $this->verifContrat($contrats),
//            'depense'       => $this->verifDepense($depenses),
//            'presence'      => $this->verifPresence($employes),
        ));
    }

    public function verifTache($taches){
        $tacheArray['response'] = false;

        if(count($taches) > 0) {
            foreach ($taches as $tache) {
                if ($tache->getEtat() != 0) {
                    $tacheArray['response'] = true;
                    $tacheArray['entity'] = $tache;
                    break;
                }
            }
        }
        return $tacheArray;
    }

    public function verifPresence($employes){
        $tacheArray['response'] = false;
        $dayArray               = [date('d/m/Y'), date('d/m/Y', strtotime(' -1 day')), date('d/m/Y', strtotime(' -2 day'))];
        $em                     = $this->getDoctrine()->getManager();

        foreach($dayArray as $day){
            $presences   = $em->getRepository('JanetTransitAdminBundle:Presence')->findBy(
                array('at' => $day)
            );
            if(count($employes) > count($presences)) {
                $tacheArray['response'] = true;
                $tacheArray['entity'] = $day;
                break;

            }
        }

        return $tacheArray;
    }

    public function verifContrat($contrats){
        $contratArray['response'] = false;
        $now                = time();

        if(count($contrats) > 0){
            foreach($contrats as $contrat){
                $dateEn = strtotime(str_replace('/', '-', $contrat->getDateFin()));
                $datediff = $now - $dateEn;
                if($datediff/(60*60*24) <= 10){
                    $contratArray['response'] = true;
                    $contratArray['entity']   = $contrat;
                    break;
                }
            }
        }
        return $contratArray;
    }

    public function verifDocumentVoiture($documents){
        $documentArray['response'] = false;
        $now                       = time();

        if(count($documents) > 0){
            foreach($documents as $document){
                $dateEn = strtotime(str_replace('/', '-', $document->getDateEcheance()));
                $datediff = $now - $dateEn;
                if($datediff/(60*60*24) <= 10){
                    $documentArray['response'] = true;
                    $documentArray['entity']   = $document;
                    break;
                }
            }
        }
        return $documentArray;
    }

    public function verifCarburation($carburations){
        $carburationArray['response'] = false;

        if(count($carburations) > 0){
            foreach($carburations as $carburation){
                if ($carburation->isValid() != 0) {
                    $carburationArray['response'] = true;
                    $carburationArray['entity'] = $carburation;
                    break;
                }
            }
        }
        return $carburationArray;
    }

    public function verifDepense($depenses){
        $depenseArray['response'] = false;

        if(count($depenses) > 0){
            foreach($depenses as $depense){
                if ($depense->isValid() != 0) {
                    $depenseArray['response'] = true;
                    $depenseArray['entity']   = $depense;
                    break;
                }
            }
        }
        return $depenseArray;
    }

    public function verifManutention($manutentions){
        $manutentionArray['response'] = false;

        if(count($manutentions) > 0){
            foreach($manutentions as $manutention){
                if ($manutention->isValid() != 0) {
                    $manutentionArray['response'] = true;
                    $manutentionArray['entity']   = $manutention;
                    break;
                }
            }
        }
        return $manutentionArray;
    }

}
