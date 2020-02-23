<?php

namespace RefugeeBundle\Repository;

/**
 * refugieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class refugieRepository extends \Doctrine\ORM\EntityRepository
{
    public function updateCapacityMinus($camp){
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            '
        update RefugeeBundle:camp c set c.capacity = (c.capacity-1) 
        where c.id = :camp'

        )->setParameter('camp', $camp)->getResult();
        return $query;


    }
}