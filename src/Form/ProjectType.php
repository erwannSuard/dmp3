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
                'label' => '* Project title : ',
                'attr' => [
                    'placeholder' => '* Project title : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('abstract' ,TextAreaType::class, [
                'label' => '* Abstract : ',
                'attr' => [
                    'placeholder' => '* Abstract : ',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                    'rows' => '3'
                ],
            ])
            ->add('acronym', TextType::class, [
                'label' => '* Project\'s acronym : ',
                'attr' => [
                    'placeholder' => '* Project\'s acronym : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            //----------   Form Funding   ----------
            ->add('funding', CollectionType::class, [
                'label' => false,
                'entry_type' => FundingType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'prototype' => true,
                'mapped' => false,
                'prototype_name' => 'project',
            ])
            //------------------------------------
            ->add('startDate', null, [
                'label' => '* Project starting date : '
            ])
            ->add('duration', null, [
                'label' => 'Duration in month : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Duration in month : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])

            ->add('website', TextType::class, [
                'label' => 'Website : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Website : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('objectives', TextAreaType::class, [
                'label' => 'Objectives : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Objectives : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])

            ->add('idContact', EntityType::class, [
                'class' => Contact::class,
                'label' => '* Project Coordinator : ',
                'attr' => [
                    'placeholder' => '* Project Coordinator : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'mapped' => false,
                // 'multiple' => true,
                
            ])


            //----------   Work Package(s)   ----------
            ->add('idRefProject', CollectionType::class, 

            [   'label' => false,
                'entry_type' => WorkPackageType::class,
                'entry_options' => ['label' => false],
                //Permettre de rajouter des formulaires :
                'allow_add' => true,

                //Pour ne pas lier le champ à l'objet
                'mapped' => false,
                'by_reference' => true,
                'allow_delete' => true,
                'prototype' => true,
            ])
            //-------------------------------------------

            //---------------   ROMP   ---------------
            ->add('romp', CollectionType::class, [
                'entry_type' => RompType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'prototype' => true,
                'mapped' => false,
                'prototype_name' => 'romp',
                'label' => false,
            ])
            //-----------------------------------
            ->add('submit', SubmitType::class, [
                'label' => 'Submit the Project'
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