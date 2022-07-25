<?php

namespace App\Form;

use App\Entity\Distribution;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DistributionType extends AbstractType
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
            ->add('accessUrl')
            ->add('accessProtocol')
            ->add('sizeValue')
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
            // ->add('embargo')
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
