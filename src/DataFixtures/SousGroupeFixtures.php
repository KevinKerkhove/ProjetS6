<?php

namespace App\DataFixtures;

use App\Entity\Groupe;
use App\Entity\SousGroupe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SousGroupeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $groupes = $manager->getRepository(Groupe::class)->findAll();

        foreach ($groupes as $groupe){
            if($groupe->getNom() !== "LPDIOC"){
                for($i = 1; $i < 3; $i ++) {
                    $sousGroupe = new SousGroupe();
                    $sousGroupe->setNom($groupe->getNom() . "-" . $i);
                    $sousGroupe->setGroupe($groupe);
                    $manager->persist($sousGroupe);
                }
            }
            else{
                $sousGroupe = new SousGroupe();
                $sousGroupe->setNom("LPDIOC");
                $sousGroupe->setGroupe($groupe);
                $manager->persist($sousGroupe);
            }
        }

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
            GroupeFixtures::class,
        );
    }
}
