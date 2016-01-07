<?php

namespace Indra\AdminBundle\Admin;

use Indra\WikiBundle\Entity\Category;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class ArticleAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('titre', 'text', array('label' => 'Titre'))
                ->add('contenu', 'ckeditor', array(
                'plugins' => array(
                    'wordcount' => array(
                        'path'     => '/web/ckeditor/plugins/wordcount/',
                        'filename' => 'plugin.js',
                    )
                ),
                    'label' => 'Contenu'
                ))
                ->add('imageFile', 'file', array(
                    'label' => 'Image',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control file fileImage',
                        'accept' =>'image/jpeg, image/png'
                    )
                ))
                ->add('updatedAt', 'datetime');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('titre');

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titre')
            ->addIdentifier('contenu')
            ->addIdentifier('imageFile', NULL, array(
                'template' => 'IndraAdminBundle:TplAdmin:image.html.twig'
            ));
    }
}