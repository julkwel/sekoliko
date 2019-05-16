<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/4/19
 * Time: 11:34 PM.
 */

namespace App\Shared\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkPaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'App\Shared\Entity\SkPaiement'));
    }
}
