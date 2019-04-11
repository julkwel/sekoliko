<?php

namespace App\Shared\Form;

use App\Shared\Entity\SkNote;
use App\Shared\Entity\SkExamType;
use App\Shared\Entity\SkMatiere;
use App\Shared\Repository\SkMatiereRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * @author Max
 */
class SkNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('student', TextType::class, [
                    'attr' => [
                        'value' => $options['student'],
                        'disabled' => true
                    ],
                    'mapped' => false
                ])
                ->add('noteVal', TextType::class, [
                    'label' => 'Note matiere'
                ])
                ->add('matNom', EntityType::class, [
                    'class' => SkMatiere::class,
                    'choice_label' => 'matNom',
                    'query_builder' => function(SkMatiereRepository $repository) use($options){
                        return $repository->createQueryBuilder('m')
                                          ->where('m.matProf = :prof')
                                          ->setParameter('prof', $options['userProf']);
                    }
                ])
                ->add('examType', EntityType::class, [
                    'class' => SkExamType::class,
                    'choice_label' => 'title',
                    'placeholder' => 'Choississez le type d examen'
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SkNote::class,
            'user' => null,
            'subject' => null,
            'student' => null,
            'userProf' => null
        ));
    }
}
