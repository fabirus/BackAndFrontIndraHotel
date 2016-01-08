<?php

namespace Indra\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RatingAdmin extends Admin
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
            ->add('vote','choice', array(
                'choices' => array(
                    '1'    => '1',
                    '2'    => '2',
                    '3'    => '3',
                    '4'    => '4',
                    '5'    => '5',
                ),
                'label' => 'Vote',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control vote'
                )
            ))
            ->add('commentaire','textarea', array(
                'label' => 'Commentaire',
                'required' => false,
                'attr' => array(
                    'class'     => 'form-control',
                    'maxlength' =>"200"
                )))
            ->add('updatedAt', 'datetime')

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('vote');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('updatedAt')
            ->addIdentifier('nom')
            ->addIdentifier('vote')
            ->addIdentifier('commentaire')
        ;
    }

}