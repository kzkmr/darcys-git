<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class MaterialsPageController extends AbstractController
{

    /**
     * MaterialsPageController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Method("GET")
     * @Route("/materials", name="materials")
     * @Template("/materials.twig")
     */
    public function materials()
    {
        return [];
    }
}