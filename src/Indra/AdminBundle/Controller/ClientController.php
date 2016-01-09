<?php

namespace Indra\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Indra\AdminBundle\Entity\Client;
use Indra\AdminBundle\Form\ClientType;

/**
 * Client controller.
 *
 * @Route("/client")
 */
class ClientController extends Controller
{

    /**
     * Lists all Client entities.
     *
     * @Route("/", name="client")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity     = new Client();
        $form       = $this->createCreateForm($entity);

        $entities = $em->getRepository('IndraAdminBundle:Client')->findAll();

        return array(
            'entities' => $entities,
            'form'     => $form->createView()
        );
    }
    /**
     * Creates a new Client entity.
     *
     * @Route("/", name="client_create")
     * @Method("POST")
     * @Template("IndraAdminBundle:Client:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Client();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Client ajoutée avec Succès !!');

            return $this->redirect($this->generateUrl('client_informations'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Client entity.
     *
     * @param Client $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Client $entity)
    {
        $form = $this->createForm(new ClientType(), $entity, array(
            'action' => $this->generateUrl('client_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     * @Route("/{id}/edit", name="client_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:Client')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Client entity.
    *
    * @param Client $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Client $entity)
    {
        $form = $this->createForm(new ClientType(), $entity, array(
            'action' => $this->generateUrl('client_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Client entity.
     *
     * @Route("/{id}", name="client_update")
     * @Method("PUT")
     * @Template("IndraAdminBundle:Client:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:Client')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Modification du Client avec Succès !!');


            return $this->redirect($this->generateUrl('client_informations'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
}
