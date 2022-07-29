<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\ResearchOutput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\VocabularyInfoType;
use App\Form\DataType;
use App\Form\MetadataInfoType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Romp;
use App\Repository\ProjectRepository;
use App\Entity\Project;



class ResearchOutputType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('romp', EntityType::class, [
            'class' => Romp::class,
            'label' => "Wich DMP are you referencing : ",
            'multiple' => false,
            'choice_label' => 'versionRomp',
            ])
            ->add('workPackage', EntityType::class, [
                'class' => Project::class,
                'query_builder' => function (ProjectRepository $pr) {
                    return $pr->createQueryBuilder('u')
                        ->where('u.parentProject IS NOT null'); // Selection des projets ayant un projet parent (WP)
                },
                'label' => "Choose wich Work Package is your Research Output for : ",
                'multiple' => false,
                'choice_label' => 'title',
            ])
            ->add('title', TextType::class, [
                'label' => 'Title : ',
                // 'required' => false,
                    
            ])
            ->add('type', ChoiceType::class, [
                "choices" => [
                    'Data Set' => 'dataSet',
                    'Service' => 'service',
                ],
                'label' => 'Type : ',
            ])
            ->add('identifier', TextType::class, [
                'label' => 'Identifier : ',
                // 'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description : ',
                // 'required' => false,
            ])
            ->add('standardUsed', TextType::class, [
                'label' => 'Standard Used : ',
                // 'required' => false,
                'attr' => ['placeholder' => 'If so, provide an URL here...']
            ])
            ->add('reused', ChoiceType::class, [
                "choices" => [
                    'Yes' => true,
                    'No' => false
                ],
                'label' => 'Re-used : ',
            ])
            ->add('lineage', TextareaType::class, [
                'label' => 'Lineage : ',
                // 'required' => false,
                'attr' => ['placeholder' => 'If a document exists, please provide an access URL...']
            ])
            ->add('utility', TextareaType::class, [
                'label' => 'Utility : ',
                // 'required' => false,
            ])
            ->add('issued', DateType::class, [
                
                // 'required' => false,
                // // adds a class that can be selected in JavaScript
                // 'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('language', TextType::class, [
                'label' => 'Language : ',
                // 'required' => false,
            ])
            ->add('keyword', TextareaType::class, [
                'label' => 'Keywords : ',
                // 'required' => false,
                'mapped' => false, 
                'attr' => ['placeholder' => 'Separate each keyword with a comma...']
            ])
            ->add('costs', ChoiceType::class, [
                "choices" => [
                    'Yes' => true,
                    'No' => false
                ],
                'label' => 'Are the costs covered by the project ? ',
                'mapped' => false,
            ])
            ->add('vocabulary', ChoiceType::class, [
                "choices" => [
                    'Yes' => true,
                    'No' => false
                ],
                'label' => 'Is a vocabulary used ? ',
                'mapped' => false,
            ])
            
            ->add('contacts', EntityType::class, [
            // looks for choices from this entity
            'class' => Contact::class,
            // used to render a select box, check boxes or radios
            'multiple' => true,
            'expanded' => false,
            ])
            ->add('vocabularyInfos', CollectionType::class, 

            [   'label' => false,
            'entry_type' => VocabularyInfoType::class,
            'entry_options' => ['label' => false],
            //Permettre de rajouter des formulaires :
            'allow_add' => true,
            'mapped' => false,
            'by_reference' => true,
            'allow_delete' => true,
            'prototype' => true,
        ])
        ->add('distribution', CollectionType::class, 

            [   'label' => false,
            'entry_type' => DistributionEmbargoType::class,
            'entry_options' => ['label' => false],
            //Permettre de rajouter des formulaires :
            'allow_add' => true,
            'mapped' => false,
            'by_reference' => true,
            'allow_delete' => true,
            'prototype' => true,
        ])
        ->add('cost', CostType::class, [
            'mapped' => false,
            'label' => false,
            'required' => false,
        ])
        ->add('data', DataType::class, [
            'mapped' => false,
            'label' => false,
            'required' => false,
        ])
        ->add('service', ServiceType::class, [
            'mapped' => false,
            'label' => false,
            'required' => false,
        ])
        ->add('metadata', MetaDataInfoType::class, [
            'mapped' => false,
            'label' => false,
            // 'required' => false,
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Submit the Research Output',
        ])
        ;
        // ->add('distribution', CollectionType::class, 

        //     [   'label' => false,
        //     'entry_type' => DistributionType::class,
        //     'entry_options' => ['label' => false],
        //     //Permettre de rajouter des formulaires :
        //     'allow_add' => true,
        //     'mapped' => false,
        //     'by_reference' => true,
        //     'allow_delete' => true,
        //     'prototype' => true,
        // ])
        // ->add('embargo', CollectionType::class, 

        //     [   'label' => false,
        //     'entry_type' => EmbargoType::class,
        //     'entry_options' => ['label' => false],
        //     //Permettre de rajouter des formulaires :
        //     'allow_add' => true,
        //     'mapped' => false,
        //     'by_reference' => true,
        //     'allow_delete' => true,
        //     'prototype' => true,
        // ])  
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ResearchOutput::class,
        ]);
    }

}
