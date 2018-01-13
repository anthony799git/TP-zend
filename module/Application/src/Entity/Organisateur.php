<?php

declare(strict_types=1);
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * Class Organisateur
 *
 * Attention : Doctrine génère des classes proxy qui étendent les entités, celles-ci ne peuvent donc pas être finales !
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Application\Repository\OrganisateurRepository")
 * @ORM\Table(name="organisateurs")
 */
class Organisateur
{
    /**
    * @ORM\Id
    * @ORM\Column(type="guid",nullable=false)
    * @ORM\GeneratedValue(strategy="UUID")
    **/
    private $id;
    /**
    * @ORM\Column(type="string", length=255, nullable=false)
    */
    private $nom;
    /**
    * @ORM\Column(type="string", length=255, nullable=false)
    */
    private $prenom;
    /**
    * One Organisateur has Many Meetups.
    * @ORM\OneToMany(targetEntity="Meetup", mappedBy="organisateur")
    */
    private $meetups;
   

    public function __construct($nom,$prenom)
    {
        $this->nom = $nom;
        $this->description = $description;
        $this->meetups = new ArrayCollection();
    }
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
    * Set Nom
    *
    * @param string $nom
    *
    * @return Organisateur
    */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
    * Get Nom
    *
    * @return string
    */
    public function getNom()
    {
        return $this->nom;
    }

    /**
    * Set Prenom
    *
    * @param string $prenom
    *
    * @return Organisateur
    */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
    * Get Prenom
    *
    * @return string
    */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
    * Add meetup
    *
    * @param \Application\Entity\Meetup $meetup
    *
    * @return Organisateur
    */
    public function addMeetup(\Application\Entity\Meetup $meetup)
    {
        $this->meetups[] = $meetup;

        return $this;
    }

    /**
    * Remove meetup
    *
    * @param \Application\Entity\Meetup $meetup
    */
    public function removeMeetup(\Application\Entity\Meetup $meetup)
    {
        $this->meetups->removeElement($meetup);
    }

    /**
    * Get meetups
    *
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getMeetups()
    {
        return $this->meetups;
    }

    public function __toString()
    {
        return (string) $this->getNom().' '.$this->getPrenom();
    }
}
