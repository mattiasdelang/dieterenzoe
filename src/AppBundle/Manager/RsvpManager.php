<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Persoon;
use AppBundle\Entity\Rsvp;
use AppBundle\Entity\Verzoeknummer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\RouterInterface;

class RsvpManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * RsvpManager constructor.
     * @param EntityManagerInterface $em
     * @param RouterInterface $router
     */
    public function __construct(EntityManagerInterface $em, RouterInterface $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    /**
     * @return Rsvp
     */
    public function createRsvp()
    {
        $rsvp = new Rsvp();
        $persoon = new Persoon();

        $nummer1 = new Verzoeknummer();
        $nummer2 = new Verzoeknummer();

        $rsvp->addPersonen($persoon);
        $persoon->addNummer($nummer1);
        $persoon->addNummer($nummer2);

        return $rsvp;
    }

    /**
     * @param FormInterface $form
     * @param Rsvp $rsvp
     *
     * @return string
     */
    public function handleRsvp(FormInterface $form, Rsvp $rsvp)
    {
        $knopNaam = $form->getClickedButton()->getName();

        return $this->$knopNaam($rsvp);
    }

    /**
     * @param Rsvp $rsvp
     *
     * @return string
     */
    private function opslaan(Rsvp $rsvp)
    {
        $this->em->persist($rsvp);
        $this->em->flush();

        return $this->router->generate('homepage');
    }
}