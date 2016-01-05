<?php

namespace Indra\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Indra\AdminBundle\Entity\Reservation;
use Indra\AdminBundle\Form\ReservationType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Reservation controller.
 *
 * @Route("/reservation")
 */
class ReservationController extends Controller
{

    /**
     * Lists all Reservation entities.
     *
     * @Route("/", name="reservation")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = new Reservation();
        $form       = $this->createCreateForm($entity);
        $entities = $em->getRepository('IndraAdminBundle:Reservation')->findAll();

        return array(
            'entities' => $entities,
            'form'     => $form->createView(),
        );
    }

    /**
     * Lists all Room By passing id of entity Categrory Room.
     *
     * @Route("/poste/service/{id}", name="poste_of_service")
     * @Method("GET")
     * @Template()
     */
    public function chambreCategorieAction($id)
    {
        $em       = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('IndraAdminBundle:Chambre')->findBy(array(
            'categorie' => $id

        ));

        $json['view'] = $this->renderView('IndraAdminBundle:Reservation:roomCategorie.html.twig',
            array(
                'entities' => $entities
            ));

        $response = new Response(json_encode($json));
        return $response;

    }
    /**
     * Creates a new Reservation entity.
     *
     * @Route("/", name="reservation_create")
     * @Method("POST")
     * @Template("IndraAdminBundle:Reservation:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Reservation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setUpdatedAt(new DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->operationUpdate($entity, 'CREATION');

            return $this->redirect($this->generateUrl('reservation_informations'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Operation Create Entity
     */

    public function operationUpdate($entity, $action) {
        $user  = $this->get('security.context')->getToken()->getUser();
        $data   = array(
            "id"                =>  $entity->getId(),
            "entite"            => 'RESERVATIOn',
            "nom"               =>  $entity->getNom(),
            "telephome"         =>  $entity->getTel(),
            "TypeChambre"       =>  $action == 'SUPPRESSION' ? 'none' : $entity->getCategorieChambre(),
            "Chambre"           =>  $action == 'SUPPRESSION' ? 'none' : $entity->getChambre(),
            'heure'             =>  $entity->getHeure(),
            "Arrivée"           =>  $entity->getArrive(),
            "Départ"            =>  $entity->getDepart(),
            "email"             =>  $entity->getEmail()

        );

        $this->get('application.operation')->update($data, $user, $action);

    }

    /**
     * Creates a form to create a Reservation entity.
     *
     * @param Reservation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Reservation $entity)
    {
        $form = $this->createForm(new ReservationType(), $entity, array(
            'action' => $this->generateUrl('reservation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }


    /**
     * Finds and displays a Reservation entity.
     *
     * @Route("/{id}", name="reservation_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:Reservation')->find($id);
        $editForm = $this->createEditForm($entity);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reservation entity.');
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Reservation entity.
    *
    * @param Reservation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Reservation $entity)
    {
        $form = $this->createForm(new ReservationType(), $entity, array(
            'action' => $this->generateUrl('reservation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Reservation entity.
     *
     * @Route("/{id}", name="reservation_update")
     * @Method("PUT")
     * @Template("IndraAdminBundle:Reservation:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:Reservation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reservation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
//            $entity->setUpdatedAt(new DateTime());
            $em->flush();
            $this->operationUpdate($entity, 'MODIFICATION');
            return $this->redirect($this->generateUrl('reservation_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
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
        $entity = $em->getRepository('IndraAdminBundle:Reservation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reservation entity.');
        }

        $entity->setDel($del);
        $em->flush();
        if ($del == 1){
            $this->operationUpdate($entity, 'SUPPRESSION');
        }

        return $this->redirect($this->generateUrl('reservation_show', array('id' => $id)));
    }

}
