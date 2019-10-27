<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Form;

use App\Entity\SchoolYear;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Trait SchoolYearType
 *
 * @package App\Form
 */
class SchoolYearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom de l\'année scolaire',
                ]
            )
            ->add(
                'startDate',
                DateTimeType::class,
                [
                    'label' => 'Date début',
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => [
                        'class' => 'datetimepicker',
                    ],
                ]
            )
            ->add(
                'endDate',
                DateTimeType::class,
                [
                    'label' => 'Date fin',
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => [
                        'class' => 'datetimepicker',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => SchoolYear::class]);
    }
}
