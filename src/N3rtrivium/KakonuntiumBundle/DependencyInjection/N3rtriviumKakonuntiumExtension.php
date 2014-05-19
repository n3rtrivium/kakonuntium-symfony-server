<?php

namespace N3rtrivium\KakonuntiumBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class N3rtriviumKakonuntiumExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
	    $configuration = new Configuration();
	    $config = $this->processConfiguration($configuration, $configs);

	    $container->setParameter(
		    'n3rtrivium_kakonuntium.allowed_guessing_identifiers',
		    $config['allowed_guessing_identifiers']
	    );

	    $container->setParameter(
		    'n3rtrivium_kakonuntium.lectures_ical_source',
		    $config['lectures_ical_source']
	    );

	    // Load dependency injection configuration
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    public function getAlias()
    {
        return 'n3rtrivium_kakonuntium';
    }
}
