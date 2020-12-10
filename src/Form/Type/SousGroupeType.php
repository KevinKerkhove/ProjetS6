<?php


namespace App\Form\Type;

use App\Entity\SousGroupe;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SousGroupeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => SousGroupe::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('sg')
                    ->innerjoin('sg.groupe', 'g')
                    ->innerJoin('g.promotion','p')
                    ->orderBy('p.annees', 'DESC');
            },
            'choice_label' => function ($sousGroupe)
            {
        return $sousGroupe->getnom() . '-' . $sousGroupe->getGroupe()->getPromotion()->getNom() . '-' . date_format ($sousGroupe->getGroupe()->getPromotion()->getAnnees(),'Y');

        },
            'multiple' => true,
            'expanded' => false,
        ]);

    }

    public function getParent()
    {
        return EntityType::class;
    }
}