<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Form;

use App\Entity\EmploiDuTemps;
use App\Entity\Subject;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EmploiDuTempsType.
 */
class EmploiDuTempsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jour', TextType::class, ['label' => 'Jour'])
            ->add('heure', TextType::class, ['label' => 'Heure'])
            ->add(
                'matiere',
                EntityType::class,
                [
                    'label' => 'Matière',
                    'class' => Subject::class,
                    'choice_label' => 'name',
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => EmploiDuTemps::class]);
    }
}
