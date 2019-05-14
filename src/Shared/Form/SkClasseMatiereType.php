<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 5/2/19
 * Time: 11:37 PM.
 */

namespace App\Shared\Form;

use App\Shared\Entity\SkClasseMatiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
