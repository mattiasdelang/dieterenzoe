<?php

namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class PdfModel
{
    const VRAGEN = 'vragen';
    const PERSONEN = 'personen';
    const NUMMERS = 'nummers';
    const EMAILADRESSEN = 'emailadressen';
    const ALLES = 'alles';

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"aanmaken"})
     */
    private $watTonen;

    /**
     * @return string
     */
    public function getWatTonen()
    {
        return $this->watTonen;
    }

    /**
     * @param string $watTonen
     */
    public function setWatTonen($watTonen)
    {
        $this->watTonen = $watTonen;
    }
}