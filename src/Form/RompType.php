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
use App\Entity\Project;
use App\Repository\ProjectRepository;

class RompType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('identifier')
            
            //On ne retourne pas les WP
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'query_builder' => function (ProjectRepository $pr) {
                    return $pr->createQueryBuilder('u')
                        ->where('u.parentProject IS null');
                },
                'label' => "Choose wich project is your DMP for : ",
                'multiple' => false,
                'choice_label' => 'title',
            ])
            ->add('submissionDate', null, [
                'label' => 'Submission date : ',
            ])
            ->add('versionRomp', TextType::class, [
                'label' => 'ROMP Version : ',
            ])
            ->add('deliverable', TextType::class, [
                'label' => 'Deliverable n° : ',
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
            ])

            ->add('ethicalIssues', TextareaType::class, [
                'label' => 'Ethical issues (optionnal) : ',
                'required' => false,
            ])

            ->add('contactRomp', EntityType::class, [
                'class' => Contact::class,
                'label' => 'DMP Leader : ',
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
