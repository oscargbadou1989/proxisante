<?php

namespace ATKS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Utils\Utils;
use ATKS\AdminBundle\Entity\Visiteur;

class PharmacieController extends Controller
{
    public function listPharmaciePlusProcheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $lat = $request->get("lat");
        $lon = $request->get("lon");
        $rayon = $request->get("rayon");
        $pharmacies = $em->getRepository("ATKSAdminBundle:Pharmacie")->findAll();
        $pharmaciesLesPlusProche = array();
        $now = new \DateTime();
        foreach ($pharmacies as $p) {
            $distanceUserPharmacie = Utils::getDistance($lat, $lon, $p->getLatitude(), $p->getLongitude());
            $distanceUserPharmacieEnKm = round($distanceUserPharmacie / 1000, 1);
            if ($distanceUserPharmacieEnKm <= floatval($rayon)) {
                if ($now >= $p->getHeureOuverture() && $now <= $p->getHeureFermeture()) {
                    $statut = true;
                } else {
                    $statut = false;
                }
                $pharmaciesLesPlusProche[] = array(
                    'id' => $p->getId(),
                    'nom' => $p->getNom(),
                    'distance' => $distanceUserPharmacieEnKm,
                    'longitude' => $p->getLongitude(),
                    'latitude' => $p->getLatitude(),
                    'altitude' => $p->getAltitude(),
                    'nbreSpecialite' => $em->getRepository("ATKSAdminBundle:PharmacieSpecialite")->nbreSpecialitePharmacie($p->getId()),
                    'statut' => $statut,
                    'note' => ($p->getNbreVotant()>0)?ceil($p->getNote()/$p->getNbreVotant()):0,
                    'adresse' => $p->getAdresse(),
                    'image' => ($p->getImage()->getUrl()!=null)?$p->getImage()->getWebPath():"bundles/atksadmin/images/caducee-pharmacie.jpg"
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
		usort($pharmaciesLesPlusProche, array($this,'cmp'));
        return $this->render('ATKSUserBundle:Pharmacie:listPharmaciePlusProche.html.twig', array(
            'pharmaciesLesPlusProche'=>$pharmaciesLesPlusProche,
            'rayon'=>$rayon
        ));
    }
    
    public function detailPharmacieAction($id){
        $em = $this->getDoctrine()->getManager();
        $pharmacie = $em->getRepository("ATKSAdminBundle:Pharmacie")->find($id);
        $pharmacieSpecialite = $em->getRepository("ATKSAdminBundle:PharmacieSpecialite")
                ->findByPharmacie($pharmacie);
        return $this->render('ATKSUserBundle:Pharmacie:detailPharmacie.html.twig', array(
            'pharmacie'=>$pharmacie,
            'pharmacieSpecialite'=>$pharmacieSpecialite
        ));
    }
	
	public function cmp($a, $b){
        if($a['distance'] == $b['distance']){
            return 0;
        }
        return ($a['distance'] < $b['distance']) ? -1 : 1;
    }
}
