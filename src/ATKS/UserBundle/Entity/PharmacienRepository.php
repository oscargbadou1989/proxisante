<?php

namespace ATKS\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PharmacienRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PharmacienRepository extends EntityRepository
{
     public function nbrePharmacien() {
        return $this->createQueryBuilder("p")
                        ->select("COUNT(p)")
                        ->getQuery()
                        ->getSingleScalarResult();
    }
}
