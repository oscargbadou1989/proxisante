<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\SpecialitePharmacie;
use ATKS\AdminBundle\Form\SpecialitePharmacieType;

class SpecialitePharmacieController extends Controller {

    public function listAction() {
        $em = $this->getDoctrine()->getManager();
        $specialitePharmacies = $em->getRepository("ATKSAdminBundle:SpecialitePharmacie")->findAll();
        $newSpecialitePharmacie = new SpecialitePharmacie();
        $form = $this->createForm(new SpecialitePharmacieType(), $newSpecialitePharmacie);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newSpecialitePharmacie);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Spécialité de pharmacie créé avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_specialite_pharmacie'));
            }
        }
        return $this->render('ATKSAdminBundle:SpecialitePharmacie:list.html.twig', array(
                    'form' => $form->createView(),
                    'specialitePharmacies' => $specialitePharmacies
        ));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $specialitePharmacies = $em->getRepository("ATKSAdminBundle:SpecialitePharmacie")->findAll();
        $specialitePharmacie = $em->getRepository("ATKSAdminBundle:SpecialitePharmacie")->find($id);
        $form = $this->createForm(new SpecialitePharmacieType(), $specialitePharmacie);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($specialitePharmacie);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Spécialité de pharmacie mise à jour avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_specialite_pharmacie'));
            }
        }
        return $this->render('ATKSAdminBundle:ServiceSante:list.html.twig', array(
                    'form' => $form->createView(),
                    'serviceSantes' => $specialitePharmacies
        ));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $specialitePharmacie = $em->getRepository("ATKSAdminBundle:SpecialitePharmacie")
                ->find($id);
        if ($specialitePharmacie === null) {
            throw $this->createNotFoundException('Cette spécialité de pharmacie n\'existe pas');
        }
        $em->remove($specialitePharmacie);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Spécialité de pharmacie supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_specialite_pharmacie'));
    }

}
