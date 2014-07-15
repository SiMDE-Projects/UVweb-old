<?php

namespace Uvweb\UvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentRestType extends CommentType
{
    public function __construct($uv, $commentDataHelper)
    {
        parent::__construct($uv, $commentDataHelper);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Uvweb\UvBundle\Entity\Comment',
                'csrf_protection' => false
            ));
    }

    public function getName()
    {
        return 'uvweb_uvbundle_commentresttype';
    }
}
