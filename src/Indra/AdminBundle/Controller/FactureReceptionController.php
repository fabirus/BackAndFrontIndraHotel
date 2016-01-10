<?php

namespace Indra\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Indra\AdminBundle\Entity\FactureReception;
use Indra\AdminBundle\Form\FactureReceptionType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Intl\DateFormatter\DateFormat;

/**
 * FactureReception controller.
 *
 * @Route("/facturereception")
 */
class FactureReceptionController extends Controller
{

    /**
     * Lists all FactureReception entities.
     *
     * @Route("/", name="facturereception")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = new FactureReception();
        $form       = $this->createCreateForm($entity);

        $entities = $em->getRepository('IndraAdminBundle:FactureReception')->findGroupDateBuilder();

        return array(
            'entities' => $entities,
            'form'     => $form->createView(),
        );
    }
    /**
     * Creates a new FactureReception entity.
     *
     * @Route("/", name="facturereception_create")
     * @Method("POST")
     * @Template("IndraAdminBundle:FactureReception:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity         = new FactureReception();
        $em             = $this->getDoctrine()->getManager();
        $dataform       = $request->request->get('indra_adminbundle_facturereception');
        $idChambre      = $dataform['chambre'];
        $chambre        = $em->getRepository('IndraAdminBundle:Chambre')->find($idChambre);
        $user           = $this->get('security.context')->getToken()->getUser();
        $form           = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setReceptionniste($user->getFirstname().' '. $user->getLastname());
            $entity->setUpdatedAt(date('Y-m-d H:i:s'));
            $em->persist($entity);
            $em->flush();
            $this->updateChambre($chambre, $em, 1);
            $this->get('session')->getFlashBag()->add('success', 'Facture ajoutée avec Succès !!');
            $this->operationUpdate($entity, 'CREATION');


            return $this->redirect($this->generateUrl('facturereception_informations'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    public function updateChambre($entity, $em, $statut){

        $entity->setStatut($statut);
        $em->flush();
    }

    /**
     * Operation Create Entity
     */

    public function operationUpdate($entity, $action) {
        $user  = $this->get('security.context')->getToken()->getUser();
        $data   = array(
            "id"                =>  $entity->getId(),
            "entite"            => 'FACTURE RECEPTION',
            "nom"               =>  $entity->getClient()->getNom(),
            "montant"           =>  $entity->getMontant(),
            "hambre"            =>  $entity->getChambre()->getNumero(),
            "Arrivée"           =>  $entity->getDateArrive(),
            "Départ"            =>  $entity->getDateDepart(),
        );

        $this->get('application.operation')->update($data, $user, $action);

    }

    /**
     * Creates a form to create a FactureReception entity.
     *
     * @param FactureReception $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FactureReception $entity)
    {
        $form = $this->createForm(new FactureReceptionType(), $entity, array(
            'action' => $this->generateUrl('facturereception_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a FactureReception entity.
     *
     * @Route("/{id}", name="facturereception_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);

        $entities = $em->getRepository('IndraAdminBundle:FactureReception')->findBy(
            array('updatedAt' => $entity->getUpdatedAt())
        );

        return array(
            'entities'    => $entities,
            'entityDate'  => $entity
        );

    }

    /**
     * Finds and displays a AvanceSalaire entity.
     *
     * @Route("/avancesalaire/{id}/{idEmploye}", name="avancesalaire_print")
     * @Method("GET")
     * @Template("")
     */
    public function printAction($id, $idDate)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);
        $editForm   = $this->createEditForm($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactureReception entity.');
        }

        return array(
            'entity'        => $entity,
            'form'          => $editForm->createView(),
            'idDate'        => $idDate
        );
    }


    /**
    * Creates a form to edit a FactureReception entity.
    *
    * @param FactureReception $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FactureReception $entity)
    {
        $form = $this->createForm(new FactureReceptionType(), $entity, array(
            'action' => $this->generateUrl('facturereception_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing FactureReception entity.
     *
     * @Route("/{id}", name="facturereception_update")
     * @Method("PUT")
     * @Template("IndraAdminBundle:FactureReception:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em         = $this->getDoctrine()->getManager();
        $idDate     = $request->request->get('idDate');
        $entity     = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);
        $user       = $this->get('security.context')->getToken()->getUser();


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactureReception entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setReceptionniste($user->getFirstname().' '. $user->getLastname());
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Facture Modifiée avec Succès !!');
            $this->operationUpdate($entity, 'MODIFICATION');


            return $this->redirect($this->generateUrl('facturereception_print', array(
                'id' => $id,
                'idDate' => $idDate)
            ));
        }

        return array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
        );
    }


    /**
     * Valid AvanceSalaire entity.
     *
     * @Route("/avancesalaire/{id}/{valid}/{idEmploye}", name="avancesalaire_valid")
     * @Method("VALID")
     */
    public function validPaieAction($id, $valid, $idDate)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactureReception entity.');
        }
        $entity->setPaye($valid);
        $em->flush();

        if($valid == 1){
            $this->get('session')->getFlashBag()->add('error', 'Facture non Payée !!');
        }

        if($valid == 0) {
            $this->get('session')->getFlashBag()->add('success', 'Facture Payée !!');
        }

        return $this->redirect($this->generateUrl('facturereception_show', array('id' => $idDate)));
    }

    /**
     * Valid AvanceSalaire entity.
     *
     * @Route("/avancesalaire/{id}/{valid}/{idEmploye}", name="avancesalaire_valid")
     * @Method("VALID")
     */
    public function validOccupationAction($id, $valid, $idChambre, $idDate)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);
        $chambre    = $em->getRepository('IndraAdminBundle:Chambre')->find($idChambre);
        $this->updateChambre($chambre, $em, $valid);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactureReception entity.');
        }
        $entity->setStatut($valid);
        $em->flush();

        if($valid == 1){
            $this->get('session')->getFlashBag()->add('error', 'Chambre Occupée !!');
        }

        if($valid == 0) {
            $this->get('session')->getFlashBag()->add('success', 'Chambre Libérée !!');
        }

        return $this->redirect($this->generateUrl('facturereception_show', array('id' => $idDate)));
    }

    /**
     * Deletes a Employe entity.
     *
     * @Route("/employe/delete/{id}/{del}", name="employe_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id, $del)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactureReception entity.');
        }

        $entity->setDel($del);
        $em->flush();
        if ($del == 1){
            $this->operationUpdate($entity, 'SUPPRESSION');
        }

        return $this->redirect($this->generateUrl('facturereception_show', array('id' => $id)));
    }


}
