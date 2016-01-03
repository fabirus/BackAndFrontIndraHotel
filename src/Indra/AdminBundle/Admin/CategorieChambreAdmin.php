<?php

namespace Indra\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CategorieChambreAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('prix','number', array(
                'label' => 'Prix',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control number'
                )))
            ->add('description','textarea', array(
                'label' => 'Description',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('gallery' )

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('prix');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->addIdentifier('prix')
        ;
    }

}