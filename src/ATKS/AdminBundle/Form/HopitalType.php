<?php

namespace ATKS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HopitalType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom')
                ->add('heureOuverture')
                ->add('heureFermeture')
                ->add('type', 'choice', array(
                    'choices' => array(
                        'empty_value' => 'Choisissez un type',
                        'general' => 'Général',
                        'specialise' => 'Spécialisé',
                        'universitaire' => 'Universitaire',
                        'clinique' => 'Clinique',
                        'autre' => 'Autre',
                    ),
                ))
                ->add('telephone')
                ->add('fax')
                ->add('email')
                ->add('siteWeb')
                ->add('adresse')
                ->add('longitude')
                ->add('latitude')
                ->add('altitude')
                ->add('image', new ImageType())
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\AdminBundle\Entity\Hopital'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'atks_adminbundle_hopital';
    }

}
