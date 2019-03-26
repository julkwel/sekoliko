<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/10/19
 * Time: 9:14 PM
 */

namespace App\Shared\Form;


use App\Shared\Entity\SkEtablissement;
use App\Shared\Entity\SkMatiere;
use App\Shared\Entity\SkProfs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                ->add('matNom',TextType::class)
                ->add('etsNom',EntityType::class,array('class'=>SkEtablissement::class))
                ->add('matCoeff',TextType::class)
                ->add('matProf',EntityType::class,array('class'=>SkProfs::class))
            ;
     }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver->setDefaults(array('data_class'=>SkMatiere::class)));
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix();
    }

}