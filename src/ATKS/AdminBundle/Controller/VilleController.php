<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\Ville;
use ATKS\AdminBundle\Form\VilleType;

class VilleController extends Controller {

    public function listAction() {
        $em = $this->getDoctrine()->getManager();
        $villes = $em->getRepository("ATKSAdminBundle:Ville")->findAll();
        $newVille = new Ville();
        $form = $this->createForm(new VilleType(), $newVille);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newVille);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Ville créée avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_ville'));
            }
        }
        return $this->render('ATKSAdminBundle:Ville:list.html.twig', array(
                    'form' => $form->createView(),
                    'villes' => $villes
        ));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $villes = $em->getRepository("ATKSAdminBundle:Ville")->findAll();
        $newVille = $em->getRepository("ATKSAdminBundle:Ville")->find($id);
        $form = $this->createForm(new VilleType(), $newVille);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newVille);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Ville créée avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_ville'));
            }
        }
        return $this->render('ATKSAdminBundle:Ville:list.html.twig', array(
                    'form' => $form->createView(),
                    'villes' => $villes
        ));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $ville = $em->getRepository("ATKSAdminBundle:Ville")
                ->find($id);
        if ($ville === null) {
            throw $this->createNotFoundException('Cette ville n\'existe pas');
        }
        $em->remove($ville);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Ville supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_ville'));
    }

}
