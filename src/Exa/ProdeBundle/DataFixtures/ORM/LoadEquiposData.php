<?php

namespace Exa\ProdeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exa\ProdeBundle\Entity\Equipo;


class LoadEquiposData extends AbstractFixture implements OrderedFixtureInterface {
    
    
    public function load(ObjectManager $manager) {
        $e1 = new Equipo();
        $e1->setName("Los Magios");
        $e1->setLiga($this->getReference("f9-a"));
        $manager->persist($e1);
        
        $e2 = new Equipo();
        $e2->setName("SSC Newpi");
        $e2->setLiga($this->getReference("f9-a"));
        $manager->persist($e2);
        
        $e3 = new Equipo();
        $e3->setName("Maccingami FC");
        $e3->setLiga($this->getReference("f9-a"));
        $manager->persist($e3);
        
        $e4 = new Equipo();
        $e4->setName("Hayqueamasarla");
        $e4->setLiga($this->getReference("f9-a"));
        $manager->persist($e4);
        
        $e1 = new Equipo();
        $e1->setName("La Cara de Ferretti");
        $e1->setLiga($this->getReference("f9-a"));
        $manager->persist($e1);
        
        $e1 = new Equipo();
        $e1->setName("La Novanta");
        $e1->setLiga($this->getReference("f9-a"));
        $manager->persist($e1);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}

?>
