<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/28/19
 * Time: 5:18 PM
 */

namespace App\Shared\Form;


use App\Shared\Entity\SkDisciplineList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkPunitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class,array(
            'label'=>'Nom de punition'
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults(array('data_class'=>SkDisciplineList::class));
    }
}