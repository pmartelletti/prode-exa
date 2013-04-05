<?php

namespace Exa\ProdeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Exa\ProdeBundle\Entity\Liga;

class LoadLigasData extends AbstractFixture implements OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $l1 = new Liga();
        $l1->setName("F9 'A' Domingos - Apertura 2013");      
        $manager->persist($l1);
        
        $l2 = new Liga();
        $l2->setName("F9 'B' Domingos - Apertura 2013");      
        $manager->persist($l2);
        
        $l3 = new Liga();
        $l3->setName("F9 'C' Domingos - Apertura 2013");      
        $manager->persist($l3);
        
        $l4 = new Liga();
        $l4->setName("F6 Femenino Domingos - Apertura 2013");      
        $manager->persist($l4);
               
        $manager->flush();
        
        $this->addReference("f9-a", $l1);
    }
    
    public function getOrder() {
        return 1;
    }
    
}