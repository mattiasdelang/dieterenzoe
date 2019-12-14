<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController
{
    /**
     * @Route("", name="home")
     *
     * @Template("Home/Index.twig")
     *
     * @return array
     */
    public function indexAction()
    {
        return [];
    }
}
