<?php

namespace HappyR\UserProjectBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root=$treeBuilder->root('happyr_cloud_flare');

        $root
            ->children()
                ->scalarNode('url')->defaultValue('https://www.cloudflare.com/api_json.html')->cannotBeEmpty()->end()
                ->scalarNode('token')->defaultNull()->cannotBeEmpty()->end()
                ->scalarNode('email')->defaultNull()->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }
}
