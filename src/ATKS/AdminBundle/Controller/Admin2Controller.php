<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function listAdminAction()
    {
        $admins = $this->getDoctrine()
                ->getManager()
                ->getRepository("ATKSUserBundle:Admin")
                ->findAll();
        return $this->render('ATKSAdminBundle:Admin:listAdmin.html.twig', array(
            'admins'=>$admins
        ));
    }
    
    public function  supprimerAdminAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $admin = $em->getRepository("ATKSUserBundle:Admin")
                ->find($id);
        if ($admin === null) {
            throw $this->createNotFoundException('Cet administrateur n\'existe pas');
        }
        $em->remove($admin);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Admin supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_admin'));
    }
    
    public function listUtilisateurAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $premierUtilisateur = ($page - 1) * 100;
        $totalUtilisateur = $em->getRepository("ATKSAdminBundle:Utilisateur")->nbreUtilisateur();
        $totalPages = ceil(intval($totalUtilisateur) / 100);
        $utilisateurs = $em
                ->getRepository("ATKSAdminBundle:Utilisateur")
                ->findBy(array(), array(), 100, $premierUtilisateur);
        return $this->render('ATKSAdminBundle:Admin:listUtilisateur.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'totalUtilisateur' => $totalUtilisateur,
                    'utilisateurs' => $utilisateurs
        ));
    }
    
    public function marquerUtilisateurToutVuAction(){
        $em = $this->getDoctrine()->getManager();
        $utilisateursNonVu = $em
                ->getRepository("ATKSAdminBundle:Utilisateur")
                ->findBy(array("vue"=>false), array());
        foreach($utilisateursNonVu as $p){
            $p->setVue(true);
        }
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_utilisateur'));
    }
    
    public function marquerUtilisateurVueAction($id){
        $em = $this->getDoctrine()
                ->getManager();
        $utilisateur = $em->getRepository("ATKSAdminBundle:Utilisateur")->find($id);
        if($utilisateur->getVue()==true){
            $utilisateur->setVue(false);
        }else{
            $utilisateur->setVue(true);
        }
        $em->persist($utilisateur);
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_utilisateur'));
    }
    
    public function  supprimerUtilisateurAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $utilisateur = $em->getRepository("ATKSAdminBundle:Utilisateur")->find($id);
        if ($utilisateur === null) {
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }
        $em->remove($utilisateur);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Utilisateur supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_utilisateur'));
    }
    
    public function listPharmacienAction($page)
    {
        $em = $this->getDoctrine()
                ->getManager();
        $premierPharmacien = ($page - 1) * 100;
        $totalPharmacien = $em->getRepository("ATKSUserBundle:Pharmacien")->nbrePharmacien();
        $totalPages = ceil(intval($totalPharmacien) / 100);
        $pharmaciens = $em
                ->getRepository("ATKSUserBundle:Pharmacien")
                ->findBy(array(), array("id"=>"DESC"), 100, $premierPharmacien);
        return $this->render('ATKSAdminBundle:Admin:listPharmacien.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'pharmaciens' => $pharmaciens
        ));
    }
    
    public function  supprimerPharmacieAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $pharmacien = $em->getRepository("ATKSUserBundle:Pharmacien")
                ->find($id);
        if ($pharmacien === null) {
            throw $this->createNotFoundException('Ce pharmacien n\'existe pas');
        }
        $em->remove($pharmacien);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Pharmacien supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_pharmacien'));
    }
    
    public function listVisiteurAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $premierVisiteur = ($page - 1) * 100;
        $totalVisiteur = $em->getRepository("ATKSAdminBundle:Visiteur")->nbreVisiteur();
        $totalPages = ceil(intval($totalVisiteur) / 100);
        $visiteurs = $em
                ->getRepository("ATKSAdminBundle:Visiteur")
                ->findBy(array(), array(), 100, $premierVisiteur);
        return $this->render('ATKSAdminBundle:Admin:listVisiteur.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'totalVisiteur' => $totalVisiteur,
                    'visiteurs' => $visiteurs
        ));
    }
    
    public function marquerVisiteurToutVuAction(){
        $em = $this->getDoctrine()->getManager();
        $visiteursNonVu = $em
                ->getRepository("ATKSAdminBundle:Visiteur")
                ->findBy(array("vue"=>false), array());
        foreach($visiteursNonVu as $p){
            $p->setVue(true);
        }
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_visiteur'));
    }
    
    public function marquerVisiteurVueAction($id){
        $em = $this->getDoctrine()
                ->getManager();
        $visiteur = $em->getRepository("ATKSAdminBundle:Visiteur")->find($id);
        if($visiteur->getVue()==true){
            $visiteur->setVue(false);
        }else{
            $visiteur->setVue(true);
        }
        $em->persist($visiteur);
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_visiteur'));
    }

    public function supprimerVisiteurAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $visiteur = $em->getRepository("ATKSAdminBundle:Visiteur")
                ->find($id);
        if ($visiteur === null) {
            throw $this->createNotFoundException('Ce visiteur n\'existe pas');
        }
        $em->remove($visiteur);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Visiteur supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_visiteur'));
    }
}
