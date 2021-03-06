<?php

namespace DAMA\DoctrineTestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    const ENABLE_STATIC_CONNECTION = 'enable_static_connection';
    const STATIC_META_CACHE = 'enable_static_meta_data_cache';
    const STATIC_QUERY_CACHE = 'enable_static_query_cache';

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('dama_doctrine_test');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $root = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $root = $treeBuilder->root('dama_doctrine_test');
        }

        $root
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode(self::ENABLE_STATIC_CONNECTION)->defaultTrue()->end()
                ->booleanNode(self::STATIC_META_CACHE)->defaultTrue()->end()
                ->booleanNode(self::STATIC_QUERY_CACHE)->defaultTrue()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
