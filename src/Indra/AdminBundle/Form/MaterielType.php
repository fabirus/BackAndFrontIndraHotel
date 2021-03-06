<?php

namespace Indra\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MaterielType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('at','text', array(
                'label' => 'Date *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat at',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly',
                    'onBlur'   => "common().checkDateBDD('materiel_checkDate', 'at')"
                )))
            ->add('motif','textarea', array(
                'label' => 'Motifs *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat'
                )))
            ->add('qte','number', array(
                'label' => 'Quantité *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control number qte',
                    'onBlur'   => "common().checkQte('materiel_checkQte', 'qte', 'stock')"
                )))
            ->add('stock','entity', array(
                'class' =>'Indra\AdminBundle\Entity\Stock',
                'query_builder' => function(\Indra\AdminBundle\Entity\Repository\StockRepository $repository){
                    return $repository->findAdministratifQueryBuilder();
                },
                'label' => 'Matériel *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control multiselectOne stock'
                )))
            ->add('materielFile', 'file', array(
                'label' => 'Justificatif (pdf)',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control file filePdf',
                    'accept' =>'application/pdf'
                )
            ))
            ->add('employe', null, array(
                'label' => 'Employé',
                'required' => false,
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
            'data_class' => 'Indra\AdminBundle\Entity\Materiel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'indra_adminbundle_materiel';
    }
}
