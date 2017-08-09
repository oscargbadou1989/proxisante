<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="ps_utilisateur")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Entity\UtilisateurRepository")
 */
class Utilisateur
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
     * @ORM\Column(name="idPhoneUser", type="string", length=255)
     */
    private $idPhoneUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePremiereConnexion", type="datetime")
     */
    private $datePremiereConnexion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDerniereConnexion", type="datetime")
     */
    private $dateDerniereConnexion;

    /**
     * @var string
     *
     * @ORM\Column(name="plateforme", type="string", length=255)
     */
    private $plateforme;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="historiqueConnexion", type="text")
     */
    private $historiqueConnexion;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbreConnexion", type="integer")
     */
    private $nbreConnexion;
    
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
     * Set datePremiereConnexion
     *
     * @param \DateTime $datePremiereConnexion
     * @return Utilisateur
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

    /**
     * Set dateDerniereConnexion
     *
     * @param \DateTime $dateDerniereConnexion
     * @return Utilisateur
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
     * Set plateforme
     *
     * @param string $plateforme
     * @return Utilisateur
     */
    public function setPlateforme($plateforme)
    {
        $this->plateforme = $plateforme;
    
        return $this;
    }

    /**
     * Get plateforme
     *
     * @return string 
     */
    public function getPlateforme()
    {
        return $this->plateforme;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Utilisateur
     */
    public function setVersion($version)
    {
        $this->version = $version;
    
        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set historiqueConnexion
     *
     * @param string $historiqueConnexion
     * @return Utilisateur
     */
    public function setHistoriqueConnexion($historiqueConnexion)
    {
        $this->historiqueConnexion = $historiqueConnexion;
    
        return $this;
    }

    /**
     * Get historiqueConnexion
     *
     * @return string 
     */
    public function getHistoriqueConnexion()
    {
        return $this->historiqueConnexion;
    }

    /**
     * Set idPhoneUser
     *
     * @param string $idPhoneUser
     * @return Utilisateur
     */
    public function setIdPhoneUser($idPhoneUser)
    {
        $this->idPhoneUser = $idPhoneUser;
    
        return $this;
    }

    /**
     * Get idPhoneUser
     *
     * @return string 
     */
    public function getIdPhoneUser()
    {
        return $this->idPhoneUser;
    }

    /**
     * Set nbreConnexion
     *
     * @param integer $nbreConnexion
     * @return Utilisateur
     */
    public function setNbreConnexion($nbreConnexion)
    {
        $this->nbreConnexion = $nbreConnexion;
    
        return $this;
    }

    /**
     * Get nbreConnexion
     *
     * @return integer 
     */
    public function getNbreConnexion()
    {
        return $this->nbreConnexion;
    }

    /**
     * Set vue
     *
     * @param boolean $vue
     * @return Utilisateur
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
}