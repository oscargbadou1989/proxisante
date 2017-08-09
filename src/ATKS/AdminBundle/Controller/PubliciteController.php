<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\Publicite;
use ATKS\AdminBundle\Form\PubliciteType;

class PubliciteController extends Controller
{
    public function listAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $premierePublicite = ($page - 1) * 100;
        $totalPublicite = $em->getRepository("ATKSAdminBundle:Publicite")->nbrePublicite();
        $totalPages = ceil(intval($totalPublicite) / 100);
        $publicites = $em
                ->getRepository("ATKSAdminBundle:Publicite")
                ->findBy(array(), array("dateFin" => "DESC"), 100, $premierePublicite);
        return $this->render('ATKSAdminBundle:Publicite:list.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'publicites' => $publicites
        ));
    }
    
    public function ajoutAction() {
        $em = $this->getDoctrine()->getManager();
        $newPublicite = new Publicite();
        $form = $this->createForm(new PubliciteType(), $newPublicite);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($newPublicite);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Publicité créée avec succès');
                return $this->redirect($this->generateUrl('atks_admin_list_publicite'));
            }
        }
        return $this->render('ATKSAdminBundle:Publicite:ajout.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
}
