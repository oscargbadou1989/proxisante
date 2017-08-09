<?php

namespace ATKS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom')
                ->add('description')
                ->add('tags')
                ->add('type', 'choice', array(
                    'choices' => array(
                        'empty_value' => 'Choisissez un type',
                        'sirop' => 'Sirop',
                        'comprime' => 'Comprimé',
                        'seringue' => 'Seringue',
                        'capsule' => 'Capsule',
                    )
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\AdminBundle\Entity\Produit'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'atks_adminbundle_produit';
    }

}
