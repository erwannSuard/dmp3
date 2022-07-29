<?php

namespace App\Form;

use App\Entity\VocabularyInfo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VocabularyInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vocabularyName',TextType::class)
            ->add('uri', TextType::class, [
                'label' => '* URI',
            ])
            // ->add('ResearchOutputs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VocabularyInfo::class,
        ]);
    }
}
