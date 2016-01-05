<?php

namespace Indra\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Indra\AdminBundle\Entity\Reservation;
use Indra\AdminBundle\Form\ReservationType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\Session;

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
        $entity     = new Reservation();
        $form       = $this->createCreateForm($entity);

        return $this->render('IndraClientBundle:Reservation:index.html.twig', array(
            'form'     => $form->createView(),
        ));
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
     * @Template("IndraClientBundle:Reservation:index.html.twig")
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

            $this->get('session')->getFlashBag()->add('success', 'Réservation envoyée avec Succès !!');

            return $this->redirect($this->generateUrl('reservationClient_informations'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
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
            'action' => $this->generateUrl('reservationClient_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }


}

