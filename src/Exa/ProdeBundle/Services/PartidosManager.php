<?php

namespace Exa\ProdeBundle\Services;

use Doctrine\ORM\EntityManager;
use Exa\ProdeBundle\Entity\Fecha;
use Exa\ProdeBundle\Entity\Partido;

/**
 * Description of PartidosManager
 *
 * @author pablo
 */
class PartidosManager {
    
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function createPartido(Fecha $fecha, $equipo1, $equipo2) {
        $partido = new Partido();
        $equipo1 = $this->em->getRepository('ExaProdeBundle:Equipo')->findyByNameAndLiga($equipo1, $fecha->getLiga());
        $equipo2 = $this->em->getRepository('ExaProdeBundle:Equipo')->findyByNameAndLiga($equipo2, $fecha->getLiga());
        $partido->setEquipo1($equipo1);
        $partido->setEquipo2($equipo2);
        $partido->setFecha($fecha);
        
        $this->em->persist($partido);
        
        $this->em->flush();
        
        return true;
    }
}

?>
