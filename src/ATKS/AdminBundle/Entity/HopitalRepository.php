<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * HopitalRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HopitalRepository extends EntityRepository
{
    public function nbreHopital() {
        return $this->createQueryBuilder("h")
                        ->select("COUNT(h)")
                        ->getQuery()
                        ->getSingleScalarResult();
    }    
}
