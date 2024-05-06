<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Entrer votre email',
                'attr' => [
                    'placeholder' => 'Entrez votre email ici'
                ],
            ])
            
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [new Length(['min' => 4, 'max' => 30])],
                'first_options' => [
                    'label' => 'Votre mot de passe',                     
                'attr' => [
                    'placeholder' => 'Choisissez votre mot de passe'
                ],
                    'hash_property_path' => 'password'
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                'attr' => [
                    'placeholder' => 'Confirmez votre mot de passe ici'
                ]
            ],
                
                'mapped' => false,
            ])
            
            ->add('firstname', TextType::class, [
                'label' => 'Entrer votre prénom',
                'constraints' => [new Length(['min' => 2, 'max' => 30])],
                'attr' => [
                    'placeholder' => 'Entrez votre prénom ici'
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Entrer votre nom',
                'constraints' => [new Length(['min' => 2, 'max' => 30])],
                'attr' => [
                    'placeholder' => 'Entrez votre nom ici'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-success'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [new UniqueEntity(['entityClass' => User::class, 'fields' => 'email'])],
            'data_class' => User::class,
        ]);
    }
}