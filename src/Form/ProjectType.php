<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Project Title : '
            ])
            ->add('abstract')
            ->add('acronym', TextType::class, [
                'label' => 'Project\'s Acronym'
            ])
            ->add('funding', CollectionType::class, [
                'label' => false,
                'entry_type' => FundingType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'prototype' => true,
                'mapped' => false,
                'prototype_name' => 'project',
            ])
            ->add('startDate')
            ->add('duration', TextType::class, [
                'label' => 'Duration in month (optionnal)',
                'required' => false,
            ])
            ->add('website', TextType::class, [
                'label' => 'Website (optionnal)',
                'required' => false,
            ])
            ->add('objectives', TextAreaType::class, [
                'label' => 'Objectives (optionnal)',
                'required' => false,
            ])
            ->add('idContact', EntityType::class, [
                'class' => Contact::class,
                'label' => 'Project Coordinator',
                'mapped' => false,
                // 'multiple' => true,
                
            ])

            ->add('idRefProject', CollectionType::class, 

            [   'label' => false,
                'entry_type' => WorkPackageType::class,
                'entry_options' => ['label' => false],
                //Permettre de rajouter des formulaires :
                'allow_add' => true,

                //Pour ne pas lier le champ à l'objet
                'mapped' => false,
                //Je ne sais pas encore pourquoi :
                'by_reference' => true,
                'allow_delete' => true,
                'prototype' => true,
            ]
            )
            ->add('submit', SubmitType::class, [
                'label' => 'Add Project'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}