<?php

namespace ATKS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PharmacieType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('telephone')
            ->add('fax')
            ->add('email')
            ->add('siteWeb')
            ->add('adresse')
            ->add('longitude')
            ->add('latitude')
            ->add('altitude')
            ->add('heureOuverture')
            ->add('heureFermeture')
            ->add('nomPharmacien')
            ->add('qualificationPharmacien')
            ->add('autreInfo')
            ->add('image', new ImageType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\AdminBundle\Entity\Pharmacie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'atks_adminbundle_pharmacie';
    }
}
