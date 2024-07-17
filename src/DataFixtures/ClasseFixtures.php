<?php

namespace App\DataFixtures;

use App\Entity\Classes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 6; $i > 0; $i--) {
            for ($j = 1; $j <= 3; $j++) {
                $classe = new Classes();
                $classe->setName($i . 'e ' . $j);
                $this->addReference($i . 'e ' . $j, $classe);
                $manager->persist($classe);
            }
        }

        for ($k = 1; $k <= 3; $k++) {
            $classe = new Classes();
            $classe->setName('Tale ' . $k);
            $this->addReference('Tale ' . $k, $classe);
            $manager->persist($classe);
        }

        $manager->flush();
    }
}
