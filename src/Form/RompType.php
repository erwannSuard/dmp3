<?php

namespace App\Form;

use App\Entity\Romp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Contact;

class RompType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('identifier')
            ->add('submissionDate', null, [
                'label' => 'Submission date : ',
            ])
            ->add('versionRomp', TextType::class, [
                'label' => 'ROMP Version : ',
            ])
            ->add('deliverable', TextType::class, [
                'label' => 'Deliverable n° : ',
            ])
            ->add('licenceRomp', ChoiceType::class, [
                'choices' => [
                    'CC-BY-4.0' => 'CC-BY-4.0',
                    'CC-BY-NC-4.0' => 'CC-BY-NC-4.0',
                    'CC-BY--ND-4.0' => 'CC-BY--ND-4.0',
                    'CC-BY--SA-4.0' => 'CC-BY--SA-4.0',
                    'CC0-1.0' => 'CC0-1.0',
                ],
                'label' => 'Licence : ',
            ])

            ->add('ethicalIssues', TextareaType::class, [
                'label' => 'Ethical issues (optionnal) : ',
                'required' => false,
            ])

            ->add('contact', EntityType::class, [
                'class' => Contact::class,
                'label' => 'DMP Leader : ',
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
