<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\PharmacieSpecialite;
use ATKS\AdminBundle\Form\PharmacieSpecialiteType;

class PharmacieSpecialiteController extends Controller {

    public function ajoutAction() {
        $em = $this->getDoctrine()->getManager();
        $newPharmacieSpecialite = new PharmacieSpecialite();
        $form = $this->createForm(new PharmacieSpecialiteType(), $newPharmacieSpecialite);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newPharmacieSpecialite);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'La spécialité a été bien ajouté à cette pharmacie');
                return $this->redirect($this->generateUrl('atks_admin_ajout_pharmacie_specialite'));
            }
        }
        return $this->render('ATKSAdminBundle:PharmacieSpecialite:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $pharmacieSpecialite = $em->getRepository("ATKSAdminBundle:PharmacieSpecialite")->find($id);
        $form = $this->createForm(new PharmacieSpecialiteType(), $pharmacieSpecialite);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($pharmacieSpecialite);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'La spécialité a été bien ajouté à cette pharmacie');
                return $this->redirect($this->generateUrl('atks_admin_ajout_pharmacie_specialite'));
            }
        }
        return $this->render('ATKSAdminBundle:PharmacieSpecialite:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $pharmacieSpecialite = $em->getRepository("ATKSAdminBundle:PharmacieSpecialite")
                ->find($id);
        if ($pharmacieSpecialite === null) {
            throw $this->createNotFoundException('Cette spécialite n\'existe pas pour cette pharmacie');
        }
        $em->remove($pharmacieSpecialite);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'La spécialité a été bien supprimer pour cette pharmacie');
        return $this->redirect($this->generateUrl('atks_admin_list_pharmacie'));
    }

}
