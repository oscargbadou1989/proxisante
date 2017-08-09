<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProblemeController extends Controller {

    public function listAction($page) {
        $em = $this->getDoctrine()->getManager();
        $premierProbleme = ($page - 1) * 100;
        $totalProbleme = $em->getRepository("ATKSAdminBundle:Probleme")->nbreProbleme();
        $totalPages = ceil(intval($totalProbleme) / 100);
        $problemes = $em
                ->getRepository("ATKSAdminBundle:Probleme")
                ->findBy(array(), array("dateSoumission" => "DESC"), 100, $premierProbleme);
        return $this->render('ATKSAdminBundle:Probleme:list.html.twig', array(
                    'page' => $page,
                    'nbrTotalPages' => $totalPages,
                    'totalProbleme' => $totalProbleme,
                    'problemes' => $problemes
        ));
    }
    
    public function marquerToutVuAction(){
        $em = $this->getDoctrine()->getManager();
        $problemesNonVu = $em
                ->getRepository("ATKSAdminBundle:Probleme")
                ->findBy(array("vue"=>false), array());
        foreach($problemesNonVu as $p){
            $p->setVue(true);
        }
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_probleme'));
    }
    
    public function marquerVueAction($id){
        $em = $this->getDoctrine()
                ->getManager();
        $probleme = $em->getRepository("ATKSAdminBundle:Probleme")->find($id);
        if($probleme->getVue()==true){
            $probleme->setVue(false);
        }else{
            $probleme->setVue(true);
        }
        $em->persist($probleme);
        $em->flush();
        return $this->redirect($this->generateUrl('atks_admin_list_probleme'));
    }

    public function supprimerAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $probleme = $em->getRepository("ATKSAdminBundle:Probleme")
                ->find($id);
        if ($probleme === null) {
            throw $this->createNotFoundException('Ce probleme n\'existe pas');
        }
        $em->remove($probleme);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Problème supprimé avec succès');
        return $this->redirect($this->generateUrl('atks_admin_list_probleme'));
    }
}
