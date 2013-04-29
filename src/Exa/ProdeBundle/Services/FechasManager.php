<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Exa\ProdeBundle\Services;

use Doctrine\ORM\EntityManager;
use Exa\ProdeBundle\Entity\Fecha;
use Exa\ProdeBundle\Entity\Liga;

/**
 * Description of LigasManager
 *
 * @author pablo
 */
class FechasManager {
    
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function createForParams($liga_code, $fecha_num, \DateTime $veda) {
        $liga = $this->em->getRepository('ExaProdeBundle:Liga')->findByCodigo($liga_code);
        if (!($liga instanceof Liga))
            return false; 
        $fecha = new Fecha();
        $fecha->setLiga($liga);
        $fecha->setName(sprintf('Fecha %s', $fecha_num));
        $fecha->setVeda($veda);
        // la mando a persistir
        $this->em->persist($fecha);
        // guardo los datos en la bd
        $this->em->flush();
        return $fecha;
    }
    
    
}

?>
