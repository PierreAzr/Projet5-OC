<?php

namespace OC\NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Observation
 *
 * @ORM\Table(name="observation")
 * @ORM\Entity(repositoryClass="OC\NAOBundle\Repository\ObservationRepository")
 */
class Observation
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
  	 *
  	 * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User")
  	 * @ORM\JoinColumn(nullable=false)
  	 *
  	 */
  	private $user;

    /**
  	 *
  	 * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User")
  	 * @ORM\JoinColumn(name="uservalidator", nullable=true)
  	 *
  	 */
  	private $uservalidator;

    //Ancien parametres
    // @ORM\ManyToOne(targetEntity="OC\NAOBundle\Entity\Taxref")
    // @ORM\JoinColumn(name="taxrefname", referencedColumnName="CD_NOM")

    /**
     * @ORM\Column(name="taxrefname", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $taxrefname;

    /**
     * @var bool
     *
     * @ORM\Column(name="notsur", type="boolean")
     */
    private $notsur;

    /**
     * @ORM\OneToOne(targetEntity="OC\NAOBundle\Entity\Picture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="picture", referencedColumnName="id")
     * @Assert\Valid()
     */
    private $picture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime")
     * @Assert\DateTime()
     */
    private $datetime;

    /**
     * @var date
     *
     * @ORM\Column(name="date_Obs", type="date")
     * @Assert\DateTime()
     */
    private $dateObs;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $longitude;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="notconforme", type="boolean", nullable=false)
     */
    private $notconforme;

    /**
     * @var string
     *
     * @ORM\Column(name="notconformetext", type="string", length=255, nullable=true)
     */
    private $notconformetext;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set taxrefname
     *
     * @param string $taxrefname
     *
     * @return Observation
     */
    public function setTaxrefname($taxrefname)
    {
        $this->taxrefname = $taxrefname;

        return $this;
    }

    /**
     * Get taxrefname
     *
     * @return string
     */
    public function getTaxrefname()
    {
        return $this->taxrefname;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Observation
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set dateObs
     *
     * @param date $dateObs
     *
     * @return Observation
     */
    public function setDateObs($dateObs)
    {
        $this->dateObs = $dateObs;

        return $this;
    }

    /**
     * Get dateObs
     *
     * @return date
     */
    public function getDateObs()
    {
        return $this->dateObs;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Observation
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Observation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Observation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set notconforme
     *
     * @param boolean $notconforme
     *
     * @return Observation
     */
    public function setNotconforme($notconforme)
    {
        $this->notconforme = $notconforme;

        return $this;
    }

    /**
     * Get notconforme
     *
     * @return boolean
     */
    public function getNotconforme()
    {
        return $this->notconforme;
    }

    /**
     * Set notconformetext
     *
     * @param string $notconformetext
     *
     * @return Observation
     */
    public function setNotconformetext($notconformetext)
    {
        $this->notconformetext = $notconformetext;

        return $this;
    }

    /**
     * Get notconformetext
     *
     * @return string
     */
    public function getNotconformetext()
    {
        return $this->notconformetext;
    }

    /**
     * Set user
     *
     * @param \OC\UserBundle\Entity\User $user
     *
     * @return Observation
     */
    public function setUser(\OC\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \OC\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set uservalidator
     *
     * @param \OC\UserBundle\Entity\User $uservalidator
     *
     * @return Observation
     */
    public function setUserValidator(\OC\UserBundle\Entity\User $uservalidator = null)
    {
        $this->uservalidator = $uservalidator;

        return $this;
    }

    /**
     * Get uservalidator
     *
     * @return \OC\UserBundle\Entity\User
     */
    public function getUserValidator()
    {
        return $this->uservalidator;
    }

    /**
     * Set picture
     *
     * @param \OC\NAOBundle\Entity\Picture $picture
     *
     * @return Observation
     */
    public function setPicture(\OC\NAOBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \OC\NAOBundle\Entity\Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set notsur
     *
     * @param bool $notsur
     *
     * @return Observation
     */
    public function setNotsur($notsur)
    {
        $this->notsur = $notsur;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getNotsur()
    {
        return $this->notsur;
    }
}
