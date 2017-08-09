<?php

namespace ATKS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class PlainteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('plainte')
        ->add('service', 'entity', array(
            'class' => "ATKSAdminBundle:ServiceSante",
            'property' => "nom",
            'empty_value' => 'Choisir un service',
            'query_builder' => function (EntityRepository $er) {
              return $er->createQueryBuilder('s')
              ->orderBy('s.nom', 'ASC');
            },
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ATKS\AdminBundle\Entity\Plainte'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'atks_adminbundle_plainte';
    }


}
