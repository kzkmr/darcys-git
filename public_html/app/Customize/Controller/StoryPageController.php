<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class StoryPageController extends AbstractController
{

    /**
     * StoryPageController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Method("GET")
     * @Route("/story", name="story")
     * @Template("/story.twig")
     */
    public function story()
    {
        return [];
    }
}