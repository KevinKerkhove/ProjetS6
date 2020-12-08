<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserType extends AbstractType
{

    private $encoder;
    private $etudiant;
    private $tokenStorage;
    private $authorizationChecker;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker,
        UserPasswordEncoderInterface $encoder
    ){
        $this->encoder = $encoder;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->etudiant = $options['etudiant'];
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                [$this, 'onPreSetData']
            );
    }

    public function onPreSetData(FormEvent $event)
    {

        $form = $event->getForm();

        /** @var $user User */
        $user = $event->getData();

        if($this->etudiant !== null){
            $user->setEmail($this->etudiant->getEmail());
            $form->remove('email');

            $plainPassword = ($this->etudiant->getNom() . $this->etudiant->getPrenom());
            $encoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);
            $form->remove('password');

            $user->setRoles(['ROLE_USER']);
            $form->remove('roles');

            $this->etudiant->setUser($user);

        }
    }




    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'etudiant' => null,
        ]);
    }
}
