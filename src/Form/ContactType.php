<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;


use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TextType::class,  [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght => 2',
                    'maxlenght' => '180'
                ],
                'label' => 'Sujet de la demande',
                'label_attr' => [
                    'class' => 'form_label mt-3',
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' =>100])
                ]
            ])
            ->add('nom',TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form_label mt-3',
                ],

            ])

            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form_label mt-3',
                    ],
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght => 2',
                    'maxlenght' => '180'
                ],
                'label' => 'Adresse mail',
                'label_attr' => [
                    'class' => 'form_label mt-3',
                ],
            ])

            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 5,
                ],
        'label' => 'Description',
        'label_attr'=>[
        'class' => 'form_label mt-4'
    ],
        'constraints' => [
            new Assert\NotBlank()
    ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer la demande de contact',
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
            ]);;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
