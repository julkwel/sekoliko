<?php

namespace App\Form;

use App\Entity\ClasseMatiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasseMatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coefficient')
            ->add('obs')
            ->add('asName')
            ->add('asDateDebut')
            ->add('asDateFin')
            ->add('etsNom')
            ->add('etsAddresse')
            ->add('etsContact')
            ->add('matieres')
            ->add('professeur')
            ->add('classe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClasseMatiere::class,
        ]);
    }
}
