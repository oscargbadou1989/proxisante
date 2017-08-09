<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ATKS\AdminBundle\Entity\Hopital;
use ATKS\AdminBundle\Form\HopitalType;

class BotMessengerController extends Controller {

  public function fbUsersAction($page) {
    $em = $this->getDoctrine()->getManager();
    $premierUser = ($page - 1) * 100;
    $totalUser = $em->getRepository("ATKSAdminBundle:FbUser")->nbreUser();
    $totalPages = ceil(intval($totalUser) / 100);
    $users = $em->getRepository("ATKSAdminBundle:FbUser")
    ->findBy(array(), array("id" => "DESC"), 100, $premierUser);
    return $this->render('ATKSAdminBundle:BotMessenger:fb_users.html.twig', array(
      'page' => $page,
      'nbrTotalPages' => $totalPages,
      'users' => $users
    ));
  }

  public function fbMessageAction($page) {
    $em = $this->getDoctrine()->getManager();
    $premierMesage = ($page - 1) * 100;
    $totalMessage = $em->getRepository("ATKSAdminBundle:FbMessage")->nbreMessage();
    $totalPages = ceil(intval($totalMessage) / 100);
    $messages = $em->getRepository("ATKSAdminBundle:FbMessage")
    ->findBy(array(), array("id" => "DESC"), 100, $premierMesage);
    return $this->render('ATKSAdminBundle:BotMessenger:fb_message.html.twig', array(
      'page' => $page,
      'nbrTotalPages' => $totalPages,
      'messages' => $messages
    ));
  }

  public function fbInterrogatoireAction($page) {
    $em = $this->getDoctrine()->getManager();
    $premierInterrogatoire = ($page - 1) * 100;
    $totalInterrogatoire = $em->getRepository("ATKSAdminBundle:FbInterrogatoire")->nbreInterrogatoire();
    $totalPages = ceil(intval($totalInterrogatoire) / 100);
    $interrogatoires = $em->getRepository("ATKSAdminBundle:FbInterrogatoire")
    ->findBy(array(), array("id" => "DESC"), 100, $premierInterrogatoire);
    return $this->render('ATKSAdminBundle:BotMessenger:fb_interrogatoire.html.twig', array(
      'page' => $page,
      'nbrTotalPages' => $totalPages,
      'interrogatoires' => $interrogatoires
    ));
  }


}
