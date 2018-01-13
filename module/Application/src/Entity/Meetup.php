<?php

declare(strict_types=1);
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class Meetup
 *
 * Attention : Doctrine génère des classes proxy qui étendent les entités, celles-ci ne peuvent donc pas être finales !
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Application\Repository\MeetupRepository")
 * @ORM\Table(name="meetups")
 */
class Meetup
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="UUID")
    * @ORM\Column(type="string", length=36, nullable=false)
    **/
    private $id;
    /**
    * @ORM\Column(type="string", length=255, nullable=false)
    */
    private $title;
    /**
    * @ORM\Column(type="string", length=2000, nullable=false)
    */
    private $description;

    /**
    * @ORM\Column(type="datetime",nullable=false)
    */
    private $date_start;
    /**
    * @ORM\Column(type="datetime",nullable=false)
    */
    private $date_end;

    /**
    * @ORM\ManyToOne(targetEntity="Organisateur", inversedBy="meetups")
    * @ORM\JoinColumn(name="organisateur_id", referencedColumnName="id")
    */
     private $organisateur;


    /**
    * Get id
    *
    * @return string
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Set Title
    *
    * @param string $title
    *
    * @return Meetup
    */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
    * Get Title
    *
    * @return string
    */
    public function getTitle()
    {
        return $this->title;
    }

    /**
    * Set description
    *
    * @param string $description
    *
    * @return Meetup
    */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
    * Get description
    *
    * @return string
    */
    public function getDescription()
    {
        return $this->description;
    }

    /**
    * Set dateStart
    *
    * @param \DateTime $dateStart
    *
    * @return Meetup
    */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;

        return $this;
    }

    /**
    * Get dateStart
    *
    * @return \DateTime
    */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
    * Set dateEnd
    *
    * @param \DateTime $dateEnd
    *
    * @return Meetup
    */
    public function setDateEnd($dateEnd)
    {
        $this->date_end = $dateEnd;

        return $this;
    }

    /**
    * Get dateEnd
    *
    * @return \DateTime
    */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
    * Set organisateur
    *
    * @param \Application\Entity\Organisateur $organisateur
    *
    * @return Meetup
    */
    public function setOrganisateur(\Application\Entity\Organisateur $organisateur = null)
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
    * Get organisateur
    *
    * @return \Application\Entity\Organisateur
    */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

}
