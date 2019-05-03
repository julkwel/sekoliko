<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 5/2/19
 * Time: 11:37 PM
 */

namespace App\Shared\Form;


use App\Bundle\User\Entity\User;
use App\Shared\Entity\SkClasseMatiere;
use App\Shared\Entity\SkMatiere;
use App\Shared\Services\Utils\RoleName;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Security;

class SkClasseMatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => SkClasseMatiere::class));
    }
}