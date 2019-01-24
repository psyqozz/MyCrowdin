<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Langage;
use App\Entity\SourceTranslated;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Security\Core\Security;

class TranslateType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tabLang = $options['tabLang'];
        $builder
            ->add('langTranslate', ChoiceType::class, array(
                'label' => 'Choissisez dans quel langue traduire :',
                'choices' => $tabLang,
                'attr' => array(
                    'onchange' => 'myFunctionDisplay()',
                    'onload' => 'myFunctionDisplay()'
                )
            ))
            ->add('valueTranslated', TextareaType::class, array(
                'required'   => true,
                'label' => ' ',
                'label_attr' => array('class' => 'col-form-label'),
                'attr' => array('placeholder' => 'Entrez la traduction ici'),
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('tabLang');
        $resolver->setDefaults([
            'data_class' => SourceTranslated::class,
        ]);
    }
}
