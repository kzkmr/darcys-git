<?php

/**
 * Class ApiExtension
 * @package Plugin\Webapi\DependencyInjection
 * @author Tyler Nguyen <tylermagento@gmail.com>
 * @created : 13/03/2022
 */

namespace Plugin\Webapi\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;


class ApiExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container)
    {
        $extensionConfigsRefl = new \ReflectionProperty(ContainerBuilder::class, 'extensionConfigs');
        $extensionConfigsRefl->setAccessible(true);
        $extensionConfigs = $extensionConfigsRefl->getValue($container);

        foreach($extensionConfigs["security"] as $key => $security) {
            if (isset($security["firewalls"])) {
                $names = array_keys($security["firewalls"]);
                $replaced = [];
                foreach ($names as $name) {
                    if ($name === 'admin') {

                        $replaced['api_login'] = [
                            'pattern' => '^/(api/login|api/forgot_id|api/forgot_password|api/changepassword)',
                            'stateless' => true,
                            'anonymous' => true,
                            'provider' => 'customer_provider'
                        ];
                        $replaced['api'] = [
                            'pattern' => '^/api',
                            'stateless' => true,
                            'anonymous' => false,
                            'provider' => 'customer_provider',
                            'guard' => array(
                                'authenticators' => array(
                                    'Plugin\Webapi\Security\TokenAuthenticator'
                                )
                            )
                        ];
                        
                    }
                    $replaced[$name] = $security["firewalls"][$name];
                }
                $extensionConfigs["security"][$key]["firewalls"] = $replaced;
            }
        }
        $extensionConfigsRefl->setValue($container, $extensionConfigs);
    }

    public function load(array $configs, ContainerBuilder $container)
    {

    }
}
