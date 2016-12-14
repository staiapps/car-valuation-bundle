<?php

namespace Aiapps\ValuationFormBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AiappsValuationFormExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter( 'aiapps_valuation_form.parameters.apikey', $config[ 'parameters' ]['apikey'] );
        $container->setParameter( 'aiapps_valuation_form.parameters.email', $config[ 'parameters' ]['email'] );
        $container->setParameter( 'aiapps_valuation_form.parameters.terms', $config[ 'parameters' ]['terms'] );
    }
}
