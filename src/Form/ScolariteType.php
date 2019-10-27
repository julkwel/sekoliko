<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Form;

use App\Entity\Scolarite;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ScolariteType
 *
 * @package App\Form
 */
class ScolariteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', UserType::class)
            ->add(
                'dateCreate',
                DateTimeType::class,
                [
                    'html5' => false,
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'datetimepicker'
                    ],
                ]
            )
            ->add('adresse')
            ->add('contact');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Scolarite::class,
            'users' => null
        ]);
    }
}