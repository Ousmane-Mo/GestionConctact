<?php

namespace App\DataFixtures;

use App\Entity\Contacts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $genres = ["male", "female"];
        for ($i=0; $i < 100 ; $i++) { 
            $sexe = mt_rand(0,1);
            $sexe == 0 ? $type = 'men' : $type = 'women';
            $contacts = new Contacts();
            $contacts->setName($faker->lastName())
                     ->setFirstName($faker->firstName($genres[$sexe]))
                     ->setStreet($faker->streetAddress())
                     ->setZc($faker->postcode())
                     ->setCity($faker->city())
                     ->setMail($faker->email("{$faker->lastName()}.{$faker->firstName($genres[$sexe])}@{$faker->freeEmailDomain()}"))
                     ->setAvatar("https://randomuser.me/api/portraits/". $type ."/". $i .".jpg")
                     ->setSex($sexe);
            $manager->persist($contacts);
        }
        
        $manager->flush();
    }
}
