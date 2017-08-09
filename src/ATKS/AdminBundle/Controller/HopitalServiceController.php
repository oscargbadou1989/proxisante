<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\HopitalService;
use ATKS\AdminBundle\Form\HopitalServiceType;

class HopitalServiceController extends Controller {

    public function ajoutAction() {
        $em = $this->getDoctrine()->getManager();
        $newHopitalService = new HopitalService();
        $form = $this->createForm(new HopitalServiceType(), $newHopitalService);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newHopitalService);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Le service a été bien ajouté à cet hopital');
                return $this->redirect($this->generateUrl('atks_admin_ajout_hopital_service'));
            }
        }
        return $this->render('ATKSAdminBundle:HopitalService:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $hopitalService = $em->getRepository("ATKSAdminBundle:HopitalService")->find($id);
        $form = $this->createForm(new HopitalServiceType(), $hopitalService);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($hopitalService);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Le service a été bien ajouté à cet hopital');
                return $this->redirect($this->generateUrl('atks_admin_list_hopital'));
            }
        }
        return $this->render('ATKSAdminBundle:HopitalService:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $hopitalService = $em->getRepository("ATKSAdminBundle:HopitalService")
                ->find($id);
        if ($hopitalService === null) {
            throw $this->createNotFoundException('Cet hopital n\'existe pas');
        }
        $em->remove($hopitalService);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Hopital Service supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_hopital'));
    }

}
