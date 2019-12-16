<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Persoon
 *
 * @ORM\Table(name="persoon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersoonRepository")
 */
class Persoon
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
     * @ORM\Column(name="naam", type="string", length=255)
     * @Assert\NotBlank(groups={"aanmaken"})
     */
    private $naam;

    /**
     * @var Rsvp
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rsvp", inversedBy="personen")
     * @ORM\JoinColumn(name="rsvp_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $rsvp;

    /**
     * @var Verzoeknummer[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Verzoeknummer", mappedBy="persoon", cascade={"persist"}, orphanRemoval=true)
     */
    private $nummers;

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
     * Set naam
     *
     * @param string $naam
     *
     * @return Persoon
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nummers = new ArrayCollection();
    }

    /**
     * Set rsvp
     *
     * @param Rsvp $rsvp
     *
     * @return Persoon
     */
    public function setRsvp(Rsvp $rsvp = null)
    {
        $this->rsvp = $rsvp;

        return $this;
    }

    /**
     * Get rsvp
     *
     * @return Rsvp
     */
    public function getRsvp()
    {
        return $this->rsvp;
    }

    /**
     * Add nummer
     *
     * @param Verzoeknummer $nummer
     *
     * @return Persoon
     */
    public function addNummer(Verzoeknummer $nummer)
    {
        $this->nummers[] = $nummer;
        $nummer->setPersoon($this);

        return $this;
    }

    /**
     * Remove nummer
     *
     * @param Verzoeknummer $nummer
     */
    public function removeNummer(Verzoeknummer $nummer)
    {
        $this->nummers->removeElement($nummer);
    }

    /**
     * Get nummers
     *
     * @return Collection
     */
    public function getNummers()
    {
        return $this->nummers;
    }
}
