<?php

namespace Indra\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
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
            ->add('prenom','text', array(
                'label' => 'Prénom *',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control',
                )))
            ->add('dateNaissance','text', array(
                'label' => 'Date de Naissance *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
            ->add('lieuNaissance','text', array(
                'label' => 'Lieu de Naissance *',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control',
                )))
            ->add('nationalite','text', array(
                'label' => 'Nationalité *',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control country',
                )))
            ->add('numeroIdentite','text', array(
                'label' => 'Numéro d\'identité *',
                'required' => true,
                'attr' => array(
                    'class'     => 'form-control',
                )))
            ->add('dateDelivranceId','text', array(
                'label' => 'Date de Délivrance *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
            ->add('sexe','choice', array(
                'choices' => array(
                    'masculin' => 'Masculin',
                    'feminin' => 'Feminin'
                ),
                'label' => 'Sexe *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control vote'
                )
            ))
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
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Indra\AdminBundle\Entity\Client'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'indra_adminbundle_client';
    }
}
