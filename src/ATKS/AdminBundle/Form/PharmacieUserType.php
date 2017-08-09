<?php

namespace ATKS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PharmacieUserType extends AbstractType {

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
                ->add('latitude', 'text', array(
                    'attr' => array(
                        'class' => 'latUser'
                    )
                ))
                ->add('heureOuverture')
                ->add('heureFermeture')
                ->add('nomPharmacien')
                ->add('qualificationPharmacien')
//            ->add('image',  new ImageType())
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\AdminBundle\Entity\PharmacieUser'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'atks_adminbundle_pharmacieuser';
    }

}
