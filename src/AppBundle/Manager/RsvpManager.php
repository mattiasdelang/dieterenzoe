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
use Twig\Environment;

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
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * RsvpManager constructor.
     * @param EntityManagerInterface $em
     * @param RouterInterface $router
     * @param \Swift_Mailer $mailer
     * @param Environment $twig
     */
    public function __construct(
        EntityManagerInterface $em,
        RouterInterface $router,
        \Swift_Mailer $mailer,
        Environment $twig
    ) {
        $this->em = $em;
        $this->router = $router;
        $this->mailer = $mailer;
        $this->twig = $twig;
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
     * @param Rsvp $rsvp
     *
     * @return string
     */
    public function handleRsvp(Rsvp $rsvp)
    {
        $this->em->persist($rsvp);
        $this->em->flush();

        $this->mail($rsvp);

        return $this->router->generate('rsvp_succes');
    }

    private function mail(Rsvp $rsvp)
    {
        $message = (new \Swift_Message('Dieter en Zoé: RSVP ingevuld'))
            ->setFrom('dieterenzoetrouwen@gmail.com')
            ->setTo('mattiasdelang@gmail.com')
            ->setBody(
                $this->twig->render(
                    'Email/Rsvp_ingevuld.twig',
                    ['rsvp' => $rsvp]
                ),
                'text/html'
            )
        ;

        $this->mailer->send($message);
    }
}