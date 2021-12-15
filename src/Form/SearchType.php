<?php

namespace App\Form;
use App\classe\Search;
use symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SearchType extends AbstractType


{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('string', TextType::class,[
            'label' => 'recherche',
            'required'=> false,
            'attr'=> [
                'placeholder'=>'votre recherche'
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