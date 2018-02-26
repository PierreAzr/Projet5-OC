<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use OC\UserBundle\Entity\User;
use OC\UserBundle\Entity\Observation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfilController extends Controller
{

    // affiche les paramètres de l'utilisateur
    /**
     *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
     */
    public function ParameterAction()
    {
      $user = $this->getUser();
      $role = $user->getRoles()[0];
      switch ($role) {
        case 'ROLE_OBSERVER':
          $rolename = 'Observateur';
          break;
        case 'ROLE_NATURALIST':
          $rolename = 'Naturaliste';
          break;
        case 'ROLE_ADMIN':
          $rolename = 'Administrateur';
          break;
      }

        return $this->render('OCNAOBundle:Profil:parameter.html.twig', array(
            'user' => $user,
            'rolename' => $rolename,
          ));;
    }

    //gestion des utilisateurs
    /**
     *@Security("has_role('ROLE_ADMIN')")
     */
    public function UsersAction(Request $request){

        $defaultData = array('message' => '');
        $form = $this->createFormBuilder($defaultData)
                 ->add('name', TextType::class)
                 ->add('submit', SubmitType::class)
                 ->getForm();

       $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {

            $userManager = $this->get('fos_user.user_manager');//recuperre le service

            $data = $form->getData()['name'];

            $user = $userManager->findUserBy(array('username' => $data));
            if ( $user == null) {
             $user = $userManager->findUserBy(array('email' => $data));
            }

              if (!$user == null) {
                $role = $user->getRoles()[0];

                switch ($role) {
                  case 'ROLE_OBSERVER':
                    $rolename = 'Observateur';
                    break;
                  case 'ROLE_NATURALIST':
                    $rolename = 'Naturaliste';
                    break;
                  case 'ROLE_ADMIN':
                    $rolename = 'Administrateur';
                    break;
                }

                return $this->render('OCNAOBundle:Profil:users.html.twig', array(
                    'user' => $user,
                    'result' => true,
                    'rolename' => $rolename,
                  ));
              }else {
                $this->addFlash('success', "L'utilisateur n'existe pas, le peseudo ou l'email son incorrect");
              }

         }


        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('OCUserBundle:User');

         //nombre observateur et naturaliste sur le site
         $countobserver = $repository->getUsersCountByRole("ROLE_OBSERVER");
         $countnaturalist = $repository->getUsersCountByRole("ROLE_NATURALIST");
         // $countadmin = $repository->getUsersCountByRole('ROLE_ADMIN');
         $counttotal = $countobserver + $countnaturalist;


       return $this->render('OCNAOBundle:Profil:users.html.twig', array(
           'form' => $form->createView(),
           'result' => false,
           'nbobserver' => $countobserver,
           'nbnaturalist' => $countnaturalist,
           'nbtotal' => $counttotal,
         ));

    }

    //Pour l'autocompletion du champ recherche utilisateur
    /**
     *@Security("has_role('ROLE_ADMIN')")
     */
    public function userAutoCompAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $username = $request->get('username');

            $em = $this->getDoctrine()->getManager();
            $username = $em->getRepository('OCUserBundle:User')->getUsersList($username);

            $response = new Response(json_encode($username));
            return $response;
        }
    }

    //Pour changer de role
    /**
     *@Security("has_role('ROLE_ADMIN')")
     */
    public function RoleAction(Request $request)
    {

      $username = $request->get('username');
      $role = $request->get('role');

      $userManager = $this->get('fos_user.user_manager');//recuperre le service
      //user ici ce n'est pas l'utilisateur connect mais l'utilisateur qui va obtenir le role
      $user = $userManager->findUserBy(array('username' => $username ));
      $user->setStatus(false);

        switch ($role) {

          case 'ROLE_OBSERVER':
            $user->setRoles(array($role));// enregistre le role
            $this->addFlash('success', "$username, a obtenu le role Observateur");
            break;

          case 'ROLE_NATURALIST':
            $this->addFlash('success', "$username, a obtenu le role Naturaliste, un email lui a était envoyer pour le prevenir");
            $user->setRoles(array($role));// enregistre le role

            //envoi email
            $content = $this->renderView(
              'OCNAOBundle:Contact:emailnatuconf.html.twig',
              array('username' => $username
              ));

            $mailer = $this->container->get('mailer');
            $emailsite = $this->container->getParameter('mail_site');
            $message =  \Swift_Message::newInstance('Changement de statut : Naturaliste | Nos Amis les Oiseaux')
                ->setTo($user->getEmail())
                ->setFrom($emailsite, 'Nos Amis les Oiseaux')
                ->setBody($content, 'text/html')
                ;
            $mailer->send($message);

            break;

          default:
              $this->addFlash('success', "Une erreur est survenu");
              return $this->render('OCNAOBundle:Profil:users.html.twig', array(
                  'user' => $user,
                  'result' => false,
                ));
              break;
        }

        $userManager->updateUser($user);

        switch ($role) {
          case 'ROLE_OBSERVER':
            $rolename = 'Observateur';
            break;
          case 'ROLE_NATURALIST':
            $rolename = 'Naturaliste';
            break;
          case 'ROLE_ADMIN':
            $rolename = 'Administrateur';
            break;
        }
        return $this->render('OCNAOBundle:Profil:users.html.twig', array(
            'user' => $user,
            'result' => true,
            'rolename' => $rolename
          ));
    }

  //demande pour devenir naturaliste
  /**
   *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
   public function ObserverAction()
   {
     $userManager = $this->get('fos_user.user_manager');//recuperre le service
     $user = $this->getUser();
     $user->setStatus(true);
     $userManager->updateUser($user);

     //envoi email oberservateur
      $content = $this->renderView(
        'OCNAOBundle:Contact:emailnatu.html.twig',
        array('username' => $user->getUsername()
        ));


      $useremail = $user->getEmail();
      $username = $user->getUsername();
      $mailer = $this->container->get('mailer');
      $emailsite = $this->container->getParameter('mail_site');

      $usermessage =  \Swift_Message::newInstance('Devenir Naturaliste | Nos Amis les Oiseaux')
        ->setTo($useremail)
        ->setFrom($emailsite, 'Nos Amis les Oiseaux')
        ->setBody($content, 'text/html')
        ;
      $mailer->send($usermessage);


      $messageadmin =  \Swift_Message::newInstance('Demande Naturaliste | Nos Amis les Oiseaux')
        ->setTo($emailsite)
        ->setFrom($this->getParameter('mailer_user'), 'Nos Amis les Oiseaux')
        ->setBody("Adresse mail: $useremail et pseudo: $username du demandeur", 'text/html')
        ;
      $mailer->send($messageadmin);


     $this->addFlash('success', 'La demande est en cours, vous allez recevoir un email détaillant la procédure');
     return $this->redirectToRoute('ocnao_profil_parameter');

   }

   //supression compte
   /**
    *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
    */
   public function removeAction(Request $request)
   {
     $username = $request->get('usernameremove');
     //$userManager = $this->get('fos_user.user_manager');
     $this->addFlash('success', "la supression est desactiver pour le dev");

       if (empty($username)) {
          $user = $this->getUser();
          //$userManager->deleteUser($user);
          $this->addFlash('success', "Votre compte a été supprimé");
          return $this->redirectToRoute('ocnao_homepage');
        }else {
          $this->addFlash('success', "Le compte $username a été supprimé");
          //$userManager->deleteUser($user);
          return $this->redirectToRoute('ocnao_profil_users');
        }
   }

   //s'abonner ou ce désabonner de la newsletter
   /**
    *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
    */
   public function newsletterAction(Request $request)
   {
     $userManager = $this->get('fos_user.user_manager');//recuperre le service
     $news = $request->get('newsletter');
     $user = $this->getUser();

     if ($news == "true") {
       $user->setNewsletter(true);
       $this->addFlash('success', "Vous venez de vous abonner à la newletter, merci.");
     }else {
       $user->setNewsletter(false);
       $this->addFlash('success', "Vous venez de vous désabonner de la newletter.");
     }
      $userManager->updateUser($user);

      return $this->redirectToRoute('ocnao_profil_parameter');
   }
}
