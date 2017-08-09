<?php

namespace ATKS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationPharmacienFormType extends BaseType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
                ->add('username')
                ->add('email')
                ->add('pharmacie', 'entity', array(
                    'class' => "ATKSAdminBundle:Pharmacie",
                    'property' => "nom",
                    'empty_value' => 'Choisir une pharmacie'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\UserBundle\Entity\Pharmacien'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'atks_userbundle_pharmacien';
    }

}
