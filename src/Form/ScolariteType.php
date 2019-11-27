<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Form;

use App\Entity\Scolarite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ScolariteType.
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
                    'label' => 'Date d\'entrer',
                    'attr' => [
                        'class' => 'datetimepicker',
                    ],
                    'format' => 'Y-m-d H:i',
                ]
            )
            ->add('adresse', TextType::class, ['label' => 'Adresse éxacte'])
            ->add('contact', TextType::class, ['label' => 'Contact téléphonique'])
            ->add('salary', TextType::class, ['label' => 'Montant salaires', 'required' => false]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Scolarite::class,
            'users' => null,
        ]);
    }
}
