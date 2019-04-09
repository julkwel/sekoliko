<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/9/19
 * Time: 12:01 PM.
 */

namespace App\Shared\Form;

use App\Shared\Entity\SkTrimestre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkTrimestreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, ['label' => 'Ajouter le nom']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => SkTrimestre::class));
    }
}
