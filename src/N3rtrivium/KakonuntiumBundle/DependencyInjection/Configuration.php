<?php

namespace N3rtrivium\KakonuntiumBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('n3rtrivium_kakonuntium');

		$rootNode
			->children()
			->scalarNode('lectures_ical_source')->isRequired()->end();
		$rootNode
			->children()
			->arrayNode('allowed_guessing_identifiers')
				->requiresAtLeastOneElement()
				->beforeNormalization()
				->ifTrue(function ($v) { return !is_array($v); })
				->then(function ($v) { return array($v); })
			->end()
			->prototype('scalar')
			->end();
		$rootNode->end();

		return $treeBuilder;
	}
}