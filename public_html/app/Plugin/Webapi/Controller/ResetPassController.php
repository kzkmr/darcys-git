<?php

/**
 * Class ResetPassController
 * @package Plugin\Webapi\Controller
 * @author Tyler Nguyen <tylermagento@gmail.com>
 * @created : 13/03/2022
 */

namespace Plugin\Webapi\Controller;

use Eccube\Application;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class ResetPassController
{
    /**
     * @Route("/reset_pass_on_app/{key}", name="forgot_reset_app")
     * @Method("GET")
     * @Template("Webapi/Resource/template/deeplink.twig")
     */
    public function form(string $key)
    {
        return ['key'=>$key];
    }
}
