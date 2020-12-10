<?php


namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class InscritType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'NON' => 0,
                'OUI' => 1,
            ],
            'multiple' => false,
            'expanded' => false,
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}