<?php

namespace App\DataFixtures;

use App\Entity\Groupe;
use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GroupeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $promotions = $manager->getRepository(Promotion::class)->findAll();

        $groupe = new Groupe();
        $groupe->setNom("1-A");
        $groupe->setPromotion($promotions[0]);
        $manager->persist($groupe);

        $groupe = new Groupe();
        $groupe->setNom("1-B");
        $groupe->setPromotion($promotions[0]);
        $manager->persist($groupe);
        $groupe = new Groupe();

        $groupe->setNom("1-C");
        $groupe->setPromotion($promotions[0]);
        $manager->persist($groupe);
        $groupe = new Groupe();

        $groupe->setNom("1-D");
        $groupe->setPromotion($promotions[0]);
        $manager->persist($groupe);


        $groupe = new Groupe();
        $groupe->setNom("2-A");
        $groupe->setPromotion($promotions[1]);
        $manager->persist($groupe);

        $groupe = new Groupe();
        $groupe->setNom("2-B");
        $groupe->setPromotion($promotions[1]);
        $manager->persist($groupe);
        $groupe = new Groupe();

        $groupe->setNom("2-C");
        $groupe->setPromotion($promotions[1]);
        $manager->persist($groupe);




        $groupe = new Groupe();
        $groupe->setNom("LPDIOC");
        $groupe->setPromotion($promotions[2]);
        $manager->persist($groupe);


        $manager->flush();
    }


    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return class-string[]
     */
    public function getDependencies()
    {
        return array(
            PromotionFixtures::class,
        );
    }
}
