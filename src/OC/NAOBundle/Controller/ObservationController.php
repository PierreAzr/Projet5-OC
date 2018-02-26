<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use OC\NAOBundle\Entity\Observation;
use OC\NAOBundle\Entity\Picture;
use OC\NAOBundle\Entity\Recherche;
use OC\NAOBundle\Form\ObservationType;
use OC\NAOBundle\Form\RechercheType;

use web\assets\images;

class ObservationController extends Controller
{
  //Fonction permettant l'ajout d'observation
  public function addObservationAction(Request $request)
  {

  if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
    $this->addFlash('success', 'Vous devez être connecté pour acceder à cette partie du site');
    throw new AccessDeniedException('Accès limité aux utilisateur.');
  }
    $observation = new Observation();
    $form = $this->createForm(ObservationType::class, $observation);

    $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser(); //Recuperation de l'utilisateur

        $observations = $this->container->get('ocnao.observations'); //Utilisation du services ocnao.observations

        $observation = $observations->observation($user, $observation); //Utilisation fonction observation du service

        $taxrefname = $observation->getTaxrefname();
        $same = $observations->same($em, $taxrefname); //Utilisation fonction same du service

        if ($same == true) { //Si meme nom d'espece
          if($observation->getStatus() == true) {
            $this->addFlash('success', 'Votre observation à été publiée.');
          }else {
            $this->addFlash('success', 'Votre observation à été envoyé, elle sera publiée après validation par un Naturaliste.');
          }
          $em->persist($observation);
          $em->flush();
          return $this->redirectToRoute('ocnao_homepage');
        }
        else { //sinon
          $this->addFlash('success', 'Mauvais nom de l\'espece.');
          return $this->redirectToRoute('ocnao_addObservation');
        }
      }

    return $this->render('OCNAOBundle:Default:addObservation.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function autocompleteAction(Request $request)
  {
      if($request->isXmlHttpRequest())
      {
          $oiseau = $request->get('oiseau');
          $em = $this->getDoctrine()->getManager();
          $listeEspece = $em->getRepository('OCNAOBundle:Taxref')->listeEspece($oiseau);
          $response = new Response(json_encode($listeEspece));
          return $response;
      }
  }


  //Fonction changer le nom de l'espece
  /**
   *@Security("has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
  public function changeTaxrefnameAction($id)
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $taxrefname = $_POST["taxrefname"];
      $em = $this->getDoctrine()->getManager();

      $observations = $this->container->get('ocnao.observations'); //Utilisation du services ocnao.observations
      $same = $observations->same($em, $taxrefname); //Utilisation fonction same du service

      if ($same == true) { //Si meme nom d'espece
        $obs = $em->getRepository('OCNAOBundle:Observation')->validationObservation($id);
        $obs[0]->setTaxrefname($taxrefname);
        $em->persist($obs[0]);
        $em->flush();

        return $this->redirectToRoute('ocnao_observation', ['id'=>$id]);
      }
      else { //sinon
        $this->addFlash('success', 'Mauvais nom de l\'espece.');
        return $this->redirectToRoute('ocnao_observation', ['id'=>$id]);
      }
    }
  }


  //Fonction validation des observations des observateurs
  /**
   *@Security("has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
  public function validateAction($id)
  {
    $user = $this->getUser();
    $em = $this->getDoctrine()->getManager();

    $obs = $em->getRepository('OCNAOBundle:Observation')->validationObservation($id);
    $obs[0]->setStatus(true);
    $obs[0]->setUserValidator($user);

    $em->persist($obs[0]);
    $em->flush();

    $this->addFlash('success', 'Observation validée et publiée.');
    return $this->redirectToRoute('ocnao_homepage');
  }

  //Fonction refusant des observations des observateurs
  /**
   *@Security("has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
  public function notconformeAction($id)
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $user = $this->getUser();
      $content = $_POST["notconformetext"];

      $em = $this->getDoctrine()->getManager();

      $obs = $em->getRepository('OCNAOBundle:Observation')->validationObservation($id);
      $obs[0]->setNotconforme(true);
      $obs[0]->setNotconformetext($content);
      $obs[0]->setUserValidator($user);
      $em->persist($obs[0]);
      $em->flush();

      //envoi email
        $userobs = $obs[0]->getUser();
        $content = $this->renderView(
          'OCNAOBundle:Contact:emailnotconform.html.twig',
          array('username' => $userobs,
                'content' => $content,
                'nomespece' => $obs[0]->getTaxrefname(),
                'date' => $obs[0]->getDateObs(),
          ));

        $mailer = $this->container->get('mailer');
        $message =  \Swift_Message::newInstance('Observation inexacte | Nos Amis les Oiseaux')
          ->setTo($userobs->getEmail())
          ->setFrom('NAO@exemple.com', 'Nos Amis les Oiseaux')
          ->setBody($content, 'text/html')
          ;

        $mailer->send($message);

      $this->addFlash('success', 'L\'observation à été déclaré non conforme.');
      return $this->redirectToRoute('ocnao_homepage');
    }
  }

  //Fonction permettant la recherche d'observations
  public function rechercheAction(Request $request)
  {
    $recherche = new Recherche();
    $form = $this->createForm(RechercheType::class, $recherche);

    $user = $this->getUser();

    $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $espece = $recherche->getEspece();
        $_SESSION['espece'] = $espece;
        return $this->redirectToRoute('ocnao_results');
      }

    //Derniere observations
    $lastObs = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Observation')->lastObs();

    return $this->render('OCNAOBundle:Default:recherche.html.twig', array(
      'form' => $form->createView(),
      'lastObs' => $lastObs,
      'user' => $user,
    ));
  }

  //Affiche la liste des resultats pour la recherche
  public function resultsAction(Request $request)
  {
    $recherche = new Recherche();
    $form = $this->createForm(RechercheType::class, $recherche);

    $user = null;
    $user = $this->getUser();

    $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $espece = $recherche->getEspece();
        return $this->redirectToRoute('ocnao_results');
      }

    $espece = $_SESSION['espece'];
    $results = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Observation')->listeObsEspece($espece);

    if($results) {
      return $this->render('OCNAOBundle:Default:results.html.twig', array(
        'form' => $form->createView(),
        'results' => $results,
        'user' => $user,
      ));
    }else{
      $this->addFlash('success', 'Aucune observation trouvé pour cette éspèce.');
      return $this->redirectToRoute('ocnao_recherche');
    }
  }

  //Afficher une observation, en fonction de son id
  public function observationAction($id)
  {
    $user = $this->getUser();
    $observation = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Observation')->observation($id);

    $famille = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Taxref')->famille($observation[0]->getTaxrefname());
    $nbObsUser = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Observation')->nbObsUser($observation[0]->getUser()->getId());

    //Si l'observation est publié ou role naturalist ou admin
    if ($user) {
      if ($observation[0]->getStatus() == 1 OR $user->hasRole('ROLE_ADMIN') OR $user->hasRole('ROLE_NATURALIST')) {
        return $this->render('OCNAOBundle:Default:observation.html.twig', array(
          'observation' => $observation,
          'nbObs' => $nbObsUser,
          'famille' => $famille,
          'user' => $user,
        ));
      } else { //redirection pour les observateur qui tente d'acceder a une observation non validé
        $this->addFlash('success', 'L\'observation n\'existe pas');
        return $this->redirectToRoute('ocnao_homepage');
      }
    } else { //redirection pour un visiteur
      if ($observation[0]->getStatus() == 1) {
        $user = null;
        return $this->render('OCNAOBundle:Default:observation.html.twig', array(
          'observation' => $observation,
          'nbObs' => $nbObsUser,
          'famille' => $famille,
          'user' => $user,
        ));
      } else { //redirection pour les observateur qui tente d'acceder a une observation non validé
        $this->addFlash('success', 'L\'observation n\'existe pas');
        return $this->redirectToRoute('ocnao_homepage');
      }
    }
  }
}
