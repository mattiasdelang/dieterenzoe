<?php

namespace AppBundle\Controller;

use AppBundle\Form\RsvpType;
use AppBundle\Manager\RsvpManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RsvpController
{
    /**
     * @var RsvpManager
     */
    private $manager;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * RsvpController constructor.
     * @param RsvpManager $manager
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(RsvpManager $manager, FormFactoryInterface $formFactory)
    {
        $this->manager = $manager;
        $this->formFactory = $formFactory;
    }

    /**
     * @Route("/rsvp", name="rsvp")
     *
     * @Template("Rsvp/Index.twig")
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $rsvp = $this->manager->createRsvp();

        $form = $this->formFactory->create(RsvpType::class, $rsvp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->getClickedButton()) {
            return new RedirectResponse($this->manager->handleRsvp($form, $rsvp));
        }

        return [
            'form' => $form->createView()
        ];
    }
}
