<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visiteur
 *
 * @ORM\Table(name="ps_visiteur")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Entity\VisiteurRepository")
 */
class Visiteur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseIp", type="string", length=255)
     */
    private $adresseIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDerniereConnexion", type="datetime")
     */
    private $dateDerniereConnexion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePremiereConnexion", type="datetime")
     */
    private $datePremiereConnexion;

    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="integer")
     */
    private $timestamp;
    
    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", nullable=true)
     */
    private $longitude;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", nullable=true)
     */
    private $latitude;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vue", type="boolean")
     */
    private $vue;
    
    public function __construct() {
        $this->vue = false;
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
     * Set adresseIp
     *
     * @param string $adresseIp
     * @return Visiteur
     */
    public function setAdresseIp($adresseIp)
    {
        $this->adresseIp = $adresseIp;
    
        return $this;
    }

    /**
     * Get adresseIp
     *
     * @return string 
     */
    public function getAdresseIp()
    {
        return $this->adresseIp;
    }

    /**
     * Set dateDerniereConnexion
     *
     * @param \DateTime $dateDerniereConnexion
     * @return Visiteur
     */
    public function setDateDerniereConnexion($dateDerniereConnexion)
    {
        $this->dateDerniereConnexion = $dateDerniereConnexion;
    
        return $this;
    }

    /**
     * Get dateDerniereConnexion
     *
     * @return \DateTime 
     */
    public function getDateDerniereConnexion()
    {
        return $this->dateDerniereConnexion;
    }

    /**
     * Set timestamp
     *
     * @param integer $timestamp
     * @return Visiteur
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    
        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Visiteur
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Visiteur
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set vue
     *
     * @param boolean $vue
     * @return Visiteur
     */
    public function setVue($vue)
    {
        $this->vue = $vue;
    
        return $this;
    }

    /**
     * Get vue
     *
     * @return boolean 
     */
    public function getVue()
    {
        return $this->vue;
    }

    /**
     * Set datePremiereConnexion
     *
     * @param \DateTime $datePremiereConnexion
     * @return Visiteur
     */
    public function setDatePremiereConnexion($datePremiereConnexion)
    {
        $this->datePremiereConnexion = $datePremiereConnexion;
    
        return $this;
    }

    /**
     * Get datePremiereConnexion
     *
     * @return \DateTime 
     */
    public function getDatePremiereConnexion()
    {
        return $this->datePremiereConnexion;
    }
}