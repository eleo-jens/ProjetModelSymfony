<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Eleve;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EleveFixtures extends Fixture {
    public function load(ObjectManager $em){
        // on pourrait générer à la main comme une fonction insert 
        // $e1 = new blabla
        //$em->persist($e1)
        //$em->flush()

        //A la place on va utiliser la librairie FakerPHP
        $faker = Factory::create();

        for ($i = 0; $i < 1000; $i++){
            $e = new Eleve(
                ['nom' => $faker->lastName(), 
                'prenom' => $faker->firstName($gender = 'female'), 
                'dateNaissance' => new DateTime($faker->date())
            ]);
            $em->persist($e);
        }
        $em->flush();
        // dd($faker->name());
    }
}