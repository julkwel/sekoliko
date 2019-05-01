<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/29/19
 * Time: 10:41 AM.
 */

namespace App\Shared\Form;

use App\Shared\Entity\SkBook;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bookName', TextType::class, array(
                'label' => 'Nom du livre',
                'required' => true,
            ))
            ->add('author', TextType::class, array(
                'label' => 'Auteur',
                'required' => true,
            ))
            ->add('edition', TextType::class, array(
                'label' => 'Edition ou type de livre',
                'required' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => SkBook::class));
    }
}
