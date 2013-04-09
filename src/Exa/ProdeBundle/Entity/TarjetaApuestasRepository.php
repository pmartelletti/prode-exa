<?php

namespace Exa\ProdeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TarjetaApuestasRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TarjetaApuestasRepository extends EntityRepository
{
    public function getTarjetaActualForUser(Usuario $user) {
         $query = $this->getEntityManager()
                ->createQuery('
                    SELECT t FROM ExaProdeBundle:TarjetaApuestas t
                    WHERE t.fecha.veda < :fecha AND t.calculado = :calculado
                    ORDER BY t.fecha.veda ')
                ->setParameters(array('fecha' => date('Y-m-d'), ':calculado' => 0));
        return $query->getOneOrNullResult();
    }
    
    public function getTarjetaForUserAndFecha(Usuario $usuario, Fecha $fecha = null) {
        $query = $this->getEntityManager()
                ->createQuery('
                    SELECT t from ExaProdeBundle:TarjetaApuestas t
                    WHERE t.fecha = :fecha AND t.usuario = :usuario')
                ->setParameters(array('usuario' => $usuario, 'fecha' => $fecha));
        return $query->getOneOrNullResult();
    }
    
    public function getPosicionesFecha(Fecha $fecha = null, Liga $liga = null) {
        if( empty($fecha) and empty($liga) ) return null;
        $query = $this->getEntityManager()->createQueryBuilder();
        $parameters = array(
            'calculado' => true
        );
        
        $query->from('ExaProdeBundle:TarjetaApuestas', 't')
                ->andWhere('t.calculado = :calculado')
                ->addOrderBy('t.aciertos', 'DESC')
                ->join('t.usuario', 'u')
                ->addOrderBy('u.name', 'ASC');
        if( !empty($fecha) ) {
            $parameters['fecha'] = $fecha;
            $query = $query->select('t')
                ->andWhere('t.fecha = :fecha')
                ->setParameters($parameters)
                ->getQuery();
        }
        if( !empty($liga) ) {
            $parameters['liga'] = $liga;
            $query = $this->getEntityManager()->createQuery('
                    SELECT t, SUM(t.aciertos) AS total FROM ExaProdeBundle:TarjetaApuestas t
                    JOIN t.fecha f WHERE t.calculado = :calculado AND f.liga = :liga
                    JOIN t.usuario u
                    GROUP BY t.usuario
                    ORDER BY total DESC, u.name ASC
                ')->setParameters($parameters);
        }
        
        return $query->getResult();
    }
    
    public function getPastTarjetasUsuario(Usuario $user) {
        $query = $this->getEntityManager()->createQuery('
            SELECT t FROM ExaProdeBundle:TarjetaApuestas t
            JOIN t.fecha f
            WHERE t.calculado = :calculado AND f.veda < :fecha AND t.usuario = :usuario
            ORDER BY f.veda')
                ->setParameters(array(
                    'calculado' => true,
                    'fecha' => date('Y-m-d'),
                    'usuario' => $user
                )); 
        return $query->getResult();
    }
    
}
