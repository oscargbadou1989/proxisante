<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PharmacieSpecialiteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PharmacieSpecialiteRepository extends EntityRepository
{
    public function pharmacieSpecialiteRechercher($query) {
        return $this->createQueryBuilder("ps")
                        ->leftJoin("ps.specialite", "s")
                        ->where("s.nom LIKE :query OR s.tags LIKE :query")
                        ->setParameter("query", '%' . $query . '%')
                        ->getQuery()
                        ->getResult();
    }
    
    public function nbreSpecialitePharmacie($id) {
        return $this->createQueryBuilder("ps")
                        ->select("COUNT(ps)")
                        ->leftJoin("ps.pharmacie", "p")
                        ->where("p.id = :id")
                        ->setParameter("id", $id)
                        ->getQuery()
                        ->getSingleScalarResult();
    }
}
