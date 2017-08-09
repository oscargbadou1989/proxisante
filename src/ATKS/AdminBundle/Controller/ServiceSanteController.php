<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\ServiceSante;
use ATKS\AdminBundle\Form\ServiceSanteType;

class ServiceSanteController extends Controller {

    public function listAction() {
        $em = $this->getDoctrine()->getManager();
        $serviceSantes = $em->getRepository("ATKSAdminBundle:ServiceSante")->findAll();
        $newServiceSante = new ServiceSante();
        $form = $this->createForm(new ServiceSanteType(), $newServiceSante);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newServiceSante);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Service de santé créé avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_service_sante'));
            }
        }
        return $this->render('ATKSAdminBundle:ServiceSante:list.html.twig', array(
                    'form' => $form->createView(),
                    'serviceSantes' => $serviceSantes
        ));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $serviceSantes = $em->getRepository("ATKSAdminBundle:ServiceSante")->findAll();
        $serviceSante = $em->getRepository("ATKSAdminBundle:ServiceSante")->find($id);
        $form = $this->createForm(new ServiceSanteType(), $serviceSante);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($serviceSante);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Service de santé mise à jour avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_service_sante'));
            }
        }
        return $this->render('ATKSAdminBundle:ServiceSante:list.html.twig', array(
                    'form' => $form->createView(),
                    'serviceSantes' => $serviceSantes
        ));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $serviceSante = $em->getRepository("ATKSAdminBundle:ServiceSante")
                ->find($id);
        if ($serviceSante === null) {
            throw $this->createNotFoundException('Ce service de santé n\'existe pas');
        }
        $em->remove($serviceSante);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Service de santé supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_service_sante'));
    }

}
