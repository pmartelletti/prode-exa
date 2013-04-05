<?php

namespace Exa\ProdeBundle\Services;

use Doctrine\ORM\EntityManager;
use Exa\ProdeBundle\Entity\Usuario;
use Exa\ProdeBundle\Entity\Fecha;
use Exa\ProdeBundle\Entity\TarjetaApuestas;
use Exa\ProdeBundle\Entity\Apuesta;

class TarjetaApuestasManager {
    
    protected $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }


    public function getPreparedTarjetaApuesta(Usuario $usuario, Fecha $fecha = null) {
        if (empty($fecha)) return null;
        $tarRep = $this->em->getRepository('ExaProdeBundle:TarjetaApuestas');
        $tarjeta = $tarRep
                ->getTarjetaForUserAndFecha($usuario, $fecha);
        if (empty($tarjeta) ) $tarjeta = $this->crearTarjeta($usuario, $fecha);
        if ( !$tarjeta->hasApuestas() ) {
            $this->crearApuestas($tarjeta);
        }
        
        $this->em->flush();
        return $tarjeta;
    }
    
    private function crearTarjeta(Usuario $usuario, Fecha $fecha) {
        $tarjeta = new TarjetaApuestas();
        $tarjeta->setUsuario($usuario);
        $tarjeta->setFecha($fecha);
        $this->em->persist($tarjeta);
        return $tarjeta;
    }
    
    private function crearApuestas(TarjetaApuestas $tarjeta) {
        foreach($tarjeta->getFecha()->getPartidos() as $partido) {
            $apuesta = new Apuesta();
            $apuesta->setPartido($partido);
            $apuesta->setTarjetaApuestas($tarjeta);
            $this->em->persist($apuesta);
        }
    }
    
}

?>
