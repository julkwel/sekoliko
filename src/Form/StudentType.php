<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Form;

use App\Constant\EtudiantStatusConstant;
use App\Entity\ClassRoom;
use App\Entity\Student;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StudentType.
 */
class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'user',
                UserType::class
            )
            ->add(
                'classe',
                EntityType::class,
                [
                    'label' => 'Classe',
                    'class' => ClassRoom::class,
                    'query_builder' => function (EntityRepository $repository) use ($options) {
                        return $repository->createQueryBuilder('c')
                            ->andWhere('c.etsName = :etsName')
                            ->setParameter('etsName', $options['etsName']);
                    },
                    'choice_label' => 'name',
                    'data' => $options['classe'],
                ]
            )
            ->add(
                'contact',
                TextType::class,
                [
                    'label' => 'Contact téléphonique',
                    'required' => false,
                ]
            )
            ->add(
                'adresse',
                TextType::class,
                [
                    'label' => 'Adresse exacte',
                    'required' => false,
                ]
            )
            ->add(
                'contactParent',
                TextType::class,
                [
                    'label' => 'Contact téléphonique parentale ou parain',
                    'required' => false,
                ]
            )
            ->add(
                'adresseParent',
                TextType::class,
                [
                    'label' => 'Adresse parentale ou parain',
                    'required' => false,
                ]
            )
            ->add(
                'status',
                ChoiceType::class,
                [
                    'label' => 'Status de l\'étudiant',
                    'choices' => EtudiantStatusConstant::STUDENT_STATUS,
                    'required' => false,
                ]
            )
            ->add(
                'noteLibre',
                TextareaType::class,
                [
                    'label' => 'Note libre',
                    'required' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Student::class,
                'etsName' => null,
                'classe' => null,
            ]
        );
    }
}
