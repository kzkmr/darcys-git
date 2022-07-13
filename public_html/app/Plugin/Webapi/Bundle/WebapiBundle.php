<?php

/**
 * Class WebapiBundle
 * @package Plugin\Webapi\Bundle
 * @author Tyler Nguyen <tylermagento@gmail.com>
 * @created : 13/03/2022
 */
namespace Plugin\Webapi\Bundle;

use Plugin\Webapi\DependencyInjection\ApiExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class WebapiBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

//        $container->addCompilerPass(new ApiCompilerPass());
    }

    /**
     * @return ApiExtension
     */
    public function getContainerExtension()
    {
        return new ApiExtension();
    }
}
