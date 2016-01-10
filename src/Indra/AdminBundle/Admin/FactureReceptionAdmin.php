<?php

namespace Indra\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FactureReceptionAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('dateArrive','text', array(
                'label' => 'Date d\'arrivée *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
            ->add('dateDepart','text', array(
                'label' => 'Date départ *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
            ->add('chambre',null, array(
                'label' => 'Chambre *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control multiselectOne'
                )
            ))
            ->add('client',null, array(
                'label' => 'Client *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control multiselectOne'
                )
            ))
            ->add('qtePers','number', array(
                'label' => 'Nombre *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control number',
                    'value' => '1'
                )))
            ->add('montant','number', array(
                'label' => 'Montant *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control number',
                )))
            ->add('updatedAt', 'datetime')

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('chambre')
            ->add('client');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('Client')
            ->addIdentifier('dateArrive')
            ->addIdentifier('dateDepart')
            ->addIdentifier('chambre')
            ->addIdentifier('qtePers')
            ->addIdentifier('montant')
            ->addIdentifier('updatedAt')
        ;
    }

}