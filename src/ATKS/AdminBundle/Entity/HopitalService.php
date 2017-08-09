<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HopitalService
 *
 * @ORM\Table(name="ps_hopital_service")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Entity\HopitalServiceRepository")
 */
class HopitalService {

     /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="ATKS\AdminBundle\Entity\Hopital")
     */
    private $hopital;
    
    /**
     * @ORM\ManyToOne(targetEntity="ATKS\AdminBundle\Entity\ServiceSante")
     */
    private $service;

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
     * @ORM\Column(name="nomSpecialiste", type="string", length=255, nullable=true)
     */
    private $nomSpecialiste;

    /**
     * @var string
     *
     * @ORM\Column(name="telephoneSpecialiste", type="string", length=255, nullable=true)
     */
    private $telephoneSpecialiste;

    /**
     * @var string
     *
     * @ORM\Column(name="qualificationSpecialiste", type="string", length=255, nullable=true)
     */
    private $qualificationSpecialiste;

    /**
     * @var string
     *
     * @ORM\Column(name="fraisPrestation", type="string", length=255, nullable=true)
     */
    private $fraisPrestation;

    /**
     * @var string
     *
     * @ORM\Column(name="autreInfo", type="text", nullable=true)
     */
    private $autreInfo;

    /**
     * Set heureOuverture
     *
     * @param \DateTime $heureOuverture
     * @return HopitalService
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
     * @return HopitalService
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
     * Set nomSpecialiste
     *
     * @param string $nomSpecialiste
     * @return HopitalService
     */
    public function setNomSpecialiste($nomSpecialiste) {
        $this->nomSpecialiste = $nomSpecialiste;

        return $this;
    }

    /**
     * Get nomSpecialiste
     *
     * @return string 
     */
    public function getNomSpecialiste() {
        return $this->nomSpecialiste;
    }

    /**
     * Set telephoneSpecialiste
     *
     * @param string $telephoneSpecialiste
     * @return HopitalService
     */
    public function setTelephoneSpecialiste($telephoneSpecialiste) {
        $this->telephoneSpecialiste = $telephoneSpecialiste;

        return $this;
    }

    /**
     * Get telephoneSpecialiste
     *
     * @return string 
     */
    public function getTelephoneSpecialiste() {
        return $this->telephoneSpecialiste;
    }

    /**
     * Set qualificationSpecialiste
     *
     * @param string $qualificationSpecialiste
     * @return HopitalService
     */
    public function setQualificationSpecialiste($qualificationSpecialiste) {
        $this->qualificationSpecialiste = $qualificationSpecialiste;

        return $this;
    }

    /**
     * Get qualificationSpecialiste
     *
     * @return string 
     */
    public function getQualificationSpecialiste() {
        return $this->qualificationSpecialiste;
    }

    /**
     * Set fraisPrestation
     *
     * @param string $fraisPrestation
     * @return HopitalService
     */
    public function setFraisPrestation($fraisPrestation) {
        $this->fraisPrestation = $fraisPrestation;

        return $this;
    }

    /**
     * Get fraisPrestation
     *
     * @return string 
     */
    public function getFraisPrestation() {
        return $this->fraisPrestation;
    }

    /**
     * Set autreInfo
     *
     * @param string $autreInfo
     * @return HopitalService
     */
    public function setAutreInfo($autreInfo) {
        $this->autreInfo = $autreInfo;

        return $this;
    }

    /**
     * Get autreInfo
     *
     * @return string 
     */
    public function getAutreInfo() {
        return $this->autreInfo;
    }


    /**
     * Set hopital
     *
     * @param \ATKS\AdminBundle\Entity\Hopital $hopital
     * @return HopitalService
     */
    public function setHopital(\ATKS\AdminBundle\Entity\Hopital $hopital)
    {
        $this->hopital = $hopital;
    
        return $this;
    }

    /**
     * Get hopital
     *
     * @return \ATKS\AdminBundle\Entity\Hopital 
     */
    public function getHopital()
    {
        return $this->hopital;
    }

    /**
     * Set service
     *
     * @param \ATKS\AdminBundle\Entity\ServiceSante $service
     * @return HopitalService
     */
    public function setService(\ATKS\AdminBundle\Entity\ServiceSante $service)
    {
        $this->service = $service;
    
        return $this;
    }

    /**
     * Get service
     *
     * @return \ATKS\AdminBundle\Entity\ServiceSante 
     */
    public function getService()
    {
        return $this->service;
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
}