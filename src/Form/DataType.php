<?php

namespace App\Form;

use App\Entity\Data;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sensitiveData', null, [
                'label' => '* Sensitive Data :'
                // 'required' => false,
                ])
            ->add('personalData', null, [
                'label' => '* Personal Data'
                // 'required' => false,
                ])
            ->add('dataSecurity', null, [
                // 'required' => false,
                ])
            //->add('researchOutput')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Data::class,
        ]);
    }
}
