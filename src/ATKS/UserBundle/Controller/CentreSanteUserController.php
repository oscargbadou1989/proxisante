<?php

namespace ATKS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\HopitalUser;
use ATKS\AdminBundle\Entity\PharmacieUser;
use ATKS\AdminBundle\Form\HopitalUserType;
use ATKS\AdminBundle\Form\PharmacieUserType;

class CentreSanteUserController extends Controller {

    public function ajouterHopitalAction() {
        $em = $this->getDoctrine()->getManager();
        $newHopitalUser = new HopitalUser();
        $serviceSantes = $em->getRepository("ATKSAdminBundle:ServiceSante")->findAll();
        $form = $this->createForm(new HopitalUserType(), $newHopitalUser);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $serviceSantesId = "";
                foreach ($serviceSantes as $ss) {
                    if ($request->get("ss" . $ss->getId()) == "on") {
//                        var_dump("ss" . $ss->getId() . "----" . $request->get("ss" . $ss->getId()));
                        $serviceSantesId = $serviceSantesId . $ss->getId() . "_";
                    }
                }
                $newHopitalUser->setServiceSantesId($serviceSantesId);
//                die(var_dump($serviceSantesId));
                $em->persist($newHopitalUser);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Hopital ajouté avec succès. Vous venez de sauver une vie.');
                return $this->redirect($this->generateUrl('atks_user_accueil'));
            }
        }
        return $this->render('ATKSUserBundle:CentreSanteUser:ajouterHopital.html.twig', array(
                    'form' => $form->createView(),
                    'serviceSantes' => $serviceSantes
        ));
    }
    
    public function ajouterPharmacieAction() {
        $em = $this->getDoctrine()->getManager();
        $newPharmacieUser = new PharmacieUser();
        $specialites = $em->getRepository("ATKSAdminBundle:SpecialitePharmacie")->findAll();
        $form = $this->createForm(new PharmacieUserType(), $newPharmacieUser);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $specialiteId = "";
                foreach ($specialites as $s) {
                    if ($request->get("specialite" . $s->getId()) == "on") {
//                        var_dump("ss" . $ss->getId() . "----" . $request->get("ss" . $ss->getId()));
                        $specialiteId = $specialiteId . $s->getId() . "_";
                    }
                }
                $newPharmacieUser->setSpecialiteId($specialiteId);
//                die(var_dump($serviceSantesId));
                $em->persist($newPharmacieUser);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Pharmacie ajoutée avec succès. Vous venez de sauver une vie.');
                return $this->redirect($this->generateUrl('atks_user_accueil'));
            }
        }
        return $this->render('ATKSUserBundle:CentreSanteUser:ajouterPharmacie.html.twig', array(
                    'form' => $form->createView(),
                    'specialites' => $specialites
        ));
    }

}
