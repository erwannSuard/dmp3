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
                'label' => '* Description :',
                // 'required' => false,
                ])
            ->add('standardName', null, [
                'attr' => [
                    'placeholder' => 'If case no standard is used, outline what type of metadata is created and how. if a metadata schema exists, provide the URL'
                ],
                // 'required' => false,
                ])
            ->add('api', null, [
                'attr' => [
                    'placeholder' => 'API to access Metadata'
                ],
                'label' => '* API :'
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
