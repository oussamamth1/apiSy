<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Place;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
       

        $user = new User();
        $user->setFirstName('user1');
        $user->setLastName('lastname1');
        $user->setEmail('name1@gmail.com');
        $manager->persist($user);

        $user2 = new User();
        $user2->setFirstName('user2');
        $user2->setLastName('lastname2');
        $user2->setEmail('name2@gmail.com');
        $manager->persist($user2);
        
        $user3= new User();
        $user3->setFirstName('user3');
        $user3->setLastName('lastname3');
        $user3->setEmail('name3@gmail.com');
        $manager->persist($user3);

        $place = new Place();
        $place->setName('place1');
        $place->setAdresse('Adresse1');
        $place->setUser($user3);
        $manager->persist($place);

        $place = new Place();
        $place->setName('place2');
        $place->setAdresse('Adresse2');
        $place->setUser($user);
        $manager->persist($place);
        
        $place = new Place();
        $place->setName('place3');
        $place->setAdresse('Adresse3');
        $place->setUser($user);
        $manager->persist($place);
        
        $place = new Place();
        $place->setName('place4');
        $place->setAdresse('Adresse4');
        $place->setUser($user);
        $manager->persist($place);
        

        $manager->flush();
    }
}
