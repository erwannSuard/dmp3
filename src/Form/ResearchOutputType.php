<?php

namespace App\Form;

use App\Entity\ResearchOutput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ResearchOutputType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title : ',
            ])
            ->add('type', ChoiceType::class, [
                "choices" => [
                    'Data Set' => 'dataSet',
                    'Service' => 'service'
                ],
                'label' => 'Type : ',
            ])
            ->add('identifier')
            ->add('description')
            ->add('standardUsed')
            ->add('reused')
            ->add('lineage')
            ->add('utility')
            ->add('issued')
            ->add('language')
            ->add('keyword')
            ->add('costs')
            ->add('contacts')
            // ->add('vocabularyInfos')
            ->add('data')
            ->add('ROReference')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ResearchOutput::class,
        ]);
    }
}
