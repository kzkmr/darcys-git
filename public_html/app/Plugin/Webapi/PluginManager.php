<?php
namespace Plugin\Webapi;

use Eccube\Plugin\AbstractPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Eccube\Service\Composer\ComposerServiceFactory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Class PluginManager.
 */
class PluginManager
{
    const VERSION = '1.0.0';

    /**
     * Install the plugin.
     *
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function install(array $meta, ContainerInterface $container)
    {
        dump('install '.self::VERSION);
        $composer = ComposerServiceFactory::createService($container);
        $composer->execRequire('firebase/php-jwt');
        $composer->execRequire('sunra/php-simple-html-dom-parser');
    }

    /**
     * Update the plugin.
     *q
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function update(array $meta, ContainerInterface $container)
    {
        dump('update '.self::VERSION);
        
    }

    /**
     * Enable the plugin.
     *
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function enable(array $meta, ContainerInterface $container)
    {
        dump('enable '.self::VERSION);
    }

    /**
     * Disable the plugin.
     *
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function disable(array $meta, ContainerInterface $container)
    {
        dump('disable '.self::VERSION);
    }

    /**
     * Uninstall the plugin.
     *
     * @param array $meta
     * @param ContainerInterface $container
     */
    public function uninstall(array $meta, ContainerInterface $container)
    {
        dump('uninstall '.self::VERSION);
    }
}
