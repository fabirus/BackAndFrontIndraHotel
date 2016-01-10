<?php

namespace Indra\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FactureReceptionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateArrive','text', array(
                'label' => 'Date d\'arrivée *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
            ->add('dateDepart','text', array(
                'label' => 'Date départ *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control dateFormat',
                    'placeholder' => 'Format JJ/MM/AA',
                    'readOnly'  => 'readOnly'
                )
            ))
//            ->add('chambre',null, array(
//                'label' => 'Chambre *',
//                'required' => true,
//                'attr' => array(
//                    'class' => 'form-control multiselectOne'
//                )
//            ))
            ->add('chambre','entity', array(
                'label' => 'Chambre *',
                'class' =>'Indra\AdminBundle\Entity\Chambre',
                'property' =>'numero',
                'query_builder' => function(\Indra\AdminBundle\Entity\Repository\ChambreRepository $repository){
                    return $repository->findActiveChambreQueryBuilder();
                },
                'attr' => array(
                    'class' => 'form-control multiselectOne'
                )))
            ->add('client',null, array(
                'label' => 'Client *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control multiselectOne'
                )
            ))
            ->add('qtePers','number', array(
                'label' => 'Nombre *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control number',
                    'value' => '1'
                )))
            ->add('montant','number', array(
                'label' => 'Montant *',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control number',
                )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Indra\AdminBundle\Entity\FactureReception'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'indra_adminbundle_facturereception';
    }
}
