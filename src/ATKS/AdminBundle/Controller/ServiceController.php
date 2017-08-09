<?php

namespace ATKS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ATKS\AdminBundle\Entity\FbUser;
use ATKS\AdminBundle\Entity\FbMessage;
use ATKS\AdminBundle\Entity\FbInterrogatoire;
use ATKS\AdminBundle\Entity\FbUserAsk;
use ATKS\AdminBundle\Utils\Utils;
use Doctrine\ORM\Query\ResultSetMapping;

class ServiceController extends Controller {

  public function testSearchAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $preposition = ['à', 'chez', 'dans', 'de', 'entre', 'jusque', 'hors', 'par', 'pour', 'sans', 'vers'];
    $article = ['le', 'la', 'les', 'des', 'un', 'une'];
    $plainte = $request->get('plainte');
    $plainteArray = explode(' ', trim($plainte));
    $query = '';

    /*if(count($plainteArray)>1){
      $count = 0;
      foreach($plainteArray as $p){
        $count++;

        if(!in_array($p, $preposition) && !in_array($p, $article)){
          if($count == 1){
            $query .= ' OR (p.plainte LIKE \'%'.$p.'%\'';
          }elseif($count == count($plainteArray)){
            $query .= 'AND p.plainte LIKE \'%'.$p.'%\')';
          }else{
            $query .= 'AND p.plainte LIKE \'%'.$p.'%\'';
          }
        }
      }
    }*/

    //die(dump('p.plainte LIKE :plainte'.$query));
    /*$plaintes = $em->getRepository('ATKSAdminBundle:Plainte')
    ->createQueryBuilder('p')
    //->where('p.plainte LIKE :plainte'.$query)
    ->where('p.plainte LIKE :plainte')
    ->setParameter("plainte", '%' . $plainte . '%')
    ->getQuery()
    ->getResult();*/

    /*$plaintes = $em->getRepository('ATKSAdminBundle:Plainte')
    ->createQueryBuilder('p')
    ->addSelect("MATCH_AGAINST (p.plainte, p.description, :searchterm 'IN NATURAL MODE') as score")
    ->add('where', 'MATCH_AGAINST(p.plainte, p.description, :searchterm) > 0.8')
    ->setParameter('searchterm', $plainte)
    ->orderBy('score', 'desc')
    ->getQuery()
    ->getResult();*/

    $RAW_QUERY = 'SELECT * FROM plainte WHERE MATCH(plainte, description) AGAINST('.'\''.$plainte.'\''.' IN NATURAL LANGUAGE MODE)';

    $statement = $em->getConnection()->prepare($RAW_QUERY);
    $statement->execute();

    $result = $statement->fetchAll();
    dump($RAW_QUERY);
    die(dump($result));
    $result = array();
    foreach($plaintes as $p){
      $result[] = array(
        'id'=>$p->getId(),
        'plainte'=>$p->getPlainte()
      );
    }
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->headers->set('Content-Type', 'application/json');
    $response->setContent(Utils::jsonRemoveUnicodeSequences(json_encode($result)));
    return $response;
  }

  public function getSpecialiteOrientationAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $facebookId = $request->get('facebookId');
    $fbUser = $em->getRepository('ATKSAdminBundle:FbUser')->findOneByFacebookId($facebookId);
    $oldInterrogatoire = $em->getRepository('ATKSAdminBundle:FbInterrogatoire')->findBy(array('fbUser'=>$fbUser, 'closed'=>true), array('id'=>'DESC'));
    $result = array();
    if($oldInterrogatoire){
      $plainte = $oldInterrogatoire[0]->getPlainte();
      if(trim($plainte) != ""){
        $plaintes = $em->getRepository('ATKSAdminBundle:Plainte')
        ->createQueryBuilder('p')
        ->where('p.plainte LIKE :plainte')
        ->setParameter("plainte", '%' . $plainte . '%')
        ->getQuery()
        ->getResult();

        foreach($plaintes as $p){
          $result[] = $p->getService()->getNom();
        }
      }
    }
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent(Utils::jsonRemoveUnicodeSequences(json_encode($result)));
    return $response;
  }

  public function getOrientationAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $lat = $request->get('lat');
    $lon = $request->get('lon');
    $rayon = $request->get('rayon');
    $facebookId = $request->get('facebookId');
    $fbUser = $em->getRepository('ATKSAdminBundle:FbUser')->findOneByFacebookId($facebookId);
    $oldInterrogatoire = $em->getRepository('ATKSAdminBundle:FbInterrogatoire')->findBy(array('fbUser'=>$fbUser, 'closed'=>true), array('id'=>'DESC'));
    $result = array();
    if($oldInterrogatoire){
      $plainte = $oldInterrogatoire[0]->getPlainte();
      if(trim($plainte) != ""){
        $plaintes = $em->getRepository('ATKSAdminBundle:Plainte')
        ->createQueryBuilder('p')
        ->where('p.plainte LIKE :plainte')
        ->setParameter("plainte", '%' . $plainte . '%')
        ->getQuery()
        ->getResult();

        foreach($plaintes as $p){
          $hopitauxService = $em->getRepository('ATKSAdminBundle:HopitalService')->findByService($p->getService());
          $hopitauxProche = $this->get('proxi_sante_service')->recherche2($hopitauxService, $lat, $lon, $rayon);
          $result = array_merge($result, $hopitauxProche);
        }
      }
    }
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent(Utils::jsonRemoveUnicodeSequences(json_encode($result)));
    return $response;
  }

  public function saveInterrogatoireAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $facebookId = $request->get('facebookId');
    $response = new Response();
    $fbUser = $em->getRepository('ATKSAdminBundle:FbUser')->findOneByFacebookId($facebookId);
    if($request->get('age')){
      $fbUser->setAge($request->get('age'));
    }
    if($request->get('profession')){
      $fbUser->setProfession($request->get('profession'));
    }
    if($request->get('adresse')){
      $fbUser->setAdresse($request->get('adresse'));
    }
    if($request->get('plainte')){
      $oldInterrogatoire = $em->getRepository('ATKSAdminBundle:FbInterrogatoire')->findBy(array('fbUser'=>$fbUser, 'closed'=>false), array('id'=>'DESC'));
      if($oldInterrogatoire){
        $oldInterrogatoire[0]->setPlainte($request->get('plainte'));
      }
    }
    if($request->get('debut')){
      $oldInterrogatoire = $em->getRepository('ATKSAdminBundle:FbInterrogatoire')->findBy(array('fbUser'=>$fbUser, 'closed'=>false), array('id'=>'DESC'));
      if($oldInterrogatoire){
        $oldInterrogatoire[0]->setDebut($request->get('debut'));
      }
    }
    if($request->get('detail')){
      $oldInterrogatoire = $em->getRepository('ATKSAdminBundle:FbInterrogatoire')->findBy(array('fbUser'=>$fbUser, 'closed'=>false), array('id'=>'DESC'));
      if($oldInterrogatoire){
        $oldInterrogatoire[0]->setDetail($request->get('detail'));
        $oldInterrogatoire[0]->setClosed(true);
      }
    }
    $em->flush();
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent('SUCCESS');
    return $response;
  }

  public function initInterrogatoireAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $facebookId = $request->get('facebookId');
    $response = new Response();
    $fbUser = $em->getRepository('ATKSAdminBundle:FbUser')->findOneByFacebookId($facebookId);
    $oldInterrogatoire = null;
    if($fbUser){
      $oldInterrogatoire = $em->getRepository('ATKSAdminBundle:FbInterrogatoire')->findByFbUser($fbUser);
      $interrogatoire = new FbInterrogatoire();
      $interrogatoire->setFbUser($fbUser);
      $em->persist($interrogatoire);
      $em->flush();
    }
    if(!$oldInterrogatoire || ($oldInterrogatoire && !$fbUser->getAge())){
      $response->setContent('FALSE');
    }else{
      $response->setContent('TRUE');
    }
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));

    return $response;
  }

  public function getLastQuestionAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $response = new Response();
    $facebookId = $request->get('facebookId');
    $fbUser = $em->getRepository('ATKSAdminBundle:FbUser')->findOneByFacebookId($facebookId);
    $lastQuestion = $em->getRepository('ATKSAdminBundle:FbUserAsk')->findBy(array('fbUser'=>$fbUser), array('id'=>'DESC'));
    $result = array();
    if($lastQuestion){
      $result = array(
        'type'=>$lastQuestion[0]->getType(),
        'question'=>$lastQuestion[0]->getQuestion()
      );
    }
    $response->setContent(json_encode($result));
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    return $response;
  }

  public function addFbUserQuestionAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $facebookId = $request->get('facebookId');
    $fbUser = $em->getRepository('ATKSAdminBundle:FbUser')->findOneByFacebookId($facebookId);
    $question = $request->get('question');
    $type = $request->get('type');
    $fbUserAsk = new FbUserAsk();
    $fbUserAsk->setFbUser($fbUser)
    ->setQuestion($question)
    ->setType($type);
    $em->persist($fbUserAsk);
    $em->flush();
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent('SUCCESS');
    return $response;
  }

  public function addFbUserMsgAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $facebookId = $request->get('facebookId');
    $fbUser = $em->getRepository('ATKSAdminBundle:FbUser')->findOneByFacebookId($facebookId);
    $message = $request->get('message');
    $fbMessage = new FbMessage();
    $fbMessage->setFbUser($fbUser)
    ->setMessage($message);
    $em->persist($fbMessage);
    $em->flush();
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent('SUCCESS');
    return $response;
  }

  public function addFbUserAction(Request $request){
    $em = $this->getDoctrine()->getManager();
    $facebookId = $request->get('facebookId');
    $firstname = $request->get('firstname');
    $lastname = $request->get('lastname');
    $sexe = $request->get('gender');
    $photoProfil = $request->get('photoProfil');
    $oldObUser = $em->getRepository('ATKSAdminBundle:FbUser')->findOneByFacebookId($facebookId);
    if(!$oldObUser){
      $fbUser = new FbUser();
      $fbUser->setFirstname($firstname)
      ->setLastname($lastname)
      ->setSexe($sexe)
      ->setFacebookId($facebookId)
      ->setPhotoProfil($photoProfil);
      $em->persist($fbUser);
      $em->flush();
    }
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent('SUCCESS');
    return $response;
  }

  public function hopitauxLesPlusProcheAction() {
    $request = $this->getRequest();
    $userLat = $request->get("userLat");
    $userLon = $request->get("userLon");
    $rayon = $request->get("rayon");
    $hopitauxLesPlusProches = $this->get('proxi_sante_service')->hopitauxLesPlusProche($userLat, $userLon, $rayon);
    if ($hopitauxLesPlusProches === null) {
      $hopitauxLesPlusProches = "[]";
    }
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent($hopitauxLesPlusProches);
    return $response;
  }

  public function pharmaciesLesPlusProcheAction() {
    $request = $this->getRequest();
    $userLat = $request->get("userLat");
    $userLon = $request->get("userLon");
    $rayon = $request->get("rayon");
    $pharmaciesLesPlusProches = $this->get('proxi_sante_service')->pharmaciesLesPlusProche($userLat, $userLon, $rayon);
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent($pharmaciesLesPlusProches);
    return $response;
  }

  public function detailHopitalAction() {
    $request = $this->getRequest();
    $id = $request->get("id");
    $detailHopital = $this->get('proxi_sante_service')->detailHopital($id);
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent($detailHopital);
    return $response;
  }

  public function detailPharmacieAction() {
    $request = $this->getRequest();
    $id = $request->get("id");
    $detailPharmacie = $this->get('proxi_sante_service')->detailPharmacie($id);
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent($detailPharmacie);
    return $response;
  }

  public function detailServiceSanteAction() {
    $request = $this->getRequest();
    $id = $request->get("id");
    $detailServiceSante = $this->get('proxi_sante_service')->detailServiceSante($id);
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent($detailServiceSante);
    return $response;
  }

  public function rechercheAction() {
    $request = $this->getRequest();
    $query = $request->get("query");
    $userLat = $request->get("userLat");
    $userLon = $request->get("userLon");
    $rayon = $request->get("rayon");
    $detailPharmacie = $this->get('proxi_sante_service')->recherche($query, $userLat, $userLon, $rayon);
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent($detailPharmacie);
    return $response;
  }

  public function servicesAction() {
    $services = $this->get('proxi_sante_service')->services();
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent($services);
    return $response;
  }

  public function soumissionProblemeAction() {
    $request = $this->getRequest();
    $numeroUser = $request->get("numeroUser");
    $idPhoneUser = $request->get("idPhoneUser");
    $contenu = $request->get("contenu");
    $this->get("proxi_sante_service")->soumissionProbleme($numeroUser, $idPhoneUser, $contenu);
    return new Response('', 204, array('Access-Control-Allow-Origin' => '*'));
  }

  public function connexionAction() {
    $request = $this->getRequest();
    $plateforme = $request->get("plateforme");
    $idPhoneUser = $request->get("idPhoneUser");
    $version = $request->get("version");
    $this->get("proxi_sante_service")->connexion($idPhoneUser, $plateforme, $version);
    return new Response('', 204, array('Access-Control-Allow-Origin' => '*'));
  }

  public function publiciteAction() {
    $publicites = $this->get('proxi_sante_service')->publicite();
    $response = new Response();
    $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
    $response->setContent($publicites);
    return $response;
  }

}
