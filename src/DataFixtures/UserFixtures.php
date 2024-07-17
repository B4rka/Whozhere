<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // Création d’un utilisateur de type “contributeur” (= auteur)
        $user = new User();
        $user->setUsername('supervisor');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'whozinpwd'
        );

        $user->setPassword($hashedPassword);
        $manager->persist($user);


        $manager->flush();
    }
}
