<?php

namespace Uvweb\UvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UniversityType extends AbstractType
{
    protected $university;
    protected $commentDataHelper;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Nom de l\'université'
            ))
            ->add('locationCity', 'text', array(
                'label' => 'Ville de l\'université'
            ))
            ->add('locationCountry', 'text', array(
                'label' => 'Pays de l\'université'
            ))
            ->add('website', 'url', array(
                'label' => 'Site web'
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uvweb\UvBundle\Entity\University'
        ));
    }

    public function getName()
    {
        return 'uvweb_uvbundle_universitytype';
    }
}
