<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Rsvp;
use AppBundle\Model\PdfModel;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Twig\Environment;

class PdfManager
{
    /**
     * @var Pdf
     */
    private $pdf;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * PdfManager constructor.
     * @param Pdf $pdf
     * @param Environment $twig
     * @param EntityManagerInterface $em
     */
    public function __construct(Pdf $pdf, Environment $twig, EntityManagerInterface $em)
    {
        $this->pdf = $pdf;
        $this->twig = $twig;
        $this->em = $em;
    }

    /**
     * @param PdfModel $model
     *
     * @return string
     */
    public function generatePdf(PdfModel $model)
    {
        $rsvps = $this->em->getRepository(Rsvp::class)->findAll();
        $html = $this->twig->render('Pdf/Rsvp.twig', ['model' => $model, 'rsvps' => $rsvps]);

        return new PdfResponse(
            $this->pdf->getOutputFromHtml($html),
                'dieter_en_zoe_rsvp_'.$model->getWatTonen().'.pdf'
        );
    }
}