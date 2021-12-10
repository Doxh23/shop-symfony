<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'label'=> 'mon adresse email',
                'disabled'=> true
            ])
            ->add('firstname',TextType::class,[
                'disabled'=> true,
                'label'=> 'Prénom'
            ])
            ->add('lastname', TextType::class,[
                'label' => 'nom',
                'disabled'=> true
            ])
            ->add('old_password',PasswordType::class, [
                'mapped'=> false,
                'label'=> 'mon password',
                'attr'=> [
                    'placeholder' => 'veuillez saisir votre mdp actuel'
                ]
            ])
            ->add('new_password',RepeatedType::class, [
                'type'=> PasswordType::class,
                'invalid_message' => 'le mot de passe et la confirmation doit etre identique',
                'mapped'=> false,
                'required'=> true,
                'label' => 'mon nouveau mot de passe',
                'attr'=> [
                    'placeholder' => 'merci de saisir votre nouveau mot de passe'
                ],
                'first_options'=> ['label'=> 'mon nouveau mot de passe'],
                'second_options'=> ['label' => 'confirmez votre nouveau mot de passe']
            ])
            ->add('submit',SubmitType::class, [
                'label' => 'mettre a jour '
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
