<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\classe\Search;
use symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;


class SearchType extends AbstractType


{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('string', TextType::class,[
            'label' => false,
            'required'=> false,
            'attr'=> [
                'placeholder'=>'votre recherche',
                'class' => 'form-control-sm'
            ]
            ])
            ->add('categories', EntityType::class, [
                'label' => false,
                 'required'=> false,
                 'class'=>Category::class,
                 'multiple' => true ,
                 'expanded' =>true
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'filtrer',
                'attr' => [
                    'class' => 'btn btn-info'
                ]
                ]);
    }


public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET', 
            'crsf_protection' => false,
        ]);

    }
    public function getBlockPrefix()
    {
        return '';
    }
}
?>