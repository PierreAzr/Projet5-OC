<?php

namespace OC\NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recherche
 *
 * @ORM\Table(name="Recherche")
 * @ORM\Entity(repositoryClass="OC\NAOBundle\Repository\RechercheRepository")
 */
class Recherche
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="espece", type="string", length=255)
     */
    private $espece;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set espece
     *
     * @param string $espece
     *
     * @return recherche
     */
    public function setEspece($espece)
    {
        $this->espece = $espece;

        return $this;
    }

    /**
     * Get espece
     *
     * @return string
     */
    public function getEspece()
    {
        return $this->espece;
    }
}
