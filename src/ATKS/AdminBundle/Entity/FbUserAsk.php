<?php

namespace ATKS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FbUserAsk
 *
 * @ORM\Table(name="fb_user_ask")
 * @ORM\Entity(repositoryClass="ATKS\AdminBundle\Repository\FbUserAskRepository")
 */
class FbUserAsk
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

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
     * @return FbUserAsk
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
     * Set type
     *
     * @param string $type
     *
     * @return FbUserAsk
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return FbUserAsk
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set fbUser
     *
     * @param \ATKS\AdminBundle\Entity\FbUser $fbUser
     *
     * @return FbUserAsk
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
