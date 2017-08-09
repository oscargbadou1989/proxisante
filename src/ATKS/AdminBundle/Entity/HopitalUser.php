<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HopitalUser
 *
 * @ORM\Table(name="ps_hopital_user")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Entity\HopitalUserRepository")
 */
class HopitalUser {

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
     * @ORM\Column(name="nomUser", type="string", length=255, nullable=true)
     */
    private $nomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomUser", type="string", length=255, nullable=true)
     */
    private $prenomUser;

    /**
     * @var string
     *
     * @ORM\Column(name="emailUser", type="string", length=255, nullable=true)
     */
    private $emailUser;

    /**
     * @var string
     *
     * @ORM\Column(name="telephoneUser", type="string", length=255, nullable=true)
     */
    private $telephoneUser;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

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
     * @var string
     *
     * @ORM\Column(name="serviceSantesId", type="string", length=255, nullable=true)
     */
    private $serviceSantesId;

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
     * @ORM\Column(name="altitude", type="float", nullable=true)
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
     * @var boolean
     *
     * @ORM\Column(name="vue", type="boolean")
     */
    private $vue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSoumission", type="datetime")
     */
    private $dateSoumission;

    public function __construct() {
        $this->vue = false;
        $this->dateSoumission = new \DateTime();
        $this->altitude = null;
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
     * Set email
     *
     * @param string $email
     * @return HopitalUser
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
     * Set nomUser
     *
     * @param string $nomUser
     * @return HopitalUser
     */
    public function setNomUser($nomUser) {
        $this->nomUser = $nomUser;

        return $this;
    }

    /**
     * Get nomUser
     *
     * @return string 
     */
    public function getNomUser() {
        return $this->nomUser;
    }

    /**
     * Set prenomUser
     *
     * @param string $prenomUser
     * @return HopitalUser
     */
    public function setPrenomUser($prenomUser) {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    /**
     * Get prenomUser
     *
     * @return string 
     */
    public function getPrenomUser() {
        return $this->prenomUser;
    }

    /**
     * Set emailUser
     *
     * @param string $emailUser
     * @return HopitalUser
     */
    public function setEmailUser($emailUser) {
        $this->emailUser = $emailUser;

        return $this;
    }

    /**
     * Get emailUser
     *
     * @return string 
     */
    public function getEmailUser() {
        return $this->emailUser;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return HopitalUser
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return HopitalUser
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return HopitalUser
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
     * Set fax
     *
     * @param string $fax
     * @return HopitalUser
     */
    public function setFax($fax) {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax() {
        return $this->fax;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     * @return HopitalUser
     */
    public function setSiteWeb($siteWeb) {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string 
     */
    public function getSiteWeb() {
        return $this->siteWeb;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return HopitalUser
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
     * Set longitude
     *
     * @param float $longitude
     * @return HopitalUser
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return HopitalUser
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set altitude
     *
     * @param float $altitude
     * @return HopitalUser
     */
    public function setAltitude($altitude) {
        $this->altitude = $altitude;

        return $this;
    }

    /**
     * Get altitude
     *
     * @return float 
     */
    public function getAltitude() {
        return $this->altitude;
    }

    /**
     * Set heureOuverture
     *
     * @param \DateTime $heureOuverture
     * @return HopitalUser
     */
    public function setHeureOuverture($heureOuverture) {
        $this->heureOuverture = $heureOuverture;

        return $this;
    }

    /**
     * Get heureOuverture
     *
     * @return \DateTime 
     */
    public function getHeureOuverture() {
        return $this->heureOuverture;
    }

    /**
     * Set heureFermeture
     *
     * @param \DateTime $heureFermeture
     * @return HopitalUser
     */
    public function setHeureFermeture($heureFermeture) {
        $this->heureFermeture = $heureFermeture;

        return $this;
    }

    /**
     * Get heureFermeture
     *
     * @return \DateTime 
     */
    public function getHeureFermeture() {
        return $this->heureFermeture;
    }

    /**
     * Set image
     *
     * @param \ATKS\AdminBundle\Entity\Image $image
     * @return HopitalUser
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
     * Set telephoneUser
     *
     * @param string $telephoneUser
     * @return HopitalUser
     */
    public function setTelephoneUser($telephoneUser) {
        $this->telephoneUser = $telephoneUser;

        return $this;
    }

    /**
     * Get telephoneUser
     *
     * @return string 
     */
    public function getTelephoneUser() {
        return $this->telephoneUser;
    }

    /**
     * Set serviceSantesId
     *
     * @param string $serviceSantesId
     * @return HopitalUser
     */
    public function setServiceSantesId($serviceSantesId) {
        $this->serviceSantesId = $serviceSantesId;

        return $this;
    }

    /**
     * Get serviceSantesId
     *
     * @return string 
     */
    public function getServiceSantesId() {
        return $this->serviceSantesId;
    }

    /**
     * Set vue
     *
     * @param boolean $vue
     * @return HopitalUser
     */
    public function setVue($vue) {
        $this->vue = $vue;

        return $this;
    }

    /**
     * Get vue
     *
     * @return boolean 
     */
    public function getVue() {
        return $this->vue;
    }

    /**
     * Set dateSoumission
     *
     * @param \DateTime $dateSoumission
     * @return HopitalUser
     */
    public function setDateSoumission($dateSoumission) {
        $this->dateSoumission = $dateSoumission;

        return $this;
    }

    /**
     * Get dateSoumission
     *
     * @return \DateTime 
     */
    public function getDateSoumission() {
        return $this->dateSoumission;
    }

}