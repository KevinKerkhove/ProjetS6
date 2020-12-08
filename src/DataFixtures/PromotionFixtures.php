<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PromotionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $promotion = new Promotion();
        $promotion->setNom("DUT1");
        $manager->persist($promotion);

        $promotion = new Promotion();
        $promotion->setNom("DUT2");
        $manager->persist($promotion);

        $promotion = new Promotion();
        $promotion->setNom("LPDIOC");
        $manager->persist($promotion);

        $manager->flush();
    }
}
