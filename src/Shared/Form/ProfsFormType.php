<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/11/19
 * Time: 11:10 AM.
 */

namespace App\Shared\Form;

use App\Shared\Entity\SkClasse;
use App\Shared\Entity\SkMatiere;
use App\Shared\Entity\SkProfs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfsFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('classe', EntityType::class, array('class' => SkClasse::class))
            ->add('matiere', EntityType::class, array('class' => SkMatiere::class))
            ->add('profs', EntityType::class, array('class' => SkProfs::class))
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => SkProfs::class));
    }

    /**
     * @return string|null
     */
    public function getBlockPrefix()
    {
        return parent::getBlockPrefix();
    }
}
