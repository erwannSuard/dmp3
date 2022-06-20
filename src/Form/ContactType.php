<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class, [
                'label' => 'Last Name or Organization * : ',
                'attr' => [
                    'placeholder' => 'Last Name or Organization * : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'First Name : ',
                'attr' => [
                    'placeholder' => 'First Name : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'required' => false,
            ])
            ->add('mail', TextType::class, [
                'label' => 'Mail * : ',
                'attr' => [
                    'placeholder' => 'Mail * : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ]
            ])
            ->add('affiliation', TextType::class, [
                'label' => 'Affiliation * : ',
                'attr' => [
                    'placeholder' => 'Affiliation * : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('laboratoryOrDepartment', TextType::class, [
                'label' => 'Laboratory or Department : ',
                'attr' => [
                    'placeholder' => 'Laboratory or Department : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'required' => false,
            ])
            ->add('identifier', TextType::class, [
                'label' => 'ORCID type identifier : ',
                'attr' => [
                    'placeholder' => 'ORCID type identifier : '
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'required' => false,
            ])
            // ->add('submit', SubmitType::class, [
            //     'label' => 'Submit new Contact'
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
