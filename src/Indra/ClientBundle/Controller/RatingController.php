<?php

namespace Indra\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Indra\AdminBundle\Entity\Rating;
use Indra\AdminBundle\Form\RatingType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\Session;
class RatingController extends Controller
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
        $entity     = new Rating();
        $form       = $this->createCreateForm($entity);
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('IndraAdminBundle:Rating')->findBy(
            array(),
            array('updatedAt' => 'desc'),
            4
        );

        return $this->render('IndraClientBundle:Rating:index.html.twig', array(
            'form'     => $form->createView(),
            'votes'    => $entities
        ));
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
        $entity = new Rating();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setUpdatedAt(new DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success_rating', 'Point de Vue Enregistré avec Succès !!');

            return $this->redirect($this->generateUrl('rating_informations'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    public function sendMail($email){

        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'Emails/registration.html.twig',
                    array('name' => '')
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
    }


    /**
     * Creates a form to create a Reservation entity.
     *
     * @param Rating $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Rating $entity)
    {
        $form = $this->createForm(new RatingType(), $entity, array(
            'action' => $this->generateUrl('rating_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
}
