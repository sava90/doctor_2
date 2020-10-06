<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Document\Drug;

class DrugFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*for ($i = 1; $i <= 30000; $i++) {
            $drug = new Drug();
            $drug->setName('drug '.$i);
            $manager->persist($drug);
        }

        $manager->flush();*/
    }
}
