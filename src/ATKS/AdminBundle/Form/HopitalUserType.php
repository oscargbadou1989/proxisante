<?php

namespace ATKS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HopitalUserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nomUser')
                ->add('prenomUser')
                ->add('emailUser')
                ->add('telephoneUser')
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
                ->add('longitude', 'text', array(
                    'attr' => array(
                        'class' => 'longUser'
                    )
                ))
                ->add('latitude','text', array(
                    'attr' => array(
                        'id' => 'latUser'
                    )
                ))
//                ->add('altitude', 'text', array(
//                    'attr' => array(
//                        'id' => 'altUser'
//                    )
//                ))
//                ->add('image', new ImageType())
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\AdminBundle\Entity\HopitalUser'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'atks_adminbundle_hopitaluser';
    }

}
