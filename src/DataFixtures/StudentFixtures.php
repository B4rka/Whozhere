<?php

namespace App\DataFixtures;

use App\Entity\Students;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class StudentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 300; $i++) {
            $student = new Students();
            $student->setFirstname($faker->firstName());
            $student->setLastname($faker->lastName());
            $student->setIn(false);
            $student->setClasse($this->getReference($faker->numberBetween(1, 6) . 'e ' . $faker->numberBetween(1, 3)));
            $student->setRegime($this->getReference('regime_' . $faker->numberBetween(1,5)));
            $manager->persist($student);
        }

        for ($i = 0; $i < 60; $i++) {
            $student = new Students();
            $student->setFirstname($faker->firstName());
            $student->setLastname($faker->lastName());
            $student->setIn(false);
            $student->setClasse($this->getReference('Tale ' . $faker->numberBetween(1, 3)));
            $student->setRegime($this->getReference('regime_' . $faker->numberBetween(1,5)));
            $manager->persist($student);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClasseFixtures::class,
            RegimeFixtures::class,
        ];
    }
}
