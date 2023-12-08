<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'btn btn-dark p-2'
                ],
                'download_uri' => false,
                'image_uri' => false,
                'delete_label' => 'Supprimer',
                'required' => false,
            ])
            ->add('nom', TextType::class, [
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
            ->add('plainPassword', PasswordType::class, [
                    'label' => 'Mot de passe actuel',
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label_attr' => [
                        'class' => 'form-label mt-3'
                    ]
                
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier',
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
