<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/10/19
 * Time: 9:14 PM.
 */

namespace App\Shared\Form;

use App\Shared\Entity\SkMatiere;
use Symfony\Component\Form\AbstractType;
use App\Bundle\User\Entity\User;
use App\Shared\Repository\UserRepository;
use App\Shared\Services\Utils\RoleName;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * SkMatiereType package
 * @author Max
 */
class SkMatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matNom', TextType::class, array(
                'label' => 'Nom matiere',
            ))
            ->add('matProf', EntityType::class, [
                'choice_label' => 'username',
                'label' => 'Selectionner un profs',
                'class' => User::class,
                'query_builder' => function(UserRepository $repository) use($options) {
                    return $repository->createQueryBuilder('u')
                                ->where('u.skRole = :role')
                                ->andWhere('u.etsNom = :name')
                                ->setParameters([
                                    'role' => RoleName::ID_ROLE_PROFS,
                                    'name' => $options['user']
                                ]);
                }
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver->setDefaults(array(
            'data_class' => SkMatiere::class,
            'user' => null
        )));
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix();
    }
}
