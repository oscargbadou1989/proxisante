<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plainte
 *
 * @ORM\Table(name="plainte", indexes={@ORM\Index(columns={"plainte", "description"}, flags={"fulltext"})})
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Repository\PlainteRepository")
 */
class Plainte
{
  /**
   * @ORM\ManyToOne(targetEntity="ATKS\AdminBundle\Entity\ServiceSante")
   */
  private $service;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="plainte", type="text")
     */
    private $plainte;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set plainte
     *
     * @param string $plainte
     *
     * @return Plainte
     */
    public function setPlainte($plainte)
    {
        $this->plainte = $plainte;

        return $this;
    }

    /**
     * Get plainte
     *
     * @return string
     */
    public function getPlainte()
    {
        return $this->plainte;
    }

    /**
     * Set service
     *
     * @param \ATKS\AdminBundle\Entity\ServiceSante $service
     *
     * @return Plainte
     */
    public function setService(\ATKS\AdminBundle\Entity\ServiceSante $service = null)
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
     * Set description
     *
     * @param string $description
     *
     * @return Plainte
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
