<?php

namespace Indra\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Indra\AdminBundle\Entity\PeriodeDepense;
use Indra\AdminBundle\Form\PeriodeDepenseType;
use Symfony\Component\HttpFoundation\Response;

/**
 * PeriodeDepense controller.
 *
 * @Route("/periodedepense")
 */
class PeriodeDepenseController extends Controller
{

    /**
     * Lists all PeriodeDepense entities.
     *
     * @Route("/", name="periodedepense")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($idTypeDepense)
    {
        $em             = $this->getDoctrine()->getManager();
        $entity         = new PeriodeDepense();
        $form           = $this->createCreateForm($entity);
        $typeDépense    = $em->getRepository('IndraAdminBundle:TypeDepense')->find($idTypeDepense);
        $entities       = $em->getRepository('IndraAdminBundle:PeriodeDepense')->findBy(
            array('typeDepense' => $idTypeDepense)
        );
        return array(
            'entities'      => $entities,
            'idTypeDepense' => $idTypeDepense,
            'typeDepense'   => $typeDépense,
            'form'          => $form->createView()
        );
    }

    /**
     * Check Date.
     *
     * @Route("/avancesalairecheckDate/{idEmploye}", name="avancesalaire_checkDate")
     * @Method("GET")
     * @Template()
     */
    public function checkDateAction($idTypeDepense){

        $request        = $this->get('request');
        $date           = $request->query->get('date');
        $em             = $this->getDoctrine()->getManager();

        $entities   = $em->getRepository('IndraAdminBundle:PeriodeDepense')->findBy(
            array('typeDepense' => $idTypeDepense, 'dateDepense' => $date, 'del' => 0)
        );

        if(count($entities) == 0) {
            $response = new Response('false');
        }
        else {
            $response = new Response('true');
        }
        return $response;

    }

    /**
     * Creates a new PeriodeDepense entity.
     *
     * @Route("/", name="periodedepense_create")
     * @Method("POST")
     * @Template("IndraAdminBundle:PeriodeDepense:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity             = new PeriodeDepense();
        $dataform           = $request->request->get('indra_adminbundle_periodedepense');
        $idTypeDepense      = $dataform['typeDepense'];
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('periodedepense_informations',
                array(
                    'idTypeDepense' => $idTypeDepense,
                )));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PeriodeDepense entity.
     *
     * @param PeriodeDepense $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PeriodeDepense $entity)
    {
        $form = $this->createForm(new PeriodeDepenseType(), $entity, array(
            'action' => $this->generateUrl('periodedepense_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }


    /**
     * Displays a form to edit an existing PeriodeDepense entity.
     *
     * @Route("/{id}/edit", name="periodedepense_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id, $idTypeDepense )    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:PeriodeDepense')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PeriodeDepense entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'        => $entity,
            'edit_form'     => $editForm->createView(),
            'idTypeDepense' => $idTypeDepense,
        );
    }

    /**
    * Creates a form to edit a PeriodeDepense entity.
    *
    * @param PeriodeDepense $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PeriodeDepense $entity)
    {
        $form = $this->createForm(new PeriodeDepenseType(), $entity, array(
            'action' => $this->generateUrl('periodedepense_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PeriodeDepense entity.
     *
     * @Route("/{id}", name="periodedepense_update")
     * @Method("PUT")
     * @Template("IndraAdminBundle:PeriodeDepense:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em                 = $this->getDoctrine()->getManager();
        $dataform           = $request->request->get('indra_adminbundle_periodedepense');
        $idTypeDepense      = $dataform['typeDepense'];

        $entity = $em->getRepository('IndraAdminBundle:PeriodeDepense')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PeriodeDepense entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('periodedepense_informations',
                array(
                    'idTypeDepense' => $idTypeDepense,
                )));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Data entity.
     *
     * @Route("/{id}", name="data_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id, $del, $idRefresh)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IndraAdminBundle:PeriodeDepense')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PeriodeDepense entity.');
        }
        $entity->setDel($del);
        $em->flush();

        return $this->redirect($this->generateUrl('periodedepense_informations', array(
            'idTypeDepense' => $idRefresh,
        )));
    }

}
