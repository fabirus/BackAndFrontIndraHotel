<?php

namespace Indra\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PeriodeDepenseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDepense','text', array(
                'label' => 'Date de la journée *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat dateDepense',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly',
                    'onBlur'   => "common().checkDateCustomBDD('periodedepense_checkDate', 'dateDepense')"
                )
            ))
            ->add('typeDepense',null, array(
                'label' => 'Type de dépense *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Indra\AdminBundle\Entity\PeriodeDepense'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'indra_adminbundle_periodedepense';
    }
}
