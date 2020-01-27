<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',  TextType::class, [
                'required' => true,
                "label" => "Nom",
                'attr' => ['placeHolder' => "Nom", 'maxlength' => 50]
            ]);

        ;

        $builder->add('email', EmailType::class, [
            'required' => true,
            'label' => 'Email',
            'attr' => ['placeHolder' => 'Email', 'maxlength' => 50]
        ]);

        $builder->add('password', PasswordType::class, [
            'required' => true,
            'label' => 'Password',
            'attr' => ['placeHolder' => 'Password', 'maxlength' => 50]
        ]);

        $builder->add('submit', SubmitType::class, [
            'label' => 'S\'inscrire',

        ]);
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'data_class' => User::class,
            'trim' => true,
        ]);
    }
}
