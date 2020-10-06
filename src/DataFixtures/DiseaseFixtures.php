<?php

namespace App\DataFixtures;

use Doctrine\Bundle\MongoDBBundle\Fixture\Fixture;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\Persistence\ObjectManager;
use App\Document\{Disease, Drug};

class DiseaseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $drugTotal = 1;
        for ($i = 1; $i <= 10000; $i++) {

            $disease = new Disease();
            $disease->setName('disease '.$i);

            for ($j = 1; $j <= 3; $j++) {
                $drug = new Drug();
                $drug->setName('drug '.$drugTotal++);
                $disease->addDrug($drug);
                $manager->persist($drug);
            }

            $manager->persist($disease);
        }
        $manager->flush();
    }
}
