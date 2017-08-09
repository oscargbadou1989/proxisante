<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Probleme
 *
 * @ORM\Table(name="ps_probleme")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Entity\ProblemeRepository")
 */
class Probleme {

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
     * @ORM\Column(name="numeroUser", type="string", length=255)
     */
    private $numeroUser;

    /**
     * @var string
     *
     * @ORM\Column(name="idPhoneUser", type="string", length=255)
     */
    private $idPhoneUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSoumission", type="datetime")
     */
    private $dateSoumission;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vue", type="boolean")
     */
    private $vue;

    public function __construct() {
        $this->vue = false;
        $this->dateSoumission = new \DateTime();
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
     * Set numeroUser
     *
     * @param string $numeroUser
     * @return Probleme
     */
    public function setNumeroUser($numeroUser) {
        $this->numeroUser = $numeroUser;

        return $this;
    }

    /**
     * Get numeroUser
     *
     * @return string 
     */
    public function getNumeroUser() {
        return $this->numeroUser;
    }

    /**
     * Set idPhoneUser
     *
     * @param string $idPhoneUser
     * @return Probleme
     */
    public function setIdPhoneUser($idPhoneUser) {
        $this->idPhoneUser = $idPhoneUser;

        return $this;
    }

    /**
     * Get idPhoneUser
     *
     * @return string 
     */
    public function getIdPhoneUser() {
        return $this->idPhoneUser;
    }

    /**
     * Set dateSoumission
     *
     * @param \DateTime $dateSoumission
     * @return Probleme
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

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Probleme
     */
    public function setContenu($contenu) {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu() {
        return $this->contenu;
    }

    /**
     * Set vue
     *
     * @param boolean $vue
     * @return Probleme
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

}