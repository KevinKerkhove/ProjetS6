<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('yaya@gmail.com');
        $plainPassword = ('yaya');
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);
        $this->addReference($user->getUsername(), $user);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('loulou@gmail.com');
        $plainPassword = ('loulou');
        $user->setRoles(['ROLE_ADMIN']);
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);
        $this->addReference($user->getUsername(), $user);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('kerkove@gmail.com');
        $plainPassword = ('kerkove');
        $user->setRoles(['ROLE_USER']);
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);
        $this->addReference($user->getUsername(), $user);
        $manager->persist($user);

        $manager->flush();
    }
}
