<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label' => 'quel nom souhaitez vous donner a votre adress',
                'attr' => [
                    'placeholder'=> 'nommez votre adresse'
                ]
            ])
            ->add('firstname',TextType::class,[
                'label' => 'quel est votre prénom',
                'attr' => [
                    'placeholder'=> 'quel est votre prenom'
                ]
            ])
            ->add('lastname',TextType::class,[
                'label' => 'quel est votre Nom',
                'attr' => [
                    'placeholder'=> 'quel est votre prenom'
                ]
            ])
            ->add('company',TextType::class,[
                'label' => 'votre nom de société',
                'attr' => [
                    'placeholder'=> 'nommez votre société'
                ]
            ])
            ->add('adress',TextType::class,[
                'label' => 'quel est votre adresse',
                'attr' => [
                    'placeholder'=> 'quel est  votre adresse'
                ]
            ])
            ->add('postal',TextType::class,[
                'label' => 'quel est votre code postale',
                'attr' => [
                    'placeholder'=> 'code postale'
                ]
            ])
            ->add('city',TextType::class,[
                'label' => 'quel est le nom de votre ville',
                'attr' => [
                    'placeholder'=> 'nommez votre ville'
                ]
            ])
            ->add('phone',TextType::class,[
                'label' => 'quel est votre numéro de téléphone',
                'attr' => [
                    'placeholder'=> 'votre numéro de téléphone'
                ]
            ])
            ->add('submit',SubmitType::class,[
                'attr' => [
                    'placeholder'=> 'sauvegardez cette nouvelle adresse'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
