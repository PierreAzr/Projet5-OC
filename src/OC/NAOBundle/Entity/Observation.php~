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


    //Ancien parametres
    // @ORM\ManyToOne(targetEntity="OC\NAOBundle\Entity\Taxref")
    // @ORM\JoinColumn(name="taxrefname", referencedColumnName="CD_NOM")

    /**
     * @ORM\Column(name="taxrefname", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $taxrefname;

    /**
     * @ORM\OneToOne(targetEntity="OC\NAOBundle\Entity\Picture", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="picture", referencedColumnName="id")
     */
    private $picture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     * @Assert\DateTime()
     */
    private $datetime;

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
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     * //@Assert\NotBlank()
     */
    private $status;



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
     * @param string $status
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
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
}
