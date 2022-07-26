<?php

namespace App\Form;

use App\Entity\Cost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', null, [
            // 'required' => false,
            ])
            ->add('value', null, [
                // 'required' => false,
                ])
            ->add('unit', null, [
                // 'required' => false,
                ])
            ->add('fundedBy', null, [
                // 'required' => false,
                ])
            //->add('ResearchOutput')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cost::class,
        ]);
    }
}
