<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use OC\UserBundle\Entity\User;
use OC\UserBundle\Entity\Observation;


class ProfilListController extends Controller
{

  //récupére et affiche la liste des observations selon le status.
  /**
   *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
  public function ListObservationAction($statusobs,$page)
  {
      if ($page < 1) {
        throw $this->createNotFoundException("La page ".$page." n'existe pas.");
      }

    $nbPerPage = 12;
    $user = $this->getUser();

    $em = $this->getDoctrine()->getManager();
    $repository = $em->getRepository('OCNAOBundle:Observation');

    switch ($statusobs) {

      case 'publish':
          //récupére la liste des observations publiée et validée de l'utilisateur
          $observationList = $repository->getUserObservation($user, $page, $nbPerPage);
        break;

      case 'pending':
          if ($user->hasRole('ROLE_OBSERVER')){
              //récupére la liste des observations en attente de validation de l'utilisateur(observateur)
              $observationList = $repository->getUserPendingObservation($user, $page, $nbPerPage);
          }else{
            return $this->redirectToRoute('ocnao_profil_listobs');
          }
        break;

      case 'conform':
          if ($user->hasRole('ROLE_OBSERVER')){
              //récupére la liste des observations non conforme de l'utilisateur(observateur)
              $observationList = $repository->getUserObservationRefuse($user, $page, $nbPerPage);
          }else{
            return $this->redirectToRoute('ocnao_profil_listobs');
          }
        break;

      case 'validate':
          if ($user->hasRole('ROLE_NATURALIST') || $user->hasRole('ROLE_ADMIN')) {
            //récupére est affiche la liste des observations validée par l'utilisateur(naturaliste ou administrateur)
              $observationList = $repository->getUserObservationValidate($user, $page, $nbPerPage);
          }else{
            return $this->redirectToRoute('ocnao_profil_listobs');
          }
        break;

      default:
          return $this->redirectToRoute('ocnao_profil_listobs');
        break;

    }

    // On calcule le nombre total de pages
    $nbPages = ceil(count($observationList) / $nbPerPage);

    // Si la nombre de page egal 0, on retourne qu'il n'y a pas encore observations
    if ( $nbPages == 0) {
      return $this->render('OCNAOBundle:Profil:userobservation.html.twig', array(
        'notobs' => true,
        'statusobs' => $statusobs,
      ));
    }
    // Si la page n'existe pas, on retourne une 404
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
    // On donne toutes les informations nécessaires à la vue
    return $this->render('OCNAOBundle:Profil:userobservation.html.twig', array(
      'observationList' => $observationList,
      'nbPages'     => $nbPages,
      'page'        => $page,
      'statusobs' => $statusobs,
      'notobs' => false,

    ));

  }

  //récupére est affiche la liste des observations en attente de validation par l'utilisateur(naturaliste ou administrateur)
  /**
   *@Security("has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
  public function ObservationAtValidateAction($page)
  {

      if ($page < 1) {
        throw $this->createNotFoundException("La page ".$page." n'existe pas.");
      }

    $nbPerPage = 12;
    $user = $this->getUser();

    $em = $this->getDoctrine()->getManager();
    $repository = $em->getRepository('OCNAOBundle:Observation');
    $observationList = $repository->ObservationAtValidate($user, $page, $nbPerPage);
// dump($observationList);
// exit;
    $nbPages = ceil(count($observationList) / $nbPerPage);

    if ( $nbPages == 0) {
      return $this->render('OCNAOBundle:Profil:userobservation.html.twig', array(
        'notobs' => true,
      ));
    }
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }

    return $this->render('OCNAOBundle:Default:observationatvalidate.html.twig', array(
      'observationList' => $observationList,
      'nbPages'     => $nbPages,
      'page'        => $page,
      'notobs' => false,
    ));
  }


}
