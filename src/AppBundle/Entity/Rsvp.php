<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rsvp
 *
 * @ORM\Table(name="rsvp")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RsvpRepository")
 */
class Rsvp
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
     * @var int
     *
     * @ORM\Column(name="aantalPersonen", type="integer")
     */
    private $aantalPersonen = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="emailadres", type="string", length=255)
     */
    private $emailadres;

    /**
     * @var string
     *
     * @ORM\Column(name="vragen", type="text")
     */
    private $vragen;

    /**
     * @var Persoon[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Persoon", mappedBy="rsvp")
     */
    private $personen;
    
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
     * Set aantalPersonen
     *
     * @param integer $aantalPersonen
     *
     * @return Rsvp
     */
    public function setAantalPersonen($aantalPersonen)
    {
        $this->aantalPersonen = $aantalPersonen;

        return $this;
    }

    /**
     * Get aantalPersonen
     *
     * @return int
     */
    public function getAantalPersonen()
    {
        return $this->aantalPersonen;
    }

    /**
     * Set emailadres
     *
     * @param string $emailadres
     *
     * @return Rsvp
     */
    public function setEmailadres($emailadres)
    {
        $this->emailadres = $emailadres;

        return $this;
    }

    /**
     * Get emailadres
     *
     * @return string
     */
    public function getEmailadres()
    {
        return $this->emailadres;
    }

    /**
     * Set vragen
     *
     * @param string $vragen
     *
     * @return Rsvp
     */
    public function setVragen($vragen)
    {
        $this->vragen = $vragen;

        return $this;
    }

    /**
     * Get vragen
     *
     * @return string
     */
    public function getVragen()
    {
        return $this->vragen;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personen = new ArrayCollection();
    }

    /**
     * Add personen
     *
     * @param Persoon $personen
     *
     * @return Rsvp
     */
    public function addPersonen(Persoon $personen)
    {
        $this->personen[] = $personen;
        $personen->setRsvp($this);

        return $this;
    }

    /**
     * Remove personen
     *
     * @param Persoon $personen
     */
    public function removePersonen(Persoon $personen)
    {
        $this->personen->removeElement($personen);
    }

    /**
     * Get personen
     *
     * @return Collection
     */
    public function getPersonen()
    {
        return $this->personen;
    }
}
