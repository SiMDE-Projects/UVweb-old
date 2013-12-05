<?php

namespace Uvweb\UvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    private $uv;

    public function __construct($uv)
    {
        $this->uv = $uv;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', 'textarea', array(
                'label' => 'Ton commentaire'
            ))
            ->add('interest', 'choice', array(
                'choices' => array('Passionnant' => 'Passionnant', 'Très intéressant' => 'Très intéressant',
                    'Intéressant' => 'Intéressant', 'Peu intéressant' => 'Peu intéressant', 'Bof' => 'Bof', 'Nul' => 'Nul'),
                'label' => 'Intérêt'
            ))
            ->add('pedagogy', 'choice', array(
                'choices' => array('Passionnant' => 'Passionnant', 'Très intéressant' => 'Très intéressant',
                    'Intéressant' => 'Intéressant', 'Peu intéressant' => 'Peu intéressant', 'Bof' => 'Bof', 'Nul' => 'Nul'),
                'label' => 'Qualité de la pédagogie'
            ))
            ->add('utility', 'choice', array(
                'choices' => array('Indispensable' => 'Indispensable', 'Très importante' => 'Très importante',
                    'Utile' => 'Utile', 'Pas très utile' => 'Pas très utile', 'Très peu utile' => 'Très peu utile', 'Inutile' => 'Inutile'),
                'label' => 'Utilité'
            ))
            ->add('workAmount', 'choice', array(
                'choices' => array('Symbolique' => 'Symbolique', 'Faible' => 'Faible',
                    'Moyenne' => 'Moyenne', 'Importante' => 'Importante', 'Très importante' => 'Très importante'),
                'label' => 'Quantité de travail'
            ))
            ->add('passed', 'choice', array(
                'choices' => array('obtenue' => 'Obtenue', 'ratée' => 'Ratée', 'en cours' => 'En cours'),
                'label' => 'As-tu obtenu '. $this->uv->getName() . ' ?'
            ))
            ->add('semester', 'choice', array(
                'choices' => array('P13' => 'P13', 'A12' => 'A12', 'P12' => 'P12'),
                'label' => 'Semestre au cours duquel tu l\'as effectuée '
            ))
            ->add('globalRate', 'choice', array(
                'choices' => array('10' => '10', '9' => '9', '8' => '8', '7' => '7', '6' => '6'
                , '5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1', '0' => '0'),
                'label' => 'Ta note pour '. $this->uv->getName()
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uvweb\UvBundle\Entity\Comment'
        ));
    }

    public function getName()
    {
        return 'uvweb_uvbundle_commenttype';
    }
}
