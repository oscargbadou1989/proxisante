<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\Pharmacie;
use ATKS\AdminBundle\Form\PharmacieType;

class PharmacieController extends Controller {

    public function listAction($page) {
        $em = $this->getDoctrine()
                ->getManager();
        $premierPharmacie = ($page - 1) * 100;
        $totalPharmacie = $em->getRepository("ATKSAdminBundle:Pharmacie")->nbrePharmacie();
        $totalPages = ceil(intval($totalPharmacie) / 100);
        $pharmacies = $em
                ->getRepository("ATKSAdminBundle:Pharmacie")
                ->findBy(array(), array("id" => "DESC"), 100, $premierPharmacie);
        return $this->render('ATKSAdminBundle:Pharmacie:list.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'pharmacies' => $pharmacies
        ));
    }

    public function ajoutAction() {
        $em = $this->getDoctrine()->getManager();
        $newPharmacie = new Pharmacie();
        $form = $this->createForm(new PharmacieType(), $newPharmacie);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newPharmacie);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Pharmacie créée avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_pharmacie'));
            }
        }
        return $this->render('ATKSAdminBundle:Pharmacie:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $pharmacie = $em->getRepository("ATKSAdminBundle:Pharmacie")->find($id);
        $oldImage = $pharmacie->getImage();
        $form = $this->createForm(new PharmacieType(), $pharmacie);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                /*$newImage = $pharmacie->getImage();
                if($newImage == null){
                    $pharmacie->setImage($oldImage);
                }*/
                $em->persist($pharmacie);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Pharmacie créée avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_pharmacie'));
            }
        }
        return $this->render('ATKSAdminBundle:Pharmacie:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $pharmacie = $em->getRepository("ATKSAdminBundle:Pharmacie")
                ->find($id);
        if ($pharmacie === null) {
            throw $this->createNotFoundException('Cette pharmacie n\'existe pas');
        }
        $em->remove($pharmacie);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Pharmacie supprimée avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_pharmacie'));
    }
    
    public function voirSpecialiteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $pharmacie = $em->getRepository("ATKSAdminBundle:Pharmacie")
                ->find($id);
        $pharmacieSpecialite = $em->getRepository("ATKSAdminBundle:PharmacieSpecialite")
                ->findByPharmacie($pharmacie);
        return $this->render('ATKSAdminBundle:Pharmacie:voirSpecialite.html.twig', array(
                    'pharmacieSpecialite' => $pharmacieSpecialite,
                    'pharmacie' => $pharmacie
        ));
    }
    
    public function voirPharmacieDisposantSpecialiteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $specialite = $em->getRepository("ATKSAdminBundle:SpecialitePharmacie")
                ->find($id);
        $pharmacieSpecialite = $em->getRepository("ATKSAdminBundle:PharmacieSpecialite")
                ->findBySpecialite($specialite);
        return $this->render('ATKSAdminBundle:Pharmacie:voirPharmacie.html.twig', array(
                    'pharmacieSpecialite' => $pharmacieSpecialite,
                    'specialite' => $specialite
        ));
    }

}
