<?php

namespace App\Form;

use App\Entity\ResearchOutput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ResearchOutputType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title : ',
            ])
            ->add('type', ChoiceType::class, [
                "choices" => [
                    'Data Set' => 'dataSet',
                    'Service' => 'service'
                ],
                'label' => 'Type : ',
            ])
            ->add('identifier', TextType::class, [
                'label' => 'Identifier : ',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description : ',
                'required' => false,
            ])
            ->add('standardUsed', TextType::class, [
                'label' => 'Standard Used : ',
                'required' => false,
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
                'required' => false,
                'attr' => ['placeholder' => 'If a document exists, please provide an access URL...']
            ])
            ->add('utility', TextareaType::class, [
                'label' => 'Utility : ',
                'required' => false,
            ])
            ->add('issued', DateType::class, [
            
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('language', TextType::class, [
                'label' => 'Language : ',
            ])
            ->add('keyword', TextareaType::class, [
                'label' => 'Keywords : ',
                'required' => false,
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
            
            // ->add('contacts')
            // ->add('vocabularyInfos')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ResearchOutput::class,
        ]);
    }

    public function buildCostForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('price');

        
    }
}
