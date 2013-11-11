<?php

namespace Uvweb\UvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserEditType extends UserType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Creating the form with parent
        parent::buildForm($builder, $options);

        //Removing the useless fields
        $builder
                ->remove('firstsemester')
                ->remove('firstyear')
                ->remove('origindetails');
    }
    
    public function getName()
    {
        return 'uvweb_uvbundle_useredittype';
    }
}
