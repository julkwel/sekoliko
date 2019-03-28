<?php
/**
 * Created by PhpStorm.
 * User: chrys
 * Date: 28/03/19
 * Time: 07:51
 */

namespace App\Shared\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkDisciplineFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array(
                'label' => 'Nom discipline'
            ))
            ->add('description',TextareaType::class,array(
                'label' => 'Déscritpion de la discipline'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'App\Shared\Entity\SkDiscipline'));
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix();
    }

}