<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProblemeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProblemeRepository extends EntityRepository {

    public function nbreProbleme() {
        return $this->createQueryBuilder("p")
                        ->select("COUNT(p)")
                        ->getQuery()
                        ->getSingleScalarResult();
    }

    public function nbreProblemeNonVu() {
        return $this->createQueryBuilder("p")
                        ->select("COUNT(p)")
                        ->where("p.vue = :false")
                        ->setParameter("false", false)
                        ->getQuery()
                        ->getSingleScalarResult();
    }

}
