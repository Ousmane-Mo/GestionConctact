<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Contacts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $categories = [];
        $category = new Category();
        $category->setLabel('Professionnel')
                 ->setImage('https://picsum.photos/id/5/200/300')
                 ->setDescription($faker->sentence(50));
        $manager->persist($category);
        $categories[]= $category;

        $category = new Category();
        $category->setLabel('Sport')
                 ->setImage('https://picsum.photos/id/73/200/300')
                 ->setDescription($faker->sentence(50));
        $manager->persist($category);
        $categories[]= $category;

        $category = new Category();
        $category->setLabel('Prive')
                 ->setImage('https://picsum.photos/id/342/200/300')
                 ->setDescription($faker->sentence(50));
        $manager->persist($category);
        $categories[]= $category;
        
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
                     ->setSex($sexe)
                     ->setCategorie($categories[mt_rand(0,2)]);
            $manager->persist($contacts);
        }
        
        $manager->flush();
    }
}
