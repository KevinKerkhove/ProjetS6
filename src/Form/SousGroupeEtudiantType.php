<?php

namespace App\Form;

use App\Entity\SousGroupeEtudiant;
use Symfony\Component\Form\AbstractType;
use App\Form\Type\SousGroupeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SousGroupeEtudiantType extends AbstractType
{
    private $etudiant;


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->etudiant = $options['etudiant'];
        $builder
            ->add('sous_groupe', SousGroupeType::class)
            ->add('etudiant')
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                [$this, 'onPreSetData']
            );

    }

    public function onPreSetData(FormEvent $event)
    {

        $form = $event->getForm();

        /** @var $sousGroupeEtudiant SousGroupeEtudiant */
        $sousGroupeEtudiant = $event->getData();

        if($this->etudiant!= null)
        {
            $sousGroupeEtudiant->addEtudiant($this->etudiant);
            $form->remove('etudiant');

        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SousGroupeEtudiant::class,
            'etudiant' => null,
        ]);
    }
}
