<?php

namespace Indra\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TourismeAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('titre')
            ->add('contenu', 'ckeditor', array(
                'plugins' => array(
                    'wordcount' => array(
                        'path'     => '/web/ckeditor/plugins/wordcount/',
                        'filename' => 'plugin.js',
                    )
                )))
            ->add('gallery')

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('titre')
            ->add('gallery')
            ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titre')
            ->addIdentifier('contenu')
            ->addIdentifier('gallery')
        ;
    }

}