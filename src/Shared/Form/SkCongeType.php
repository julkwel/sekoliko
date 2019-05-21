<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/29/19
 * Time: 9:40 PM.
 */

namespace App\Shared\Form;

use App\Shared\Entity\SkConge;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkCongeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'congé' => 0,
                    'permission' => 1,
                ],
                'label'=>'Séléctionner le type d\'abscence',
                'attr'=> [
                    'class' => 'form-control',
                ]
            ])
            ->add('motif', TextType::class, [
                'label' => 'Description de congé ou permission',
                'attr' => [
                    'class' => 'form-control',  
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => SkConge::class]);
    }
}
