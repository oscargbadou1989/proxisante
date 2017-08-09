<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\ENtity\Produit;
use ATKS\AdminBundle\Form\ProduitType;

class ProduitController extends Controller
{
    public function listAction($page)
    {
        $em = $this->getDoctrine()
                ->getManager();
        $premierProduit = ($page - 1) * 100;
        $totalProduit = $em->getRepository("ATKSAdminBundle:Produit")->nbreProduit();
        $totalPages = ceil(intval($totalProduit) / 100);
        $produits = $em
                ->getRepository("ATKSAdminBundle:Produit")
                ->findBy(array(), array("id" => "ASC"), 100, $premierProduit);
        return $this->render('ATKSAdminBundle:Produit:list.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'produits' => $produits
        ));
    }
    
    public function ajoutAction() {
        $em = $this->getDoctrine()->getManager();
        $newProduit = new Produit();
        $form = $this->createForm(new ProduitType(), $newProduit);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newProduit);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Produit créé avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_produit'));
            }
        }
        return $this->render('ATKSAdminBundle:Produit:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function modifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $newProduit = $em->getRepository("ATKSAdminBundle:Produit")->find($id);
        $form = $this->createForm(new ProduitType(), $newProduit);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newProduit);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Produit mise à jour avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_produit'));
            }
        }
        return $this->render('ATKSAdminBundle:Produit:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $produit = $em->getRepository("ATKSAdminBundle:Produit")
                ->find($id);
        if ($produit === null) {
            throw $this->createNotFoundException('Ce produit n\'existe pas');
        }
        $em->remove($produit);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Pharmacie supprimée avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_ville'));
    }
}
