<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Country;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        // France
        $france = new Country;
        $france->setName('France');

        $paris = new City;
        $paris->setName('Paris');
        $paris->setCountry($france);

        $marseille = new City;
        $marseille->setName('Marseille');
        $marseille->setCountry($france);

        $lyon = new City;
        $lyon->setName('Lyon');
        $lyon->setCountry($france);

        $manager->persist($france);
        $manager->persist($paris);
        $manager->persist($marseille);
        $manager->persist($lyon);

        // Canada
        $canada = new Country;
        $canada->setName('Canada');

        $montreal = new City;
        $montreal->setName('Montreal');
        $montreal->setCountry($canada);

        $quebec = new City;
        $quebec->setName('Quebec');
        $quebec->setCountry($canada);

        $toronto = new City;
        $toronto->setName('Toronto');
        $toronto->setCountry($canada);

        $manager->persist($canada);
        $manager->persist($montreal);
        $manager->persist($quebec);
        $manager->persist($toronto);

        // Tana
        $tana = new Country;
        $tana->setName('Tana');

        $analakely = new City;
        $analakely->setName('Analakely');
        $analakely->setCountry($tana);

        $ambrondrona = new City;
        $ambrondrona->setName('Ambondrona');
        $ambrondrona->setCountry($tana);

        $zoma = new City;
        $zoma->setName('Zoma');
        $zoma->setCountry($tana);

        $manager->persist($tana);
        $manager->persist($analakely);
        $manager->persist($ambrondrona);
        $manager->persist($zoma);

        $manager->flush();
    }
}
