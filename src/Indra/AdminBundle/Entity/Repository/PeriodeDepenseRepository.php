<?php

namespace Indra\AdminBundle\Entity\Repository;

/**
 * PeriodeDepenseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PeriodeDepenseRepository extends \Doctrine\ORM\EntityRepository
{
    public function findTypeDepenseAndContratQueryBuilder($idTypeDepense){

        $qb =  $this->createQueryBuilder('d')
            ->join('d.typeDepense', 't')
            ->addSelect('t')
            ->where('t.id =:idTypeDepense')
            ->setParameter('idTypeDepense', $idTypeDepense)
        ;
        return $qb->getQuery()->getResult();
    }
}
