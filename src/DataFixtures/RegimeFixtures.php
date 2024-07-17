<?php

namespace App\DataFixtures;

use App\Entity\Regime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RegimeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $regime1 = new Regime();
        $regime1->setName("Demi-pensionnaire");
        $this->addReference('regime_1', $regime1);
        $manager->persist($regime1);

        $regime2 = new Regime();
        $regime2->setName("Externe 4 jours");
        $this->addReference('regime_2', $regime2);
        $manager->persist($regime2);

        $regime3 = new Regime();
        $regime3->setName("Externe 5 jours");
        $this->addReference('regime_3', $regime3);
        $manager->persist($regime3);

        $regime4 = new Regime();
        $regime4->setName("Interne");
        $this->addReference('regime_4', $regime4);
        $manager->persist($regime4);

        $regime5 = new Regime();
        $regime5->setName("Interne hébergé");
        $this->addReference('regime_5', $regime5);
        $manager->persist($regime5);

        $manager->flush();
    }
}
