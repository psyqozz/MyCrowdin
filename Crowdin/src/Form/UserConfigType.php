<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Langage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Votre E-mail',
                'label_attr' => array('class' => 'col-form-label'),
            ))
            ->add('username', TextType::class, array(
                'label' => "Votre nom d'Utilisateur",
                'label_attr' => array('class' => 'col-form-label')
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Saissisez votre Mot de Passe', 'label_attr' => array('class' => 'col-form-label')),
                'second_options' => array('label' => 'Confirmez le Mot de Passe', 'label_attr' => array('class' => 'col-form-label')),
                'label' => 'Saissisez votre Mot de Passe'
            ))
            ->add('description', TextareaType::class, array(
                'required'   => false,
                'label' => 'Dites un peu plus sur vous :',
                'label_attr' => array('class' => 'col-form-label')
            ))
            ->add('langages', EntityType::class, array(
                'class' => Langage::class,
                'choice_label' => function($langages){ return $langages->getLibelleLangage(); },
                'label_attr' => array('class' => 'custom-control-label'),
                'choice_attr' => function () { return array('class' => 'input'); },
                'multiple' => true,
                'expanded' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
