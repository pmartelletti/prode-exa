<?php

namespace Exa\ProdeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FechaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FechaRepository extends EntityRepository
{
    
    public function getFechaForLiga(Liga $liga, $actual = true) {
        $query = $this->getEntityManager()
                /*->createQuery('
                    SELECT f FROM ExaProdeBundle:Fecha f
                    WHERE f.veda > :fecha AND f.liga =  :liga
                    ORDER BY f.veda')
                ->setParameters(array('fecha' => date('Y-m-d'), 'liga' => $liga ))
                ->setMaxResults(1)
                 * */
                ->createQueryBuilder()
                ->select('f')
                ->from('ExaProdeBundle:Fecha', 'f')
                ->andWhere('f.liga = :liga')
                ->setMaxResults(1)
                ->setParameters(array(
                    'fecha' => date('Y-m-d'),
                    'liga' => $liga
                ));
        if ($actual) 
            $query->andWhere('f.veda > :fecha')->orderBy('f.veda', 'ASC');
        else 
            $query->andWhere ('f.veda < :fecha')->orderBy('f.veda', 'DESC');
        return $query->getQuery()->getOneOrNullResult();
    }
    
}