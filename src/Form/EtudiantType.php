<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('nomPere')
            ->add('nomMere')
            ->add('prenomPere')
            ->add('prenomMere')
            ->add('contactParent')
            ->add('asName')
            ->add('asDateDebut')
            ->add('asDateFin')
            ->add('etsNom')
            ->add('etsAddresse')
            ->add('etsContact')
            ->add('classe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
