<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Episode extends Fixture
{
    public function load(ObjectManager $manager): void
    
    {
        $season = new Season();

        //$season->setNumber(1);
        
        $this->addReference('season1_Arcane', $season);
        $manager->flush();
    }
}
