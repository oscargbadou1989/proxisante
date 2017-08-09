<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\Plainte;
use ATKS\AdminBundle\Form\PlainteType;
use Symfony\Component\HttpFoundation\Request;

class PlainteController extends Controller {

  public function ajoutAction(Request $request) {
    $em = $this->getDoctrine()->getManager();
    $plaintes  = $em->getRepository('ATKSAdminBundle:Plainte')->findAll();
    $newPlainte = new Plainte();
    $form = $this->createForm(new PlainteType(), $newPlainte);
    if ($request->getMethod() == 'POST') {
      $form->bind($request);
      if ($form->isValid()) {
        $newPlainte->setDescription($newPlainte->getPlainte());
        $em->persist($newPlainte);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Plainte ajoute avec succes');
        return $this->redirect($this->generateUrl('atks_admin_ajout_plainte'));
      }
    }
    return $this->render('ATKSAdminBundle:Plainte:ajout.html.twig', array(
      'form' => $form->createView(),
      'plaintes'=>$plaintes
    ));
  }
}
