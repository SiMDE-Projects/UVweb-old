<?php 
namespace Uvweb\UvBundle\Form;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MigrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', 'text', array(
            	'constraints' => new NotBlank(array('message' => 'Un login est requis.'))
            ))
            ->add('password', 'password', array(
            	'constraints' => new NotBlank(array('message' => 'Un mot de passe est requis.'))
            ))
        ;
    }

    public function getName()
    {
        return 'uvweb_uvbundle_migrationtype';
    }
}

?>