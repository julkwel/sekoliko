<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 4:03 PM.
 */

namespace App\Shared\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkEtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('addition', TextType::class, ['label' => 'Modele d\'addition'])
            ->add('mere', TextType::class, ['label' => 'Nom du mere'])
            ->add('pere', TextType::class, ['label' => 'Nom du pere'])
            ->add('contactParent', TextType::class, ['label' => 'Contact des parents'])
            ->add('sexe', TextType::class, ['label' => 'Sexe'])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'App\Shared\Entity\SkEtudiant'));
    }
}
