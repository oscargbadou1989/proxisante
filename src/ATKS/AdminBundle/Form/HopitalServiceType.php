<?php

namespace ATKS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HopitalServiceType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('heureOuverture')
                ->add('heureFermeture')
                ->add('nomSpecialiste')
                ->add('telephoneSpecialiste')
                ->add('qualificationSpecialiste')
                ->add('fraisPrestation')
                ->add('autreInfo')
                ->add('hopital', 'entity', array(
                    'class' => "ATKSAdminBundle:Hopital",
                    'property' => "nom",
                    'empty_value' => 'Choisir un hopital'
                ))
                ->add('service', 'entity', array(
                    'class' => "ATKSAdminBundle:ServiceSante",
                    'property' => "nom",
                    'empty_value' => 'Choisir un service'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\AdminBundle\Entity\HopitalService'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'atks_adminbundle_hopitalservice';
    }

}
