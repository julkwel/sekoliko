<?php
/**
 * @author Bocasay<bocasay.com>
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class OrganisationType.
 */
class OrganisationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('organisation', TextType::class, ['label' => 'Nom de l\'établissement'])
            ->add(
                'userType',
                ChoiceType::class,
                [
                    'label' => 'Rôle de l\'utilisateur',
                    'choices' => [
                        'Administration' => 'Administration',
                        'Secretaire' => 'Secretaire',
                    ],
                ]
            )
            ->add(
                'username',
                TextType::class,
                [
                    'label' => 'Nom de l\'utilisateur',
                ]
            )
            ->add(
                'login',
                TextType::class,
                [
                    'label' => 'Identifiant de l\'utilisateur',
                ]
            )
            ->add(
                'password',
                TextType::class,
                [
                    'label' => 'Mots de passe de l\'utilisateur',
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => null]);
    }
}
