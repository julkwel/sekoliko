<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 5:19 PM.
 */

namespace App\Shared\Form;

use App\Shared\Entity\SkNote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SkNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SkNote::class,
        ));
    }
}
