<?php

namespace Indra\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Indra\AdminBundle\Entity\FactureReception;
use Indra\AdminBundle\Form\FactureReceptionType;

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

        $entities = $em->getRepository('IndraAdminBundle:FactureReception')->findAll();

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
            $em->persist($entity);
            $em->flush();
            $this->updateChambre($chambre, $em, 1);
            $this->get('session')->getFlashBag()->add('success', 'Facture ajoutée avec Succès !!');

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
            "entite"            => 'RESERVATIOn',
            "nom"               =>  $entity->getNom(),
            "telephome"         =>  $entity->getTel(),
            "TypeChambre"       =>  $action == 'SUPPRESSION' ? 'none' : $entity->getCategorieChambre()->getNom(),
            "Chambre"           =>  $action == 'SUPPRESSION' || $entity->getChambre() == null ? '0' : $entity->getChambre()->getNumero(),
            'heure'             =>  $entity->getHeure(),
            "Arrivée"           =>  $entity->getArrive(),
            "Départ"            =>  $entity->getDepart(),
            "email"             =>  $entity->getEmail()

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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactureReception entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing FactureReception entity.
     *
     * @Route("/{id}/edit", name="facturereception_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactureReception entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactureReception entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('facturereception_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a FactureReception entity.
     *
     * @Route("/{id}", name="facturereception_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IndraAdminBundle:FactureReception')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FactureReception entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('facturereception'));
    }

    /**
     * Creates a form to delete a FactureReception entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facturereception_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
