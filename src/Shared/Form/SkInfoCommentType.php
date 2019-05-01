<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 5/2/19
 * Time: 12:22 AM
 */

namespace App\Shared\Form;


use App\Shared\Entity\SkInfoComment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkInfoCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('comment');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>SkInfoComment::class));
    }
}