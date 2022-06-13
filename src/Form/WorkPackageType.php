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
                'label' => 'Title : '
            ])
            ->add('abstract', TextType::class,[
                'label' => 'Abstract : '
            ])
            
            ->add('startDate')
            ->add('duration', null, [
                'label' => 'Duration in month (optionnal)',
                'required' => false,
            ])
            
            ->add('website', TextType::class,[
                'label' => 'Website : '
            ])
            ->add('objectives', TextAreaType::class,[
                'label' => 'Objectives : '
            ])

            ->add('idContact', EntityType::class, 
            [
                'label' => 'Work package leader',
                'class' => Contact::class,
                'choice_label' => 'lastName',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                'mapped' => false,
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
