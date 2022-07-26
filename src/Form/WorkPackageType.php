<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class WorkPackageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('title', TextType::class,[
                'label' => '* WP Title : ',
                'attr' => [
                    'placeholder' => '* WP Title :'
                ],
                'row_attr' => [
                    'class' => 'form-floating mt-4 mt-3',
                ],
            ])
            ->add('abstract', TextAreaType::class,[
                'label' => '* Abstract : ',
                'attr' => [
                    'placeholder' => '* Abstract : '
                ],
                'row_attr' => [
                    'class' => 'form-floating mt-4',
                ],
            ])
            
            ->add('startDate')
            ->add('duration', null, [
                'label' => 'Duration (in month) :',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Duration (in month) : '
                ],
                'row_attr' => [
                    'class' => 'form-floating mt-4',
                ],

            ])
            
            ->add('website', TextType::class, [
                'label' => 'Website :',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Website : '
                ],
                'row_attr' => [
                    'class' => 'form-floating mt-4',
                ],
            ])
            ->add('objectives', TextAreaType::class, [
                'label' => 'Objectives',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Objectives : '
                ],
                'row_attr' => [
                    'class' => 'form-floating mt-4',
                ],
            ])

            ->add('idContact', EntityType::class, 
            [
                'label' => '* Work package leader :',
                'class' => Contact::class,
                'choice_label' => 'lastName',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                'mapped' => false,
                'attr' => [
                    'placeholder' => '* Work package leader : '
                ],
                'row_attr' => [
                    'class' => 'form-floating mt-4',
                ],
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
