<?php

namespace App\Form;

use App\Entity\Romp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Contact;

class RompType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('identifier')
            ->add('submissionDate', null, [
                'label' => '* Submission date : ',
            ])
            ->add('versionRomp', TextType::class, [
                'label' => '* ROMP Version : ',
                'attr' => [
                    'placeholder' => '* ROMP Version : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('deliverable', TextType::class, [
                'label' => '* Delivrable n° : ',
                'attr' => [
                    'placeholder' => '* Delivrable n° : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('licenceRomp', ChoiceType::class, [
                'choices' => [
                    'CC-BY-4.0' => 'CC-BY-4.0',
                    'CC-BY-NC-4.0' => 'CC-BY-NC-4.0',
                    'CC-BY--ND-4.0' => 'CC-BY--ND-4.0',
                    'CC-BY--SA-4.0' => 'CC-BY--SA-4.0',
                    'CC0-1.0' => 'CC0-1.0',
                ],
                'label' => 'Licence : ',
                'attr' => [
                    'placeholder' => 'Licence : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])

            ->add('ethicalIssues', TextareaType::class, [
                'label' => 'Ethical issues : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ethical issues : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])

            ->add('contactRomp', EntityType::class, [
                'class' => Contact::class,
                'label' => '* DMP Leader : ',
                'attr' => [
                    'placeholder' => '* DMP Leader : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'mapped' => false,
                // 'multiple' => true,
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Romp::class,
        ]);
    }
}
