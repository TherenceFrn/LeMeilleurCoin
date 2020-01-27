<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Title', TextType::class, [
            'required'=>true,
            'attr'=>['placeHolder'=>"Titre", 'maxlength'=>200]
        ]);




            $builder->add('Description', TextType::class, [
                'required'=>true,
                'attr'=>['placeHolder'=>"Description", 'maxlength'=>255]

            ]);


            $builder->add('City', TextType::class, [
                'required'=>true,
                'attr'=>['placeHolder'=>'Votre ville', 'maxlength'=>50]
            ]);

            $builder->add('Zip', NumberType::class, [
                'required'=>true,
                'attr'=>['placeHolder'=>'Code postal']
            ]);


            $builder->add('Price', NumberType::class,[
                'required'=>true,
                'attr'=>['placeHolder'=>'Prix']
            ]);

            $builder->add('DateCreated', DateType::class, [
                'required'=>true,

            ]);



            $builder->add('Author_id');

        $builder->add('submit', SubmitType::class, [
            'label'=>'Ajouter l\'annonce'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'data_class' => Annonce::class,
            'trim'=> true,
        ]);
    }
}
