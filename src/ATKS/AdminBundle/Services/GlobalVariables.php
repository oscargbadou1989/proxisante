<?php

namespace ATKS\AdminBundle\Services;

use ATKS\AdminBundle\Entity\Visiteur;

class GlobalVariables extends \Twig_Extension {

    private $doctrine;

    public function __construct($doctrine) {
        $this->doctrine = $doctrine;
    }

    public function getVars() {
        $this->setVisiteur();
        return array(
            'nbreProblemeNonVue' => $this->doctrine->getManager()->getRepository("ATKSAdminBundle:Probleme")->nbreProblemeNonVu(),
            'nbreVisiteurNonVue' => $this->doctrine->getManager()->getRepository("ATKSAdminBundle:Visiteur")->nbreVisiteurNonVu(),
            'nbreUtilisateurNonVue' => $this->doctrine->getManager()->getRepository("ATKSAdminBundle:Utilisateur")->nbreUtilisateurNonVu(),
            'nbreHopitauxUserNonVue' => $this->doctrine->getManager()->getRepository("ATKSAdminBundle:HopitalUser")->nbreHopitauxUserNonVu(),
            'nbrePharmaciesUserNonVue' => $this->doctrine->getManager()->getRepository("ATKSAdminBundle:PharmacieUser")->nbrePharmaciesUserNonVue(),
            'services' => $this->doctrine->getManager()->getRepository("ATKSAdminBundle:ServiceSante")->findAll(),
        );
    }

    public function setVisiteur() {
        $adressIp = $_SERVER['REMOTE_ADDR'];
        $now = new \DateTime();
        $oldVisiteur = $this->doctrine->getManager()->getRepository("ATKSAdminBundle:Visiteur")->findOneByAdresseIp($adressIp);
        if ($oldVisiteur) {
            $oldVisiteur->setTimestamp(time());
            $oldVisiteur->setDateDerniereConnexion($now);
            $this->doctrine->getManager()->flush();
        } else {
            $newVisiteur = new Visiteur();
            $newVisiteur->setAdresseIp($adressIp);
            $newVisiteur->setTimestamp(time());
            $newVisiteur->setDateDerniereConnexion($now);
            $newVisiteur->setDatePremiereConnexion($now);
            $this->doctrine->getManager()->persist($newVisiteur);
            $this->doctrine->getManager()->flush();
        }
    }

    public function getFunctions() {
        return array(
            "getVars"=>new \Twig_SimpleFunction("getVars", array($this, "getVars"))
        );
    }

    public function getName() {
        return "proxiSanteGlobals";
    }

}
