<?php

namespace Indra\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RatingType extends AbstractType
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
            ->add('vote','choice', array(
                'choices' => array(
                    '1'    => '1',
                    '2'    => '2',
                    '3'    => '3',
                    '4'    => '4',
                    '5'    => '5',
                ),
                'label' => 'Vote *',
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
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Indra\AdminBundle\Entity\Rating'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'indra_adminbundle_rating';
    }
}
