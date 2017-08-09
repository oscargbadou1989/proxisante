<?php

namespace ATKS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\Probleme;

class AccueilController extends Controller {

    public function accueilAction() {
        return $this->render('ATKSUserBundle:Accueil:accueil.html.twig');
    }

    public function proxiSanteMobileAccueilAction() {
        return $this->render('ATKSUserBundle:Accueil:proxiSanteMobileAccueil.html.twig');
    }

    public function bulletinEducPlusAction() {
        $request = $this->getRequest();
        $nom = $request->get("nom");
        $prenom = $request->get("prenom");
        return $this->render('ATKSUserBundle:Accueil:bulletinEducPlus.html.twig', array(
                    'nom' => $nom,
                    'prenom' => $prenom
        ));
    }

    public function soumettreProblemeAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $telephoneOuMail = $request->get("telephoneOuMail");
        $contenu = $request->get("contenu");
        $newProbleme = new Probleme();
        $newProbleme->setNumeroUser($telephoneOuMail);
        $newProbleme->setIdPhoneUser("www.229proxisante.com");
        $newProbleme->setContenu($contenu);
        $em->persist($newProbleme);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Soumission effectué avec succès');
        return $this->redirect($this->generateUrl('atks_user_accueil'));
    }

}
