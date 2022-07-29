<?php

namespace App\Form;

use App\Entity\Cost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                "choices" => [
                    'Storage' => 'Storage',
                    'Re-Used' => 'Reused',
                    'Archiving' => 'Archiving',
                    'Other' => 'Other',
                ]]

            // 'required' => false,
            )
            ->add('value', null, [
                // 'required' => false,
                ])
            ->add('unit', TextType::class, [
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
