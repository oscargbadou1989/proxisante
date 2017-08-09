<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\Hopital;
use ATKS\AdminBundle\Form\HopitalType;

class HopitalController extends Controller {

    public function listAction($page) {
        $em = $this->getDoctrine()
                ->getManager();
        $premierHopital = ($page - 1) * 100;
        $totalHopital = $em->getRepository("ATKSAdminBundle:Hopital")->nbreHopital();
        $totalPages = ceil(intval($totalHopital) / 100);
        $hopitaux = $em
                ->getRepository("ATKSAdminBundle:Hopital")
                ->findBy(array(), array("id" => "DESC"), 100, $premierHopital);
        return $this->render('ATKSAdminBundle:Hopital:list.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'hopitaux' => $hopitaux
        ));
    }

    public function ajoutAction() {
        $em = $this->getDoctrine()->getManager();
        $newHopital = new Hopital();
        $form = $this->createForm(new HopitalType(), $newHopital);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newHopital);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Hopital créé avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_hopital'));
            }
        }
        return $this->render('ATKSAdminBundle:Hopital:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $hopital = $em->getRepository("ATKSAdminBundle:Hopital")->find($id);
        $oldImage = $hopital->getImage();
        $form = $this->createForm(new HopitalType(), $hopital);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $newImage = $hopital->getImage();
                if($newImage ==null){
                    $hopital->setImage($oldImage);
                }
                $em->persist($hopital);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Hopital mise à jour avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_hopital'));
            }
        }
        return $this->render('ATKSAdminBundle:Hopital:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $hopital = $em->getRepository("ATKSAdminBundle:Hopital")
                ->find($id);
        if ($hopital === null) {
            throw $this->createNotFoundException('Cet hopital n\'existe pas');
        }
        $em->remove($hopital);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Hopital supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_hopital'));
    }
    
    public function voirServiceAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $hopital = $em->getRepository("ATKSAdminBundle:Hopital")
                ->find($id);
        $hopitalService = $em->getRepository("ATKSAdminBundle:HopitalService")
                ->findByHopital($hopital);
        return $this->render('ATKSAdminBundle:Hopital:voirService.html.twig', array(
                    'hopitalService' => $hopitalService,
                    'hopital' => $hopital
        ));
    }
    
    public function voirHopitalDisposantUnServiceAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $service = $em->getRepository("ATKSAdminBundle:ServiceSante")
                ->find($id);
        $hopitalService = $em->getRepository("ATKSAdminBundle:HopitalService")
                ->findByService($service);
        return $this->render('ATKSAdminBundle:Hopital:voirHopital.html.twig', array(
                    'hopitalService' => $hopitalService,
                    'service' => $service
        ));
    }

}
