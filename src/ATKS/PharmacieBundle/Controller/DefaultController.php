<?php

namespace ATKS\PharmacieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ATKSPharmacieBundle:Default:index.html.twig', array('name' => $name));
    }
}
