<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Persoon;
use AppBundle\Entity\Rsvp;
use AppBundle\Entity\Verzoeknummer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
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
     * @param Request $request
     * @param Rsvp $rsvp
     *
     * @return string
     */
    public function handleRsvp(Request $request, Rsvp $rsvp)
    {
        $this->em->persist($rsvp);
        $this->em->flush();

        /** @var Session $session */
        $session = $request->getSession();

        $session->getFlashBag()->add('notice', 'Je hebt succesvol je rsvp ingevuld!');

        return $this->router->generate('homepage');
    }
}