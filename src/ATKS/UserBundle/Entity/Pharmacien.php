<?php

namespace ATKS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * Pharmacien
 *
 * @ORM\Table(name="ps_pharmacien")
 * @ORM\Entity(repositoryClass="ATKS\UserBundle\Entity\PharmacienRepository")
 * @UniqueEntity(fields = "username", targetClass = "ATKS\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "ATKS\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Pharmacien extends User
{
    /**
     * @ORM\ManyToOne(targetEntity="ATKS\AdminBundle\Entity\Pharmacie")
     */
    private $pharmacie;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @return Pharmacien
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