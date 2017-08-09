<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FbMessage
 *
 * @ORM\Table(name="fb_message")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Repository\FbMessageRepository")
 */
class FbMessage
{
  /**
   * @ORM\ManyToOne(targetEntity="ATKS\AdminBundle\Entity\FbUser")
   */
  private $fbUser;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    public function __construct(){
      $this->date = new \DateTime();
    }

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return FbMessage
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return FbMessage
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set fbUser
     *
     * @param \ATKS\AdminBundle\Entity\FbUser $fbUser
     *
     * @return FbMessage
     */
    public function setFbUser(\ATKS\AdminBundle\Entity\FbUser $fbUser = null)
    {
        $this->fbUser = $fbUser;

        return $this;
    }

    /**
     * Get fbUser
     *
     * @return \ATKS\AdminBundle\Entity\FbUser
     */
    public function getFbUser()
    {
        return $this->fbUser;
    }
}
