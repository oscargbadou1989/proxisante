<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CentreSanteUserController extends Controller
{
    public function listHopitalAction($page)
    {
        $em = $this->getDoctrine()
                ->getManager();
        $premierHopital = ($page - 1) * 100;
        $totalHopital = $em->getRepository("ATKSAdminBundle:HopitalUser")->nbreHopital();
        $totalPages = ceil(intval($totalHopital) / 100);
        $hopitaux = $em
                ->getRepository("ATKSAdminBundle:HopitalUser")
                ->findBy(array(), array("id" => "DESC"), 100, $premierHopital);
        return $this->render('ATKSAdminBundle:CentreSanteUser:listHopital.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'hopitaux' => $hopitaux
        ));
    }
    
    public function marquerHopitauxVueAction(){
        $em = $this->getDoctrine()->getManager();
        $hopitauxNonVu = $em
                ->getRepository("ATKSAdminBundle:HopitalUser")
                ->findBy(array("vue"=>false), array());
        foreach($hopitauxNonVu as $h){
            $h->setVue(true);
        }
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_hopital_soumis_user'));
    }
    
    public function marquerHopitalVueAction($id){
        $em = $this->getDoctrine()
                ->getManager();
        $hopital = $em->getRepository("ATKSAdminBundle:HopitalUser")->find($id);
        if($hopital->getVue()==true){
            $hopital->setVue(false);
        }else{
            $hopital->setVue(true);
        }
        $em->persist($hopital);
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_hopital_soumis_user'));
    }
    
    public function supprimerHopitalAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $hopital = $em->getRepository("ATKSAdminBundle:HopitalUser")
                ->find($id);
        if ($hopital === null) {
            throw $this->createNotFoundException('Cet hopital n\'existe pas');
        }
        $em->remove($hopital);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Hopital supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_hopital_soumis_user'));
    }
    
    public function listPharmacieAction($page)
    {
        $em = $this->getDoctrine()
                ->getManager();
        $premierePharmacie = ($page - 1) * 100;
        $totalPharmacie = $em->getRepository("ATKSAdminBundle:PharmacieUser")->nbrePharmacie();
        $totalPages = ceil(intval($totalPharmacie) / 100);
        $pharmacies = $em
                ->getRepository("ATKSAdminBundle:PharmacieUser")
                ->findBy(array(), array("id" => "DESC"), 100, $premierePharmacie);
        return $this->render('ATKSAdminBundle:CentreSanteUser:listPharmacie.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'pharmacies' => $pharmacies
        ));
    }
    
    public function marquerPharmaciesVueAction(){
        $em = $this->getDoctrine()->getManager();
        $pharmaciesNonVu = $em
                ->getRepository("ATKSAdminBundle:PharmacieUser")
                ->findBy(array("vue"=>false), array());
        foreach($pharmaciesNonVu as $h){
            $h->setVue(true);
        }
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_pharmacie_soumis_user'));
    }
    
    public function marquerPharmacieVueAction($id){
        $em = $this->getDoctrine()
                ->getManager();
        $pharmacie = $em->getRepository("ATKSAdminBundle:PharmacieUser")->find($id);
        if($pharmacie->getVue()==true){
            $pharmacie->setVue(false);
        }else{
            $pharmacie->setVue(true);
        }
        $em->persist($pharmacie);
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_pharmacie_soumis_user'));
    }
    
    public function supprimerPharmacieAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $pharmacie = $em->getRepository("ATKSAdminBundle:PharmacieUser")
                ->find($id);
        if ($pharmacie === null) {
            throw $this->createNotFoundException('Cette pharmacie n\'existe pas');
        }
        $em->remove($pharmacie);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Pharmacie supprimée avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_pharmacie_soumis_user'));
    }
}
