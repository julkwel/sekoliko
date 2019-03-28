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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkMatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('matNom', TextType::class, array(
                    'label' => 'Nom matiere',
                ))
                ->add('matCoeff', TextType::class, array(
                    'label' => 'Coefficient Matiere',
                ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver->setDefaults(array('data_class' => SkMatiere::class)));
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix();
    }
}
