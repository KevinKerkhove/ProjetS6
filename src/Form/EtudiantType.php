<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Form\Type\ChoixType;
use App\Form\Type\CiviliteType;
use App\Form\Type\InscritType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('civilite', CiviliteType::class)
            ->add('adresse1')
            ->add('adresse2')
            ->add('adresse3')
            ->add('codePostal')
            ->add('commune')
            ->add('pays')
            ->add('telephoneMobile')
            ->add('telephone')
            ->add('email')
            ->add('emailResponsable1')
            ->add('emailResponsable2')
            ->add('choix', ChoixType::class)
            ->add('inscrit',InscritType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
