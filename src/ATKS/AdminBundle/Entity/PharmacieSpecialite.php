<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PharmacieSpecialite
 *
 * @ORM\Table(name="ps_pharmacie_specialite")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Entity\PharmacieSpecialiteRepository")
 */
class PharmacieSpecialite
{
    /**
     * @ORM\ManyToOne(targetEntity="ATKS\AdminBundle\Entity\Pharmacie")
     */
    private $pharmacie;
    
    /**
     * @ORM\ManyToOne(targetEntity="ATKS\AdminBundle\Entity\SpecialitePharmacie")
     */
    private $specialite;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Set specialite
     *
     * @param \ATKS\AdminBundle\Entity\SpecialitePharmacie $specialite
     * @return PharmacieSpecialite
     */
    public function setSpecialite(\ATKS\AdminBundle\Entity\SpecialitePharmacie $specialite)
    {
        $this->specialite = $specialite;
    
        return $this;
    }

    /**
     * Get specialite
     *
     * @return \ATKS\AdminBundle\Entity\SpecialitePharmacie 
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pharmacie
     *
     * @param \ATKS\AdminBundle\Entity\Pharmacie $pharmacie
     * @return PharmacieSpecialite
     */
    public function setPharmacie(\ATKS\AdminBundle\Entity\Pharmacie $pharmacie = null)
    {
        $this->pharmacie = $pharmacie;
    
        return $this;
    }

    /**
     * Get pharmacie
     *
     * @return \ATKS\AdminBundle\Entity\Pharmacie 
     */
    public function getPharmacie()
    {
        return $this->pharmacie;
    }
}