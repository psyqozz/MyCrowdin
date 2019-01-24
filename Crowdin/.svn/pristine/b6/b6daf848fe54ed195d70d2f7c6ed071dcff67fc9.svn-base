<?php

namespace App\Form;

use App\Entity\Source;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddOneSourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oneSource', TextareaType::class, array(
                'label' => 'Source à traduire :',
                'label_attr' => array('class' => 'col-form-label')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Source::class,
        ]);
    }
}
