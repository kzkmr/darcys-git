<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class ConceptPageController extends AbstractController
{

    /**
     * ConceptPageController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Method("GET")
     * @Route("/concept", name="concept")
     * @Template("/concept.twig")
     */
    public function concept()
    {
        return [];
    }
}