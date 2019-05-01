<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 5/1/19
 * Time: 8:17 PM
 */

namespace App\Shared\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkBugComment extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('comment');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>\App\Shared\Entity\SkBugComment::class));
    }
}