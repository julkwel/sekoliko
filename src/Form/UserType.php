<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Form;

use App\Constant\RoleConstant;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserType
 *
 * @package App\Form
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
                'username',
                TextType::class,
                [
                    'label' => 'Login de l\'utilisateur',
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
