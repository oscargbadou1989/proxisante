<?php

namespace ATKS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PharmacieSpecialiteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('pharmacie', 'entity', array(
                    'class' => "ATKSAdminBundle:Pharmacie",
                    'property' => "nom",
                    'empty_value' => 'Choisir une pharmacie'
                ))
                ->add('specialite', 'entity', array(
                    'class' => "ATKSAdminBundle:SpecialitePharmacie",
                    'property' => "nom",
                    'empty_value' => 'Choisir une spécialité'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\AdminBundle\Entity\PharmacieSpecialite'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'atks_adminbundle_pharmaciespecialite';
    }

}
