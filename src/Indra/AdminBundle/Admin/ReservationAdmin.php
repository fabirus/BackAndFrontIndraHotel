<?php

namespace Indra\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ReservationAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom','text', array(
                'label' => 'Nom',
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
                'label' => 'Téléphone',
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
                'label' => 'Heure d\'arrivée',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control dateFormat',
                    'readOnly'  => 'readOnly'
                )))
            ->add('arrive','text', array(
                'label' => 'Date d\'arrivée',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
            ->add('depart','text', array(
                'label' => 'Date de Départ',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
            ->add('categorieChambre',null, array(
                'label' => 'Type de Logement',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control select',
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
                'label' => 'Nombre',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control number',
                    'value' => '1',
                    'style' => 'width : 25%'
                )))
            ->add('updatedAt', 'datetime')

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('categorieChambre')
            ->add('chambre');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->addIdentifier('email')
            ->addIdentifier('tel')
            ->addIdentifier('heure')
            ->addIdentifier('arrive')
            ->addIdentifier('depart')
            ->addIdentifier('categorieChambre')
            ->addIdentifier('chambre')
            ->addIdentifier('qte')
        ;
    }

}