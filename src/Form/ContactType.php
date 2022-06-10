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
                'label' => 'Last Name or Organization : '
            ])
            ->add('firstName', TextType::class, [
                'label' => 'First Name (optionnal) : ',
                'required' => false,
            ])
            ->add('mail', TextType::class, [
                'label' => 'Mail : '
            ])
            ->add('affiliation', TextType::class, [
                'label' => 'Affiliation : '
            ])
            ->add('laboratoryOrDepartment', TextType::class, [
                'label' => 'Laboratory or Department (optionnal): ',
                'required' => false,
            ])
            ->add('identifier', TextType::class, [
                'label' => 'ORCID type identifier (optionnal) : ',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit new Contact'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
