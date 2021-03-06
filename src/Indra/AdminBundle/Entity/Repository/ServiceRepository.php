<?php

namespace Indra\AdminBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ServiceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ServiceRepository extends EntityRepository
{
    /**
     * @return array Ces deux fonctions vont de paires findActiveService et findActiveServiceQueryBuilder
     * @return List of Active Service
     */
    function findActiveService(){
        $qb = $this->findActiveServiceQueryBuilder();
        return  $qb->getQuery()->getResult();
    }

    public function findActiveServiceQueryBuilder()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb->select('s')
            ->from('IndraAdminBundle:Service', 's')
            ->where('s.del = 0')
            ->orderBy('s.nom');

    }















}
