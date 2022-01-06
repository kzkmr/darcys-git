<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class StoresPageController extends AbstractController
{

    /**
     * CompanyPageController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Method("GET")
     * @Route("/stores", name="stores")
     * @Template("/stores.twig")
     */
    public function stores()
    {
        return [];
    }
}