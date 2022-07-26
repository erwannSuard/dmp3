<?php

namespace App\Form;

use App\Entity\MetadataInfo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MetadataInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', null, [
                // 'required' => false,
                ])
            ->add('standardName', null, [
                // 'required' => false,
                ])
            ->add('api', null, [
                // 'required' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MetadataInfo::class,
        ]);
    }
}
