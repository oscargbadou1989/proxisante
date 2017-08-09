<?php

namespace ATKS\AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use ATKS\AdminBundle\Utils\Utils;
use ATKS\AdminBundle\Entity\Probleme;
use ATKS\AdminBundle\Entity\Utilisateur;

class ProxiSanteService {

  private $em;

  public function __construct($em) {
    $this->em = $em;
  }

  public function hopitauxLesPlusProche($userLat, $userLon, $rayon) {
    $hopitaux = $this->em->getRepository("ATKSAdminBundle:Hopital")->findAll();
    $hopitauxLesPlusProche = array();
    $now = new \DateTime();
    foreach ($hopitaux as $h) {
      $distanceUserHopital = $this->getDistance($userLat, $userLon, $h->getLatitude(), $h->getLongitude());
      $distanceUserHopitalEnKm = round($distanceUserHopital / 1000, 1);
      if ($distanceUserHopitalEnKm <= floatval($rayon)) {
        if ($now >= new \DateTime($now->format('Y-m-d').' '.$h->getHeureOuverture()->format('H:i:s')) && $now <= new \DateTime($now->format('Y-m-d').' '.$h->getHeureFermeture()->format('H:i:s'))) {
          $statut = true;
        } else {
          $statut = false;
        }
        if($h->getImage() && $h->getImage()->getUrl()){
          $img = "https://" . $_SERVER["HTTP_HOST"] . "/" . $h->getImage()->getWebPath();
        }else{
          $img = "https://" . $_SERVER["HTTP_HOST"] . "/uploads/images/hopital.png" ;
        }
        $hopitauxLesPlusProche[] = array(
          'id' => $h->getId(),
          'nom' => $h->getNom(),
          'distance' => $distanceUserHopitalEnKm,
          'longitude' => $h->getLongitude(),
          'latitude' => $h->getLatitude(),
          'altitude' => $h->getAltitude(),
          'statut' => $statut,
          'adresse' => $h->getAdresse(),
          'image' => $img,
          'hopital' => true
        );
      }
    }
    usort($hopitauxLesPlusProche, array($this,'cmp'));
    return Utils::jsonRemoveUnicodeSequences(json_encode($hopitauxLesPlusProche));
  }

  public function pharmaciesLesPlusProche($userLat, $userLon, $rayon) {
    $pharmacies = $this->em->getRepository("ATKSAdminBundle:Pharmacie")->findAll();
    $pharmaciesLesPlusProche = array();
    $now = new \DateTime();
    foreach ($pharmacies as $p) {
      $distanceUserPharmacie = $this->getDistance($userLat, $userLon, $p->getLatitude(), $p->getLongitude());
      $distanceUserPharmacieEnKm = round($distanceUserPharmacie / 1000, 1);
      if ($distanceUserPharmacieEnKm <= floatval($rayon)) {
        if ($now >= new \DateTime($now->format('Y-m-d').' '.$p->getHeureOuverture()->format('H:i:s')) && $now <= new \DateTime($now->format('Y-m-d').' '.$p->getHeureFermeture()->format('H:i:s'))) {
          $statut = true;
        } else {
          $statut = false;
        }
        if($p->getImage() && $p->getImage()->getUrl()){
          $img = "https://" . $_SERVER["HTTP_HOST"] . "/" . $p->getImage()->getWebPath();
        }else{
          $img = "https://" . $_SERVER["HTTP_HOST"] . "/uploads/images/pharmacie.png" ;
        }
        $pharmaciesLesPlusProche[] = array(
          'id' => $p->getId(),
          'nom' => $p->getNom(),
          'distance' => $distanceUserPharmacieEnKm,
          'longitude' => $p->getLongitude(),
          'latitude' => $p->getLatitude(),
          'altitude' => $p->getAltitude(),
          'statut' => $statut,
          'adresse' => $p->getAdresse(),
          'image' => $img,
          'hopital' => false
        );
      }
    }
    usort($pharmaciesLesPlusProche, array($this,'cmp'));
    return Utils::jsonRemoveUnicodeSequences(json_encode($pharmaciesLesPlusProche));
  }

  public function detailHopital($id) {
    $hopital = $this->em->getRepository("ATKSAdminBundle:Hopital")->find($id);
    $hopitalService = $this->em->getRepository("ATKSAdminBundle:HopitalService")
    ->findByHopital($hopital);
    $services = array();
    foreach ($hopitalService as $hp) {
      $services[] = array(
        'id' => $hp->getId(),
        'nom' => $hp->getService()->getNom(),
        'nomSpecialiste' => $hp->getNomSpecialiste(),
        'qualificationSpecialiste' => $hp->getQualificationSpecialiste(),
        'telephoneSpecialiste' => $hp->getTelephoneSpecialiste(),
        'fraisPrestation' => $hp->getFraisPrestation()
      );
    }
    if($hopital->getImage() && $hopital->getImage()->getUrl()){
      $img = "https://" . $_SERVER["HTTP_HOST"] . "/" . $hopital->getImage()->getWebPath();
    }else{
      $img = "https://" . $_SERVER["HTTP_HOST"] . "/uploads/images/hopital.png" ;
    }
    $detailHopital = array(
      'id' => $hopital->getId(),
      'nom' => $hopital->getNom(),
      'type' => $hopital->getType(),
      'telephone' => $hopital->getTelephone(),
      'fax' => $hopital->getFax(),
      'email' => $hopital->getEmail(),
      'siteWeb' => $hopital->getSiteWeb(),
      'adresse' => $hopital->getAdresse(),
      'longitude' => $hopital->getLongitude(),
      'latitude' => $hopital->getLatitude(),
      'altitude' => $hopital->getAltitude(),
      'heureOuverture' => $hopital->getHeureOuverture()->format("H"),
      'heureFermeture' => $hopital->getHeureFermeture()->format("H"),
      'image' => $img,
      'services' => $services
    );
    return Utils::jsonRemoveUnicodeSequences(json_encode($detailHopital));
  }

  public function detailPharmacie($id) {
    $pharmacie = $this->em->getRepository("ATKSAdminBundle:Pharmacie")->find($id);
    $pharmacieSpecialite = $this->em->getRepository("ATKSAdminBundle:PharmacieSpecialite")
    ->findByPharmacie($pharmacie);
    $specialites = array();
    foreach ($pharmacieSpecialite as $ps) {
      $specialites[] = array(
        'id' => $ps->getId(),
        'nom' => $ps->getSpecialite()->getNom(),
      );
    }
    if($pharmacie->getImage() && $pharmacie->getImage()->getUrl()){
      $img = "https://" . $_SERVER["HTTP_HOST"] . "/" . $pharmacie->getImage()->getWebPath();
    }else{
      $img = "https://" . $_SERVER["HTTP_HOST"] . "/uploads/images/pharmacie.png" ;
    }
    $detailPharmacie = array(
      'id' => $pharmacie->getId(),
      'nom' => $pharmacie->getNom(),
      'telephone' => $pharmacie->getTelephone(),
      'fax' => $pharmacie->getFax(),
      'email' => $pharmacie->getEmail(),
      'siteWeb' => $pharmacie->getSiteWeb(),
      'adresse' => $pharmacie->getAdresse(),
      'nomPharmacien' => $pharmacie->getNomPharmacien(),
      'qualificationPharmacien' => $pharmacie->getQualificationPharmacien(),
      'longitude' => $pharmacie->getLongitude(),
      'latitude' => $pharmacie->getLatitude(),
      'altitude' => $pharmacie->getAltitude(),
      'heureOuverture' => $pharmacie->getHeureOuverture()->format("H"),
      'heureFermeture' => $pharmacie->getHeureFermeture()->format("H"),
      'image' => $img,
      'specialites' => $specialites
    );
    return Utils::jsonRemoveUnicodeSequences(json_encode($detailPharmacie));
  }

  public function detailServiceSante($id) {
    $hopitalService = $this->em->getRepository("ATKSAdminBundle:HopitalService")
    ->find($id);
    $detailServiceSante = array(
      'id' => $hopitalService->getId(),
      'nomSpecialiste' => $hopitalService->getNomSpecialiste(),
      'qualificationSpecialiste' => $hopitalService->getQualificationSpecialiste(),
      'telephoneSpecialiste' => $hopitalService->getTelephoneSpecialiste(),
      'fraisPrestation' => $hopitalService->getFraisPrestation()
    );
    return Utils::jsonRemoveUnicodeSequences(json_encode($detailServiceSante));
  }

  public function recherche2($hopitauxService, $userLat, $userLon, $rayon){
    $now = new \DateTime();
    $result = array();
    foreach ($hopitauxService as $hs) {
      $distanceUserHopital = $this->getDistance($userLat, $userLon, $hs->getHopital()->getLatitude(), $hs->getHopital()->getLongitude());
      $distanceUserHopitalEnKm = round($distanceUserHopital / 1000, 1);
      if ($distanceUserHopitalEnKm <= floatval($rayon)) {
        if ($now >= new \DateTime($now->format('Y-m-d').' '.$hs->getHopital()->getHeureOuverture()->format('H:i:s')) && $now <= new \DateTime($now->format('Y-m-d').' '.$hs->getHopital()->getHeureFermeture()->format('H:i:s'))) {
          $statut = true;
        } else {
          $statut = false;
        }
        $result[] = array(
          'id' => $hs->getHopital()->getId(),
          'nom' => $hs->getHopital()->getNom(),
          'distance' => $distanceUserHopitalEnKm,
          'statut' => $statut,
          'adresse' => $hs->getHopital()->getAdresse(),
          'image' => "https://" . $_SERVER["HTTP_HOST"] . "/" . $hs->getHopital()->getImage()->getWebPath(),
        );
      }
    }
    if(count($result)>0){
      usort($result, array($this,'cmp'));
    }
    return $result;
  }

  public function recherche($query, $userLat, $userLon, $rayon) {
    $hopitauxServiceRechercher = $this->em->getRepository("ATKSAdminBundle:HopitalService")->hopitauxServiceRechercher($query);
    $pharmacieSpecialiteRechercher = $this->em->getRepository("ATKSAdminBundle:PharmacieSpecialite")->pharmacieSpecialiteRechercher($query);
    $hopitauxLesPlusProche = array();
    $pharmaciesLesPlusProche = array();
    $now = new \DateTime();
    foreach ($hopitauxServiceRechercher as $hs) {
      $distanceUserHopital = $this->getDistance($userLat, $userLon, $hs->getHopital()->getLatitude(), $hs->getHopital()->getLongitude());
      $distanceUserHopitalEnKm = round($distanceUserHopital / 1000, 1);
      if ($distanceUserHopitalEnKm <= floatval($rayon)) {
        if ($now >= $hs->getHopital()->getHeureOuverture() && $now <= $hs->getHopital()->getHeureFermeture()) {
          $statut = true;
        } else {
          $statut = false;
        }
        $hopitauxLesPlusProche[] = array(
          'id' => $hs->getHopital()->getId(),
          'nom' => $hs->getHopital()->getNom(),
          'distance' => $distanceUserHopitalEnKm,
          'longitude' => $hs->getHopital()->getLongitude(),
          'latitude' => $hs->getHopital()->getLatitude(),
          'altitude' => $hs->getHopital()->getAltitude(),
          'statut' => $statut,
          'adresse' => $hs->getHopital()->getAdresse(),
          'hopital' => true
        );
      }
    }
    usort($hopitauxLesPlusProche, array($this,'cmp'));
    foreach ($pharmacieSpecialiteRechercher as $ps) {
      $distanceUserPharmacie = $this->getDistance($userLat, $userLon, $ps->getPharmacie()->getLatitude(), $ps->getPharmacie()->getLongitude());
      $distanceUserPharmacieEnKm = round($distanceUserPharmacie / 1000, 1);
      if ($distanceUserPharmacieEnKm <= floatval($rayon)) {
        if ($now >= $ps->getPharmacie()->getHeureOuverture() && $now <= $ps->getPharmacie()->getHeureFermeture()) {
          $statut = true;
        } else {
          $statut = false;
        }
        $pharmaciesLesPlusProche[] = array(
          'id' => $ps->getPharmacie()->getId(),
          'nom' => $ps->getPharmacie()->getNom(),
          'distance' => $distanceUserPharmacieEnKm,
          'longitude' => $ps->getPharmacie()->getLongitude(),
          'latitude' => $ps->getPharmacie()->getLatitude(),
          'altitude' => $ps->getPharmacie()->getAltitude(),
          'statut' => $statut,
          'adresse' => $ps->getPharmacie()->getAdresse(),
          'hopital' => false
        );
      }
    }
    usort($pharmaciesLesPlusProche, array($this,'cmp'));
    $result = array(
      'hopitaux' => $hopitauxLesPlusProche,
      'pharmacies' => $pharmaciesLesPlusProche
    );
    return Utils::jsonRemoveUnicodeSequences(json_encode($result));
  }

  public function publicite() {
    $publicites = $this->em->getRepository("ATKSAdminBundle:Publicite")
    ->findBy(array("actif" => true), array());
    $result = array();
    foreach ($publicites as $p) {
      $images = $p->getImages();
      $result[] = array(
        'id' => $p->getId(),
        'nomStructure' => $p->getNomStructure(),
        'url' => $p->getSiteWeb(),
        'image' => "http://" . $_SERVER["HTTP_HOST"] . "/" . $images[0]->getWebPath(),
      );
    }
    return Utils::jsonRemoveUnicodeSequences(json_encode($result));
  }

  public function services() {
    $servicesObjet = $this->em->getRepository("ATKSAdminBundle:ServiceSante")->findAll();
    $services = array();
    foreach ($servicesObjet as $s) {
      $services[] = $s->getNom();
    }
    return Utils::jsonRemoveUnicodeSequences(json_encode($services));
  }

  public function soumissionProbleme($numeroUser, $idPhoneUser, $contenu) {
    $probleme = new Probleme();
    $probleme->setNumeroUser($numeroUser);
    $probleme->setDateSoumission(new \DateTime());
    $probleme->setIdPhoneUser($idPhoneUser);
    $probleme->setContenu($contenu);
    $this->em->persist($probleme);
    $this->em->flush();
  }

  public function connexion($idPhoneUser, $plateforme, $version) {
    $oldUser = $this->em->getRepository("ATKSAdminBundle:Utilisateur")->findOneByIdPhoneUser($idPhoneUser);
    $now = new \DateTime();
    if ($oldUser) {
      $oldUser->setDateDerniereConnexion($now);
      $oldUser->setNbreConnexion($oldUser->getNbreConnexion()+1);
      $oldUser->setHistoriqueConnexion($oldUser->getHistoriqueConnexion() . "_" . $now->format("Y-m-d H:i:s"));
      $this->em->persist($oldUser);
      $this->em->flush();
    } else {
      $newUser = new Utilisateur();
      $newUser->setIdPhoneUser($idPhoneUser);
      $newUser->setPlateforme($plateforme);
      $newUser->setVersion($version);
      $newUser->setNbreConnexion($newUser->getNbreConnexion()+1);
      $newUser->setDatePremiereConnexion($now);
      $newUser->setDateDerniereConnexion($now);
      $newUser->setHistoriqueConnexion($now->format("Y-m-d H:i:s"));
      $this->em->persist($newUser);
      $this->em->flush();
    }
  }

  private function getDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6378137;
    $lat1ToRad = deg2rad($lat1);
    $lon1ToRad = deg2rad($lon1);
    $lat2ToRad = deg2rad($lat2);
    $lon2ToRad = deg2rad($lon2);
    $dlo = ($lon2ToRad - $lon1ToRad) / 2;
    $dla = ($lat2ToRad - $lat1ToRad) / 2;
    $a = (sin($dla) * sin($dla)) + cos($lat1ToRad) * cos($lat2ToRad) * (sin($dlo) * sin($dlo));
    $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return($earthRadius * $d);
  }

  public function cmp($a, $b){
    if($a['distance'] == $b['distance']){
      return 0;
    }
    return ($a['distance'] < $b['distance']) ? -1 : 1;
  }

}

?>
