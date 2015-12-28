<?php

namespace JanetTransit\AdminBundle\Entity\Repository;

/**
 * StockRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StockRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAdministratifQueryBuilder(){

        $qb =  $this->createQueryBuilder('s')
            ->leftJoin('s.typeStock', 't')
            ->addSelect('t')
            ->where('t.nom LIKE :administratif AND s.del = 0')
            ->setParameter('administratif', '%administratif%')
        ;
        return $qb;
    }
}
