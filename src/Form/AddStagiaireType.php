<?php

namespace App\Form;

use App\Entity\Stagiaire;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddStagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomst')
            ->add('prenomst')
            ->add('datensst')
            ->add('sexest')
            ->add('email',TextType::class)
            ->add('phone')
            ->add('cin')
            ->add('codegr')
            ->add('codese')
            ->add('codeex')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
