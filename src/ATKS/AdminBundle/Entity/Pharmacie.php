<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pharmacie
 *
 * @ORM\Table(name="ps_pharmacie")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Entity\PharmacieRepository")
 */
class Pharmacie
{
    /**
     * @ORM\OneToOne(targetEntity="ATKS\AdminBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;
    
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=255, nullable=true)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="altitude", type="float")
     */
    private $altitude;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureOuverture", type="time")
     */
    private $heureOuverture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFermeture", type="time")
     */
    private $heureFermeture;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPharmacien", type="string", length=255, nullable=true)
     */
    private $nomPharmacien;

    /**
     * @var string
     *
     * @ORM\Column(name="qualificationPharmacien", type="string", length=255, nullable=true)
     */
    private $qualificationPharmacien;

    /**
     * @var string
     *
     * @ORM\Column(name="autreInfo", type="text", nullable=true)
     */
    private $autreInfo;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer", nullable=true)
     */
    private $note;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nbreVotant", type="integer", nullable=true)
     */
    private $nbreVotant;


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
     * Set nom
     *
     * @param string $nom
     * @return Pharmacie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Pharmacie
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Pharmacie
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Pharmacie
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     * @return Pharmacie
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;
    
        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string 
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Pharmacie
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Pharmacie
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
     * @return Pharmacie
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
     * Set altitude
     *
     * @param float $altitude
     * @return Pharmacie
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;
    
        return $this;
    }

    /**
     * Get altitude
     *
     * @return float 
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * Set heureOuverture
     *
     * @param \DateTime $heureOuverture
     * @return Pharmacie
     */
    public function setHeureOuverture($heureOuverture)
    {
        $this->heureOuverture = $heureOuverture;
    
        return $this;
    }

    /**
     * Get heureOuverture
     *
     * @return \DateTime 
     */
    public function getHeureOuverture()
    {
        return $this->heureOuverture;
    }

    /**
     * Set heureFermeture
     *
     * @param \DateTime $heureFermeture
     * @return Pharmacie
     */
    public function setHeureFermeture($heureFermeture)
    {
        $this->heureFermeture = $heureFermeture;
    
        return $this;
    }

    /**
     * Get heureFermeture
     *
     * @return \DateTime 
     */
    public function getHeureFermeture()
    {
        return $this->heureFermeture;
    }

    /**
     * Set nomPharmacien
     *
     * @param string $nomPharmacien
     * @return Pharmacie
     */
    public function setNomPharmacien($nomPharmacien)
    {
        $this->nomPharmacien = $nomPharmacien;
    
        return $this;
    }

    /**
     * Get nomPharmacien
     *
     * @return string 
     */
    public function getNomPharmacien()
    {
        return $this->nomPharmacien;
    }

    /**
     * Set qualificationPharmacien
     *
     * @param string $qualificationPharmacien
     * @return Pharmacie
     */
    public function setQualificationPharmacien($qualificationPharmacien)
    {
        $this->qualificationPharmacien = $qualificationPharmacien;
    
        return $this;
    }

    /**
     * Get qualificationPharmacien
     *
     * @return string 
     */
    public function getQualificationPharmacien()
    {
        return $this->qualificationPharmacien;
    }

    /**
     * Set autreInfo
     *
     * @param string $autreInfo
     * @return Pharmacie
     */
    public function setAutreInfo($autreInfo)
    {
        $this->autreInfo = $autreInfo;
    
        return $this;
    }

    /**
     * Get autreInfo
     *
     * @return string 
     */
    public function getAutreInfo()
    {
        return $this->autreInfo;
    }

    /**
     * Set image
     *
     * @param \ATKS\AdminBundle\Entity\Image $image
     * @return Pharmacie
     */
    public function setImage(\ATKS\AdminBundle\Entity\Image $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return \ATKS\AdminBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set note
     *
     * @param integer $note
     * @return Pharmacie
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set nbreVotant
     *
     * @param integer $nbreVotant
     * @return Pharmacie
     */
    public function setNbreVotant($nbreVotant)
    {
        $this->nbreVotant = $nbreVotant;
    
        return $this;
    }

    /**
     * Get nbreVotant
     *
     * @return integer 
     */
    public function getNbreVotant()
    {
        return $this->nbreVotant;
    }
}