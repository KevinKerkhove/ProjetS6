<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class CiviliteType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices'=>[
                'Mme' => 'Mme',
                'M.' => 'M.',
            ],
            'multiple'=>false,
            'expanded'=>false,
        ]);
    }
    public function getParent(){
        return ChoiceType::class;
    }
}