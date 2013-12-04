<?php 
namespace Uvweb\UvBundle\Form;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ForgottenAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text', array(
            	'constraints' => array(
                    new NotBlank(array('message' => 'Une adresse email est requise.')),
                    new Email(array('message' => '{{ value }}: Email non valide.', 'checkMX' => true)))
            ));
    }

    public function getName()
    {
        return 'uvweb_uvbundle_forgottenaccounttype';
    }
}

?>