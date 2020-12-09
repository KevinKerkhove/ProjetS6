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

        foreach ($promotions as $promotion) {
            if ($promotion->getNom() === 'DUT1')
            {
                $groupe = new Groupe();
                $groupe->setNom("1-A");
                $groupe->setPromotion($promotion);
                $manager->persist($groupe);

                $groupe = new Groupe();
                $groupe->setNom("1-B");
                $groupe->setPromotion($promotion);
                $manager->persist($groupe);
                $groupe = new Groupe();

                $groupe->setNom("1-C");
                $groupe->setPromotion($promotion);
                $manager->persist($groupe);
                $groupe = new Groupe();

                $groupe->setNom("1-D");
                $groupe->setPromotion($promotion);
                $manager->persist($groupe);
            }
            elseif($promotion->getNom() === 'DUT2')
            {
                $groupe = new Groupe();
                $groupe->setNom("2-A");
                $groupe->setPromotion($promotion);
                $manager->persist($groupe);

                $groupe = new Groupe();
                $groupe->setNom("2-B");
                $groupe->setPromotion($promotion);
                $manager->persist($groupe);
                $groupe = new Groupe();

                $groupe->setNom("2-C");
                $groupe->setPromotion($promotion);
                $manager->persist($groupe);
            }
            else{
                $groupe = new Groupe();
                $groupe->setNom("LPDIOC");
                $groupe->setPromotion($promotion);
                $manager->persist($groupe);

            }
            $manager->flush();
        }
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
