<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/10/19
 * Time: 10:02 PM
 */

namespace App\Shared\Form;


use App\Shared\Entity\SkEtablissement;
use App\Shared\Entity\SkSalle;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isReserve',CheckboxType::class)
            ->add('etsNom',EntityType::class,array('class'=>SkEtablissement::class))
            ->add('salleNom',TextType::class)
            ->add('salleNumero',TextType::class)
        ;
    }

    public function getBlockPrefix()
    {
        return parent::getBlockPrefix();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver->setDefaults(array('data_class'=>SkSalle::class)));
    }
}