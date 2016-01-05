<?php

namespace Indra\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text', array(
                'label' => 'Nom *',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control',
                )))
            ->add('email','email', array(
                'label' => 'Adresse Email',
                'required' => false,
                'attr' => array(
                    'class'     => 'form-control',
                )))
            ->add('tel','text', array(
                'label' => 'Téléphone *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control phoneNumber',
                    'placeholder' => 'Exemple 699-10-63-27',
                )))
            ->add('requete','textarea', array(
                'label' => 'Requète',
                'required' => false,
                'attr' => array(
                    'class'     => 'form-control',
                )))
            ->add('heure','text', array(
                'label' => 'Heure d\'arrivée *',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control dateFormat',
                    'readOnly'  => 'readOnly'
                )))
            ->add('arrive','text', array(
                'label' => 'Date d\'arrivée *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
            ->add('depart','text', array(
                'label' => 'Date de Départ *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
            ->add('categorieChambre',null, array(
                'label' => 'Type de Logement *',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control select',
                    'onClick'   => "common().selectEntity('room_category')"
                )
            ))
            ->add('chambre',null, array(
                'label' => 'Chambre',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('qte','number', array(
                'label' => 'Nombre *',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control number',
                    'value' => '1'
                )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Indra\AdminBundle\Entity\Reservation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'indra_adminbundle_reservation';
    }
}
