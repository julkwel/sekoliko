<?php

namespace App\Shared\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FilterUserType.
 *
 * @author Max
 */
class FilterUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => "Nom d'utilisateur",
                'attr' => [
                    'class' => 'form-control',
                    'required' => false,
                    ],
            ])
            ->add('userFirstName', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control',
                    'required' => false,
                ],
            ])
            ->add('userLastName', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control',
                    'required' => false,
                    ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Filter',
                'attr' => ['class' => 'btn btn-primary'],
            ])
            ->setMethod('GET')
            ->setAction($options['router']->generate('user_search'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'router' => null,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }

    /**
     * @return string|null
     */
    public function getBlockPrefix()
    {
        return null;
    }
}
