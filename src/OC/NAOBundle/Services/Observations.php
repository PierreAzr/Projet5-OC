<?php

namespace OC\NAOBundle\Services;

/**
 *
 */
class Observations
{

  public function observation($user, $observation)
  {
    if ($user->hasRole('ROLE_ADMIN') OR $user->hasRole('ROLE_NATURALIST')) {
      $observation->setStatus(true);
      $observation->setUserValidator($user);
    } else {
      $observation->setStatus(false);
      $observation->setUserValidator(null);
    }
    $date = new \DateTime();
    $same = false;
    $observation->setDatetime($date);
    $observation->setUser($user);
    $observation->setNotconforme(false);

    if ($observation->getPicture() != null) {
      $file = $observation->getPicture()->getImage();

      $fileName = md5(uniqid()).'.'.$file->guessExtension();

      $dimension = getimagesize($file);
      if ($dimension[0]>951) {
        $max = 951;
        $reduc=$max/$dimension[0];
        $coef_l=$max;
        $coef_h=$dimension[1]*$reduc;
        $chemin = imagecreatefromjpeg($file);
        $nouvelle = imagecreatetruecolor ($coef_l, $coef_h);
        imagecopyresampled($nouvelle,$chemin,0,0,0,0,$coef_l,$coef_h,$dimension[0],$dimension[1]);
        imagejpeg($nouvelle,$fileName);
      } else {
        $chemin = imagecreatefromjpeg($file);
        imagejpeg($chemin,$fileName);
      }

      rename($fileName, 'uploads/picture/' . $fileName);

      $picture = $observation->getPicture()->setImage($fileName);
      $observation->setPicture($picture);
    }

    return $observation;
  }

  public function same($em, $taxrefname)
  {
    $same = false;
    //Ajout securité si le nom d'oiseau rentré correspond a une espece d'oiseau dans la base de données TAXREF
    if (strlen($taxrefname) > 0) {
      $listeEspece = $em->getRepository('OCNAOBundle:Taxref')->listeEspece($taxrefname);
      for ($i=0; $i < sizeof($listeEspece) ; $i++) {
        $espece = $listeEspece[$i]['nomVern'];
        if ( trim($espece) === trim($taxrefname)) { //si espece du formulaire = espece dans la BDD TAXREF
          $same = true;
        }
      }
    } else {
      $same = false;
    }
    return $same;
  }
}
