<?php

namespace Uvweb\UvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UvType extends AbstractType
{
    protected $commentDataHelper;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Code du cours'
            ))
            ->add('title', 'text', array(
                'label' => 'Nom complet du cours'
            ))
            ->add('credits', 'number', array(
                'label' => 'Crédits ECTS'
            ))
            ->add('tp', 'checkbox', array(
                'label' => 'TPs',
                'required' => false
            ))
            ->add('tp', 'checkbox', array(
                'label' => 'Final',
                'required' => false
            ))
            ->add('teacher', 'text', array(
                'label' => 'Nom du professeur'
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uvweb\UvBundle\Entity\Uv'
        ));
    }

    public function getName()
    {
        return 'uvweb_uvbundle_uvtype';
    }
}
