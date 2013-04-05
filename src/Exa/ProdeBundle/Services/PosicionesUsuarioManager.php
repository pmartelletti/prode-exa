<?php

namespace Exa\ProdeBundle\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Exa\ProdeBundle\Entity\Usuario;
use Exa\ProdeBundle\Entity\Fecha;
use Exa\ProdeBundle\Services\TarjetaApuestasManager;
use Exa\ProdeBundle\Entity\Liga;

class PosicionesUsuarioManager {
    
    protected $em;
    protected $ta_service;


    public function __construct(EntityManager $em, TarjetaApuestasManager $ta_service)
    {
        $this->em = $em;
        $this->ta_service = $ta_service;
        return $this;
    }
    
    /**
     * 
     * @param \Exa\ProdeBundle\Entity\Usuario $usuario
     * @param \Exa\ProdeBundle\Entity\Fecha $fecha = null, if fecha is null calcula para el torneo actual
     * @return type
     */
    public function getPosicionUsuario(Usuario $usuario, Fecha $fecha =  null, Liga $liga = null) {
        if (empty($fecha) and empty($liga)  ) return null;
        $posiciones = $this->em->getRepository('ExaProdeBundle:TarjetaApuestas')
                ->getPosicionesFecha($fecha, $liga);
        $pos = $this->getPositionForUser($usuario, $posiciones, empty($fecha));
        return empty($pos) ? "No calculada todavía" : $pos;
    }
    
    private function getPositionForUser(Usuario $usuario, $posiciones, $total = false) {
        foreach ($posiciones as $k => $posicion) {
            if( $total ) {
                if( $posicion[0]->getUsuario() == $usuario ) return array('posicion' => $k + 1, 'aciertos' => $posicion['total']);
            } else {
                if ( $posicion->getUsuario() == $usuario ) return array('posicion' => $k +1, 'aciertos' => $posicion->getAciertos());
            }
        }
        return null;
    }
    
    public function getPosicionesParaTodasLigas($type) {
        $positions = new ArrayCollection();
        $ligas = $this->em->getRepository('ExaProdeBundle:Liga')->findAll(); // TODO: filtrar x ligas activas
        foreach($ligas as $liga) {
            if ( $type == "fecha" ) {
                $fecha = $this->em->getRepository('ExaProdeBundle:Fecha')->getFechaForLiga($liga, false);
                $positions->add($this->em->getRepository ('ExaProdeBundle:TarjetaApuestas')
                        ->getPosicionesFecha($fecha, null));
            }
            else 
                $positions->add($this->em->getRepository('ExaProdeBundle:TarjetaApuestas')->getPosicionesFecha(null, $liga));
        }
        return $positions;
    }
    
}

?>
