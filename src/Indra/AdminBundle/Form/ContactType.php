<?php

namespace Indra\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
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
                'required' => true,
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
            ->add('sujet','textarea', array(
                'label' => 'Sujet *',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control',
                )))
            ->add('reponse','textarea', array(
                'label' => 'Réponse',
                'required' => false,
                'attr' => array(
                    'class'     => 'form-control',
                    'value'     => 'aucune réponse'
                )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Indra\AdminBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'indra_adminbundle_contact';
    }
}
