<?php

namespace Indra\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Indra\AdminBundle\Entity\Contact;
use Indra\AdminBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Session\Session;


/**
 * Contact controller.
 *
 * @Route("/contact")
 */
class ContactController extends Controller
{

    /**
     * Lists all Contact entities.
     *
     * @Route("/", name="contact")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IndraAdminBundle:Contact')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Finds and displays a Contact entity.
     *
     * @Route("/{id}", name="contact_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:Contact')->find($id);
        $editForm = $this->createEditForm($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }
        return array(
            'entity'     => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Operation Create Entity
     */

    public function operationUpdate($entity, $action) {
        $user  = $this->get('security.context')->getToken()->getUser();
        $data   = array(
            "id"                =>  $entity->getId(),
            "entite"            => 'CONTACT',
            "reponse"           =>  $entity->getReponse(),
            "Nom"               =>  $entity->getNom(),
            "telephome"         =>  $entity->getTel(),
            "email"             =>  $entity->getEmail()

        );

        $this->get('application.operation')->update($data, $user, $action);

    }

    /**
    * Creates a form to edit a Contact entity.
    *
    * @param Contact $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Contact $entity)
    {
        $form = $this->createForm(new ContactType(), $entity, array(
            'action' => $this->generateUrl('contact_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Contact entity.
     *
     * @Route("/{id}", name="contact_update")
     * @Method("PUT")
     * @Template("IndraAdminBundle:Contact:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IndraAdminBundle:Contact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Réponse au message enregistrée avec Succès !!');
            $this->operationUpdate($entity, 'REPONSE');

            return $this->redirect($this->generateUrl('contact_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Valid AvanceSalaire entity.
     *
     * @Route("/avancesalaire/{id}/{valid}/{idEmploye}", name="avancesalaire_valid")
     * @Method("VALID")
     */
    public function validAction($id, $valid)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IndraAdminBundle:Contact')->find($id);

        if($entity->getReponse() == null){

            $this->get('session')->getFlashBag()->add('error_message', "Veuillez répondre au message puis envoyer !!");
            return $this->redirect($this->generateUrl('contact_informations'));

        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }
        $entity->setStatut($valid);
        $em->flush();

        if($valid == 1){
            $this->get('session')->getFlashBag()->add('error', 'Annulation de la réponse du message !!');
        }

        if($valid == 0) {
            $this->get('session')->getFlashBag()->add('success', 'Envoie de la réponse au client avec Succès !!');
            $this->sendMail($entity);
        }

        return $this->redirect($this->generateUrl('contact_informations'));
    }


    public function sendMail($entity){

        $message = \Swift_Message::newInstance()
            ->setSubject('Réponse Demande de Contact')
            ->setFrom('indrahotel@gmail.com')
            ->setTo($entity->getEmail())
            ->setBody(
                $this->renderView(
                    'email/contact.html.twig',
                    array(
                        'message'  => $entity->getReponse()
                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
    }
}
