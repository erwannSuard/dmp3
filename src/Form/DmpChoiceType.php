<?php

namespace App\Form;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Romp;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DmpChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('romp', EntityType::class, [
                'class' => Romp::class,

                'label' => "Choose wich DMP you want to download : ",
                'multiple' => false,
                'mapped' => false,
                'choice_label' => 'versionRomp',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
