<?php

namespace App\Form;

use App\Entity\Distribution;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Form\EmbargoType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DistributionEmbargoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('access', ChoiceType::class, [
            'choices' => [
                'Open default' => 'open default',
                'On demand' => 'onDemand',
                'Embargo' => 'embargo',
            ],
            'label' => 'Access : ',
        ])
        ->add('accessUrl', null, [
            // 'required' => false,
            ])
        ->add('accessProtocol', null, [
            // 'required' => false,
            ])
        ->add('sizeValue', null, [
            // 'required' => false,
            ])
        ->add('sizeUnit', ChoiceType::class, [
            'choices' => [
                'Ko' => 'Ko',
                'Mo' => 'Mo',
                'Go' => 'Go',
                'To' => 'To',
                'Po' => 'Po',
            ],
            'label' => 'Size Unit : ',
        ])
        ->add('format')
        ->add('downloadUrl')

        // Embargo
        ->add('embargoStartDate', DateType::class, [
            'mapped' => false,
            'required' => false,
        ])
        ->add('embargoEndDate', DateType::class, [
            'mapped' => false,
            'required' => false,
        ])
        ->add('embargoLegalAndContractualReasons', TextType::class, [
            'mapped' => false,
            'required' => false,
        ])
        ->add('embargoIntentionalRestrictions', TextType::class, [
            'mapped' => false,
            'required' => false,
        ])

        // Licence
        ->add('licenceName', TextType::class, [
            'mapped' => false,
            // 'required' => false,
            'label' => 'Licence name : ',
        ])
        ->add('licenceUrl', TextType::class, [
            'mapped' => false,
            // 'required' => false,
            'label' => 'Licence URL : ',
        ])

        // Host
        ->add('hostName', TextType::class, [
            'mapped' => false,
            // 'required' => false,
            'label' => 'Host name : ',
        ])
        ->add('hostDescription', TextAreaType::class, [
            'mapped' => false,
            // 'required' => false,
            'label' => 'Host description : ',
        ])
        ->add('hostUrl', TextAreaType::class, [
            'mapped' => false,
            // 'required' => false,
            'label' => 'Host URL : ',
        ])
        ->add('pidSystem', TextAreaType::class, [
            'mapped' => false,
            // 'required' => false,
            'label' => 'PID System : ',
        ])
        ->add('supportVersionning', ChoiceType::class, [
            "choices" => [
                'Yes' => true,
                'No' => false
            ],
            'label' => 'Supports Versionning ? ',
            'mapped' => false,
        ])
        ->add('certifiedWith', TextAreaType::class, [
            'mapped' => false,
            // 'required' => false,
            'label' => 'Certified With : ',
        ])


        // ->add('researchOutput')
        // ->add('licence')
        // ->add('host')
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Distribution::class,
        ]);
    }
}
