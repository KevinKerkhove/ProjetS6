<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class NomPromoType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices'=>[
                'DUT1' => "DUT1",
                'DUT2' => "DUT2",
                'LPDIOC' => "LPDIOC",
            ],
            'multiple'=>false,
            'expanded'=>false,
        ]);
    }
    public function getParent(){
        return ChoiceType::class;
    }
}