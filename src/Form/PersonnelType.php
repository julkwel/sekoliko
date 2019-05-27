<?php

namespace App\Form;

use App\Entity\Personnel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin')
            ->add('indice')
            ->add('grade')
            ->add('noteService')
            ->add('cisco')
            ->add('obs')
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
            'data_class' => Personnel::class,
        ]);
    }
}
