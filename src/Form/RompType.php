<?php

namespace App\Form;

use App\Entity\Romp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RompType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('identifier')
            ->add('submissionDate')
            ->add('versionRomp', TextType::class)
            ->add('deliverable', TextType::class)
            ->add('licenceRomp', ChoiceType::class, [
                'choices' => [
                    'CC-BY-4.0' => 'CC-BY-4.0',
                    'CC-BY-NC-4.0' => 'CC-BY-NC-4.0',
                    'CC-BY--ND-4.0' => 'CC-BY--ND-4.0',
                    'CC-BY--SA-4.0' => 'CC-BY--SA-4.0',
                    'CC0-1.0' => 'CC0-1.0',
                ]
            ])

            ->add('ethicalIssues', TextareaType::class, [
                'label' => 'Ethical issues (optionnal) : ',
                'required' => false,
            ])

            ->add('contact', EntityType::class, [
                'class' => Contact::class,
                'label' => 'Project Coordinator',
                'mapped' => false,
                // 'multiple' => true,
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Romp::class,
        ]);
    }
}
