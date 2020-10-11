<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new Users();
            $user->setName('Nom' . $i);
            $user->setSurname('Prenom' . $i);
            $user->setIsAdmin(true);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
