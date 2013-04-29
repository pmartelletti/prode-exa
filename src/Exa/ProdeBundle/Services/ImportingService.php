<?php


namespace Exa\ProdeBundle\Services;

use Doctrine\ORM\EntityManager;
use Exa\ProdeBundle\Entity\Fecha;
use Exa\ProdeBundle\Entity\Partido;
use Exa\ProdeBundle\Services\FechasManager;
use Exa\ProdeBundle\Services\PartidosManager;

/**
 * Description of ImportingService
 *
 * @author pablo
 */
class ImportingService {
    
    protected $em;
    protected $fm;
    protected $pm;


    public function __construct(EntityManager $em, FechasManager $fm, PartidosManager $pm) {
        $this->em = $em;
        $this->fm = $fm;
        $this->pm = $pm;
    }
    
    public function createPartido($equipo1, $equipo2, $num_fecha, $liga) {
        // busco el partido, si existe no lo creo
        $fecha = $this->createOrRetrieveFecha($num_fecha, $liga);
        $repo = $this->em->getRepository('ExaProdeBundle:Partido');
        $partido = $repo->getPartidoByEquipos($fecha, $equipo1, $equipo2);
        if ( $partido instanceof Partido) return true;
        else {
            return $this->pm->createPartido($fecha, $equipo1, $equipo2);
        }
        
    }
    
    public function actualizarResultado($equipo1, $equipo2, $num_fecha, $liga, $goles1, $goles2) {
        $repo = $this->em->getRepository('ExaProdeBundle:Partido');
        $fecha = $this->createOrRetrieveFecha($num_fecha, $liga);
        $partido = $repo->getPartidoByEquipos($fecha, $equipo1, $equipo2);
        if (!($partido instanceof Partido )) return false;
        if ( $goles1 > $goles2) $partido->setResultado ("L");
        else if ($goles1 < $goles2 )$partido->setResultado ("V");
        else if ($goles1 == $goles2 ) $partido->setResultado ("E");
        $partido->setJugado(true);
        $this->em->flush();
        return true;
    }
    
    public function calcularGanadores($liga) {
        // para los partidos jugados sin calcular, calculo las tarjetas
        
        // mando los mails con las apuestas
    }


    /**
     * 
     * @param type $num_fecha
     * @param type $liga
     * @return \Exa\ProdeBundle\Entity\Fecha
     */
    private function createOrRetrieveFecha($num_fecha, $liga) {
        $repo = $this->em->getRepository('ExaProdeBundle:Fecha');
        $fecha = $repo->getForParams($num_fecha, $liga);
        if ($fecha instanceof Fecha) {
            // cambio la fecha de la veda
            $fecha->setVeda($this->getVedaForDate($liga));
            $this->em->flush();
            return $fecha;
        }
        else {
            return $this->fm->createForParams($liga, $num_fecha, $this->getVedaForDate($liga));
        }
    }
    
    private function getVedaForDate($liga_key, $date = null ) {
        if(empty($date)) $date = date("Y-m-d");
        // me fijo si es sabado o domingo
        if ( $liga_key[0] == "S") {
            // fecha de los sabados
            $veda = date("Y-m-d", strtotime('next saturday', strtotime($date)));
        } else if ($liga_key[0] == "D") {
            $veda = date("Y-m-d", strtotime('next sunday', strtotime($date)));
        } else $veda = null;
        return new \DateTime($veda);
    }
}

?>
