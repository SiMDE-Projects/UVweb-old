<?php

namespace Uvweb\UvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    protected $uv;
    protected $commentDataHelper;

    public function __construct($uv, $commentDataHelper)
    {
        $this->uv = $uv;
        $this->commentDataHelper = $commentDataHelper;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Array of semesters
        $semesters = $this->commentDataHelper->getLastSemesters();

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
                'choices' => $semesters,
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
