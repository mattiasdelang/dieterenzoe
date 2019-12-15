<?php

namespace AppBundle\Controller;

use AppBundle\Form\PdfType;
use AppBundle\Manager\PdfManager;
use AppBundle\Model\PdfModel;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PdfController
{
    /**
     * @var PdfManager
     */
    private $manager;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * RsvpController constructor.
     * @param PdfManager $manager
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(PdfManager $manager, FormFactoryInterface $formFactory)
    {
        $this->manager = $manager;
        $this->formFactory = $formFactory;
    }

    /**
     * @Route("/rsvp/pdf", name="rsvp_pdf")
     *
     * @Template("Rsvp/Pdf.twig")
     *
     * @param Request $request
     *
     * @return array|PdfResponse
     */
    public function pdfAction(Request $request)
    {
        $model = new PdfModel();

        $form = $this->formFactory->create(PdfType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->getClickedButton()) {
            return $this->manager->generatePdf($model);
        }

        return [
            'form' => $form->createView()
        ];
    }
}
