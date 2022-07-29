<?php

namespace App\Form;

use App\Entity\Host;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

// INUTILE POUR L'INSTANT
class HostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hostName', null , [
                'label' => '* Host Name :'
            ])

            ->add('hostDescription', null , [
                'label' => '* Host Description :'
            ])

            ->add('hostUrl', null , [
                'label' => '* Host URL :'
            ])

            ->add('pidSystem')
            ->add('supportVersionning', null , [
                'label' => 'Support Versioning :'
            ])
            ->add('certifiedWith')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Host::class,
        ]);
    }
}
