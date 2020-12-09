<?php

namespace App\DataFixtures;

use App\Entity\Promotion;
use DateTime;
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
        $promotion->setAnnees($date = new DateTime("2020-09-05 00:00:00"));
        $manager->persist($promotion);

        $promotion = new Promotion();
        $promotion->setNom("DUT2");
        $promotion->setAnnees(new DateTime("2020-09-05 00:00:00"));
        $manager->persist($promotion);

        $promotion = new Promotion();
        $promotion->setNom("LPDIOC");
        $promotion->setAnnees(new DateTime("2020-09-05 00:00:00"));
        $manager->persist($promotion);



        $promotion = new Promotion();
        $promotion->setNom("DUT1");
        $promotion->setAnnees(new DateTime("2019-09-05 00:00:00"));
        $manager->persist($promotion);

        $promotion = new Promotion();
        $promotion->setNom("DUT2");
        $promotion->setAnnees(new DateTime("2019-09-05 00:00:00"));
        $manager->persist($promotion);

        $promotion = new Promotion();
        $promotion->setNom("LPDIOC");
        $promotion->setAnnees(new DateTime("2019-09-05 00:00:00"));
        $manager->persist($promotion);


        $promotion = new Promotion();
        $promotion->setNom("DUT1");
        $promotion->setAnnees(new DateTime("2018-09-05 00:00:00"));
        $manager->persist($promotion);

        $promotion = new Promotion();
        $promotion->setNom("DUT2");
        $promotion->setAnnees(new DateTime("2018-09-05 00:00:00"));
        $manager->persist($promotion);

        $promotion = new Promotion();
        $promotion->setNom("LPDIOC");
        $promotion->setAnnees(new DateTime("2018-09-05 00:00:00"));
        $manager->persist($promotion);


        $manager->flush();
    }
}
