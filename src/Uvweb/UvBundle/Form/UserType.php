<?php

namespace Uvweb\UvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentYear = date('Y');
        $lastYears = array();

        for ($i= $currentYear; $i > $currentYear - 10 ; $i--) 
        { 
            $lastYears[$i] = $i;
        }
        $builder
                ->add('identity', 'text', array(
                    'label' => 'Pseudo (sera visible sur le site)'))
                ->add('email', 'email', array(
                    'label' => 'Email',
                ))
                ->add('firstsemester', 'choice', array(
                    'choices' => array('A' => 'Automne', 'P' => 'Printemps'),
                    'label' => 'Semestre d\'entrée'
                ))
                ->add('firstyear', 'choice', array('choices' => $lastYears, 'label' => 'Année d\'entrée'))
                ->add('origin', 'text', array(
                    'label' => 'Cursus d\'origine : prépa, IUT...',
                    'required' => true
                ))
                ->add('origindetails', 'textarea', array(
                    'label' => 'Détails cursus d\'origine',
                    'required' => false
                ))
                ->add('branch', 'choice', array(
                    'choices' => array('TC' => 'TC', 'GB' => 'GB', 'GI' => 'GI', 'GM' => 'GM', 'GP' => 'GP', 'GSM' => 'GSM', 'GSU' => 'GSU'),
                    'label' => 'Branche'
                ))
                ->add('filiere', 'choice', array(
                    'choices' => array('' => 'Aucune', 'ICSI' => 'ICSI'),
                    'label' => 'Filière',
                    'required' => false
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uvweb\UvBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'uvweb_uvbundle_usertype';
    }
}
