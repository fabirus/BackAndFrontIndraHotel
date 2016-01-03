<?php

namespace Indra\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ImageAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('gallery', 'sonata_type_model', array(
                'label'     => 'Gallery d\'image',
                'required'  => true,
                'class'     => 'Indra\AdminBundle\Entity\Gallery',
                'property'  => 'nom'
            ))
            ->add('imageFile', 'file', array(
                'label' => 'Image',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control file fileImage',
                    'accept' =>'image/jpeg, image/png'
                )
            ))
            ->add('updatedAt', 'datetime')
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('gallery');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('gallery')
            ->addIdentifier('imageName')
            ->addIdentifier('imageFile', NULL, array(
                'template' => 'IndraAdminBundle:TplAdmin:image.html.twig'
            ))
        ;
    }

}