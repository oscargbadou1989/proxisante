<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publicite
 *
 * @ORM\Table(name="ps_publicite")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Entity\PubliciteRepository")
 */
class Publicite {
    
    /**
     * @ORM\ManyToMany(targetEntity="ATKS\AdminBundle\Entity\Image", cascade={"remove", "persist"})
     */
    private $images;

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
     * @ORM\Column(name="nomStructure", type="string", length=255)
     */
    private $nomStructure;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=255)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="messageFlash", type="string", length=255)
     */
    private $messageFlash;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime")
     */
    private $dateFin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;

    public function __construct() {
        $this->actif = true;
        $this->dateDebut = new \DateTime();
        $this->dateFin = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nomStructure
     *
     * @param string $nomStructure
     * @return Publicite
     */
    public function setNomStructure($nomStructure) {
        $this->nomStructure = $nomStructure;

        return $this;
    }

    /**
     * Get nomStructure
     *
     * @return string 
     */
    public function getNomStructure() {
        return $this->nomStructure;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Publicite
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Publicite
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Publicite
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Publicite
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Set messageFlash
     *
     * @param string $messageFlash
     * @return Publicite
     */
    public function setMessageFlash($messageFlash) {
        $this->messageFlash = $messageFlash;

        return $this;
    }

    /**
     * Get messageFlash
     *
     * @return string 
     */
    public function getMessageFlash() {
        return $this->messageFlash;
    }

    /**
     * Set image
     *
     * @param \ATKS\AdminBundle\Entity\Image $image
     * @return Publicite
     */
    public function setImage(\ATKS\AdminBundle\Entity\Image $image = null) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \ATKS\AdminBundle\Entity\Image 
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Publicite
     */
    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut() {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Publicite
     */
    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin() {
        return $this->dateFin;
    }


    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     * @return Publicite
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
     * Set actif
     *
     * @param boolean $actif
     * @return Publicite
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    
        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Add images
     *
     * @param \ATKS\AdminBundle\Entity\Image $images
     * @return Publicite
     */
    public function addImage(\ATKS\AdminBundle\Entity\Image $images)
    {
        $this->images[] = $images;
    
        return $this;
    }

    /**
     * Remove images
     *
     * @param \ATKS\AdminBundle\Entity\Image $images
     */
    public function removeImage(\ATKS\AdminBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}