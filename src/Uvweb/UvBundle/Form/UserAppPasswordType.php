<?php

namespace Uvweb\UvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class UserAppPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', 'password', array(
                    'label' => 'Mot de passe pour les applications mobiles',
                    'constraints' => array(
                        new NotBlank(array('message' => 'Un mot de passe est requis.')),
                        new Length(array(
                            'min' => 8,
                            'minMessage' => '8 caractères minimum.'
                        ))
                    )
                ))
            ->add('password_confirmation', 'password', array(
                    'label' => 'Confirmation',
                    'constraints' => array(
                        new NotBlank(array('message' => 'Une confirmation de mot de passe est requise.')),
                        new Length(array(
                            'min' => 8,
                            'minMessage' => '8 caractères minimum.'
                        ))
                    )
                ));
    }

    public function getName()
    {
        return 'uvweb_uvbundle_userapppasswordtype';
    }
}