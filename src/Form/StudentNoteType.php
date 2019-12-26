<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Form;

use App\Entity\ClassSubject;
use App\Entity\StudentNote;
use App\Repository\ClassSubjectRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StudentNoteType.
 */
class StudentNoteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'matiere',
                EntityType::class,
                [
                    'class' => ClassSubject::class,
                    'query_builder' => function (ClassSubjectRepository $repository) use ($options) {
                        return $repository->findByClassForm($options['user'], $options['classe']);
                    },
                    'choice_label' => 'subject.name',
                ]
            )
            ->add(
                'note',
                TextType::class,
                [
                    'label' => 'Note /20',
                ]
            )
            ->add(
                'observation',
                TextareaType::class,
                [
                    'label' => 'Obsérvations',
                ]
            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => StudentNote::class,
                'user' => null,
                'classe' => null,
            ]
        );
    }
}
