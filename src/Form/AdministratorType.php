<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Form;

use App\Entity\AdministrationType;
use App\Entity\Administrator;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AdministratorType
 *
 * @package App\Form
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
                    'choice_label' => 'libelle',
                    'label' => 'Poste',
                ]
            )
            ->add('salary',
                TextType::class,
                [
                    'label' => 'Salaires',
                ]
            )
            ->add(
                'dateCreate',
                DateTimeType::class,
                [
                    'html5' => false,
                    'label' => 'Date d\'entrer',
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'datetimepicker',
                    ],
                    'format' => 'Y-m-d H:i'
                ]
            )
            ->add('adresse')
            ->add('contact')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Administrator::class]);
    }
}
