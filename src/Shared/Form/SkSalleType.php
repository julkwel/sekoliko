<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 11:56 AM.
 */

namespace App\Shared\Form;

use App\Shared\Entity\SkSalle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkSalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('salleNom', TextType::class, array(
                'label' => 'Salle nom',
            ))
            ->add('salleNumero', TextType::class, array(
                'label' => 'Numero salle',
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SkSalle::class,
        ));
    }
}
