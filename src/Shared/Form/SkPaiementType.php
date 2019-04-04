<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/4/19
 * Time: 11:34 PM
 */

namespace App\Shared\Form;


use App\Bundle\User\Entity\User;
use App\Shared\Entity\SkPaiement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkPaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaire',TextareaType::class,array(
                'label'=>'Remarque'
            ))
            ->add('montant',TextType::class,array(
                'label'=>'Montant de paiement'
            ))
            ->add('reference',TextType::class,array(
                'label'=>'Réference de paiement'
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>'App\Shared\Entity\SkPaiement'));
    }
}