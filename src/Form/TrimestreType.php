<?php

namespace App\Form;

use App\Entity\Trimestre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrimestreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('asName')
            ->add('asDateDebut')
            ->add('asDateFin')
            ->add('etsNom')
            ->add('etsAddresse')
            ->add('etsContact')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trimestre::class,
        ]);
    }
}
