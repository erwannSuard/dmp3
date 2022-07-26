<?php

namespace App\Form;

use App\Entity\Host;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// INUTILE POUR L'INSTANT
class HostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hostName')
            ->add('hostDescription')
            ->add('hostUrl')
            ->add('pidSystem')
            ->add('supportVersionning')
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
