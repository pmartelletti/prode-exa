<?php

namespace Exa\ProdeBundle\Services;

use Doctrine\ORM\EntityManager;
use Exa\ProdeBundle\Entity\Partido;
use Exa\ProdeBundle\Entity\Apuesta;

class ApuestaManager {
    
    protected $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }
    
    public function calcularPorcentajePrediccion(Apuesta $apuesta, $prediccion = "") {
        if(empty($prediccion)) return 0;
        else 
            return $this->em->getRepository('ExaProdeBundle:Apuesta')->cacularPorcentajePrediccion($apuesta->getPartido (), $prediccion);
    }

}

?>
