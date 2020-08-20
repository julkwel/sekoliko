<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Form;

use App\Entity\AdministrationType;
use App\Entity\Administrator;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdministratorType.
 */
class AdministratorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'user',
                UserType::class,
                [
                    'label' => false,
                ]
            )
            ->add(
                'type',
                EntityType::class,
                [
                    'class' => AdministrationType::class,
                    'query_builder' => function (EntityRepository $repository) use ($options) {
                        return $repository->createQueryBuilder('a')
                            ->andWhere('a.etsName = :etsName')
                            ->setParameter('etsName', $options['etsName']);
                    },
                    'choice_label' => 'libelle',
                    'label' => 'Poste',
                ]
            )
            ->add(
                'salary',
                TextType::class,
                [
                    'label' => 'Salaires',
                ]
            )
            ->add(
                'dateCreate',
                DateTimeType::class,
                [
                    'label' => 'Date d\'entrer',
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => [
                        'class' => 'datetimepicker',
                    ],
                    'format' => 'Y-m-d H:i',
                ]
            )
            ->add(
                'adresse',
                TextType::class,
                [
                    'label' => 'Adresse exacte',
                ]
            )
            ->add(
                'contact',
                TextType::class,
                [
                    'label' => 'Contact téléphonique',
                ]
            )
            ->add(
                'cin',
                TextType::class,
                [
                    'label' => 'Numéro CIN',
                    'attr' => [
                        'minlength' => 12,
                    ],
                ]
            )
            ->add(
                'lieuCin',
                TextType::class,
                [
                    'label' => 'Lieu délivrance CIN',
                ]
            )
            ->add(
                'dateCin',
                DateTimeType::class,
                [
                    'label' => 'Date CIN',
                    'widget' => 'single_text',
                    'html5' => false,
                    'attr' => [
                        'class' => 'datetimepicker',
                    ],
                    'format' => 'Y-m-d H:i',
                ]
            )
            ->add(
                'diplome',
                TextType::class,
                [
                    'label' => 'Diplome',
                ]
            )
            ->add(
                'numAe',
                TextType::class,
                [
                    'label' => 'Numéro AE',
                ]
            )
            ->add(
                'salary',
                TextType::class,
                [
                    'label' => 'Montant salaires',
                    'required' => false,
                ]
            )
            ->add(
                'noteLibre',
                TextareaType::class,
                [
                    'label' => 'Note libre',
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Administrator::class,
                'etsName' => null,
            ]
        );
    }
}
