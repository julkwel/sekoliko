<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/29/19
 * Time: 3:04 PM.
 */

namespace App\Shared\Form;

use App\Shared\Entity\SkGuide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkGuideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class, array(
                'label' => 'Description',
            ))
            ->add('attachment', FileType::class, array('data_class' => null, 'required' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SkGuide::class,
        ));
    }
}
