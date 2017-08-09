<?php

namespace ATKS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * Admin
 *
 * @ORM\Table(name="ps_admin")
 * @ORM\Entity(repositoryClass="ATKS\UserBundle\Entity\AdminRepository")
 * @UniqueEntity(fields = "username", targetClass = "ATKS\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "ATKS\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Admin extends User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
