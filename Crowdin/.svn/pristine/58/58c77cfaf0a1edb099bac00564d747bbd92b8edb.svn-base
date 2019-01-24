<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Project;
use App\Entity\Langage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameProject', TextType::class, array('label' => 'Nom du Projet'))
            ->add('langOrigin', EntityType::class, array(
                'class' => Langage::class,
                'label' => 'Langue(s) :',
                'choice_label' => function($langOrigin){
                    return $langOrigin->getLibelleLangage();
                }
            ))
            // ->add('langue', ChoiceType::class, [
            //     'choices' => [
            //         'Français' => 'français',
            //         'Anglais'  => 'anglais',
            //         'Espagnol' => 'espagnol',
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Project::class,
        ));
    }
}
