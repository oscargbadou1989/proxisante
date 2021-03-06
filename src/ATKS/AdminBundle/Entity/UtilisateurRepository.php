<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UtilisateurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UtilisateurRepository extends EntityRepository
{
    public function nbreUtilisateurNonVu() {
        return $this->createQueryBuilder("v")
                        ->select("COUNT(v)")
                        ->where("v.vue = :false")
                        ->setParameter("false", false)
                        ->getQuery()
                        ->getSingleScalarResult();
    }
    
    public function nbreUtilisateur() {
        return $this->createQueryBuilder("u")
                        ->select("COUNT(u)")
                        ->getQuery()
                        ->getSingleScalarResult();
    }
}
