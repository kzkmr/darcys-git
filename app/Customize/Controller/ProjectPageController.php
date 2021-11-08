<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class ProjectPageController extends AbstractController
{

    /**
     * ProjectPageController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Method("GET")
     * @Route("/project", name="project")
     * @Template("/project.twig")
     */
    public function company()
    {
        return [];
    }
}