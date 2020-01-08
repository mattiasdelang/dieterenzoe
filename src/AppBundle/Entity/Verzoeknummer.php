<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Verzoeknummer
 *
 * @ORM\Table(name="verzoeknummer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VerzoeknummerRepository")
 */
class Verzoeknummer
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
     * @ORM\Column(name="nummer", type="text", nullable=true)
     */
    private $nummer;

    /**
     * @var Persoon
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persoon", inversedBy="nummers")
     * @ORM\JoinColumn(name="persoon_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $persoon;

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
     * Set nummer
     *
     * @param string $nummer
     *
     * @return Verzoeknummer
     */
    public function setNummer($nummer)
    {
        $this->nummer = $nummer;

        return $this;
    }

    /**
     * Get nummer
     *
     * @return string
     */
    public function getNummer()
    {
        return $this->nummer;
    }

    /**
     * Set persoon
     *
     * @param Persoon $persoon
     *
     * @return Verzoeknummer
     */
    public function setPersoon(Persoon $persoon = null)
    {
        $this->persoon = $persoon;

        return $this;
    }

    /**
     * Get persoon
     *
     * @return Persoon
     */
    public function getPersoon()
    {
        return $this->persoon;
    }
}
