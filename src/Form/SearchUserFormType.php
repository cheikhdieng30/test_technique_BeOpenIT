<?php
// src/Form/SearchUserFormType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => false,
                'attr' =>  [
                    'placeholder' => 'Recherche d\'utilisateur GitHub',
                    'class' => 'me-2 w-100',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Le nom d\'utilisateur ne peut pas être vide']),
                    // Vous pouvez ajouter d'autres contraintes selon vos besoins
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Mapping du formulaire vers une route spécifique
            'action' => '/',
            'method' => 'GET', // ou 'POST' selon vos besoins
        ]);
    }
}
