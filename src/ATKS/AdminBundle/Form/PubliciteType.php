<?php

namespace ATKS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PubliciteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nomStructure')
                ->add('telephone')
                ->add('email')
                ->add('adresse')
                ->add('libelle')
                ->add('siteWeb')
                ->add('messageFlash')
                ->add('dateDebut', 'birthday', array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'required' => false,
                    'attr' => array(
                        'placeholder' => '2014-02-28'
                    )
                ))
                ->add('dateFin', 'birthday', array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'required' => false,
                    'attr' => array(
                        'placeholder' => '2014-02-28'
                    )
                ))
                ->add('actif')
                ->add('images', 'collection', array(
                    'type' => new ImageType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\AdminBundle\Entity\Publicite'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'atks_adminbundle_publicite';
    }

}
