<?php

namespace ATKS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Utils\Utils;
use ATKS\AdminBundle\Entity\Visiteur;

class HopitalController extends Controller
{
    public function listHopitalPlusProcheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $lat = $request->get("lat");
        $lon = $request->get("lon");
        $rayon = $request->get("rayon");
        $hopitaux = $em->getRepository("ATKSAdminBundle:Hopital")->findAll();
        $hopitauxLesPlusProche = array();
        $now = new \DateTime();
        foreach ($hopitaux as $h) {
            $distanceUserHopital = Utils::getDistance($lat, $lon, $h->getLatitude(), $h->getLongitude());
            $distanceUserHopitalEnKm = round($distanceUserHopital / 1000, 1);
            if ($distanceUserHopitalEnKm <= floatval($rayon)) {
                if ($now >= $h->getHeureOuverture() && $now <= $h->getHeureFermeture()) {
                    $statut = true;
                } else {
                    $statut = false;
                }
                $hopitauxLesPlusProche[] = array(
                    'id' => $h->getId(),
                    'nom' => $h->getNom(),
                    'distance' => $distanceUserHopitalEnKm,
                    'longitude' => $h->getLongitude(),
                    'latitude' => $h->getLatitude(),
                    'altitude' => $h->getAltitude(),
                    'nbreService' => $em->getRepository("ATKSAdminBundle:HopitalService")->nbreServicehopital($h->getId()),
                    'statut' => $statut,
                    'note' => ($h->getNbreVotant()>0)?ceil($h->getNote()/$h->getNbreVotant()):0,
                    'adresse' => $h->getAdresse(),
                    'image' => ($h->getImage()->getUrl()!=null)?$h->getImage()->getWebPath():"bundles/atksadmin/images/caducee-pharmacie.jpg"
                );
            }
        }
		
		$adressIp = $_SERVER['REMOTE_ADDR'];
        $oldVisiteur = $em->getRepository("ATKSAdminBundle:Visiteur")->findOneByAdresseIp($adressIp);
        if ($oldVisiteur) {
            $oldVisiteur->setTimestamp(time());
            $oldVisiteur->setDateDerniereConnexion($now);
            $oldVisiteur->setLatitude($lat);
            $oldVisiteur->setLongitude($lon);
            $em->flush();
        } else {
            $newVisiteur = new Visiteur();
            $newVisiteur->setAdresseIp($adressIp);
            $newVisiteur->setTimestamp(time());
            $newVisiteur->setDateDerniereConnexion($now);
            $newVisiteur->setDatePremiereConnexion($now);
            $newVisiteur->setLatitude($lat);
            $newVisiteur->setLongitude($lon);
            $em->persist($newVisiteur);
            $em->flush();
        }
//        die(var_dump($hopitauxLesPlusProche));
		usort($hopitauxLesPlusProche, array($this,'cmp'));
        return $this->render('ATKSUserBundle:Hopital:listHopitalPlusProche.html.twig', array(
            'hopitauxLesPlusProche'=>$hopitauxLesPlusProche,
            'rayon'=>$rayon
        ));
    }
    
    public function detailHopitalAction($id){
        $em = $this->getDoctrine()->getManager();
        $hopital = $em->getRepository("ATKSAdminBundle:Hopital")->find($id);
        $hopitalService = $em->getRepository("ATKSAdminBundle:HopitalService")
                ->findByHopital($hopital);
        return $this->render('ATKSUserBundle:Hopital:detailHopital.html.twig', array(
            'hopital'=>$hopital,
            'hopitalService'=>$hopitalService
        ));
    }
    
    public function lesHopitauxDisposantUnServiceAction($id){
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository("ATKSAdminBundle:ServiceSante")->find($id);
        $hopitalService = $em->getRepository("ATKSAdminBundle:HopitalService")
                ->findByService($service);
        $request = $this->getRequest();
        $lat = $request->get("lat");
        $lon = $request->get("lon");
        $rayon = $request->get("rayon");
        $hopitauxLesPlusProche = array();
        $now = new \DateTime();
        foreach ($hopitalService as $hs) {
            $distanceUserHopital = Utils::getDistance($lat, $lon, $hs->getHopital()->getLatitude(), $hs->getHopital()->getLongitude());
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
                    'nbreService' => $em->getRepository("ATKSAdminBundle:HopitalService")->nbreServicehopital($hs->getHopital()->getId()),
                    'statut' => $statut,
                    'note' => ($hs->getHopital()->getNbreVotant()>0)?ceil($hs->getHopital()->getNote()/$hs->getHopital()->getNbreVotant()):0,
                    'adresse' => $hs->getHopital()->getAdresse(),
                    'image' => ($hs->getHopital()->getImage()->getUrl()!=null)?$hs->getHopital()->getImage()->getWebPath():"bundles/atksadmin/images/caducee-pharmacie.jpg"
                );
            }
        }
//        die(var_dump($hopitauxLesPlusProche));
		usort($hopitauxLesPlusProche, array($this,'cmp'));
        return $this->render('ATKSUserBundle:Hopital:listHopitauxDisposantUnService.html.twig', array(
            'hopitauxLesPlusProche'=>$hopitauxLesPlusProche,
            'rayon'=>$rayon,
            'service'=>$service->getNom()
        ));
    }
    
    public function rechercheAction(){
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $lat = floatval($request->get("lat"));
        $lon = floatval($request->get("lon"));
        $rayon = floatval($request->get("rayon"));
        $query = $request->get("query");
        $hopitalService = $em->getRepository("ATKSAdminBundle:HopitalService")->hopitauxServiceRechercher($query);
        $hopitauxLesPlusProche = array();
        $now = new \DateTime();
        foreach ($hopitalService as $hs) {
            $distanceUserHopital = Utils::getDistance($lat, $lon, $hs->getHopital()->getLatitude(), $hs->getHopital()->getLongitude());
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
                    'nbreService' => $em->getRepository("ATKSAdminBundle:HopitalService")->nbreServicehopital($hs->getHopital()->getId()),
                    'statut' => $statut,
                    'note' => ($hs->getHopital()->getNbreVotant()>0)?ceil($hs->getHopital()->getNote()/$hs->getHopital()->getNbreVotant()):0,
                    'adresse' => $hs->getHopital()->getAdresse(),
                    'image' => /*"http://" . $_SERVER["HTTP_HOST"] . "/ProxiSante/web/" . */$hs->getHopital()->getImage()->getWebPath()
                );
            }
        }
		usort($hopitauxLesPlusProche, array($this,'cmp'));
        return $this->render('ATKSUserBundle:Hopital:listHopitauxDisposantUnService.html.twig', array(
            'hopitauxLesPlusProche'=>$hopitauxLesPlusProche,
            'rayon'=>$rayon,
            'service'=>$query
        ));
    }
	
	public function cmp($a, $b){
        if($a['distance'] == $b['distance']){
            return 0;
        }
        return ($a['distance'] < $b['distance']) ? -1 : 1;
    }
}
