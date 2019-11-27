<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

/**
 * Class UserType.
 */
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'nom',
                TextType::class,
                [
                    'label' => 'Nom de l\'utilisateur',
                ]
            )
            ->add(
                'prenom',
                TextType::class,
                [
                    'label' => 'Prénom de l\'utilisateur',
                ]
            )
            ->add(
                'username',
                TextType::class,
                [
                    'label' => 'Login de l\'utilisateur',
                ]
            )
            ->add(
                'photo',
                FileType::class,
                [
                    'label' => 'Photo de l\'utilisateur',
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '1024k',
                            'mimeTypesMessage' => 'Please upload a valid Images document',
                        ]),
                    ],
                ]
            )
            ->add(
                'imatriculation',
                TextType::class,
                [
                    'label' => 'Imatriculation de l\'utilisateur',
                    'required' => 'required',
                ]
            )
            ->add(
                'password',
                PasswordType::class,
                [
                    'label' => 'Mots de passe de l\'utilisateur',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => User::class]);
    }
}
