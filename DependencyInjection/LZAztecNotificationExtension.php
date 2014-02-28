<?php

namespace LZAztec\NotificationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LZAztecNotificationExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('lzaztec_notification.realplexor_host', $config['realplexor_host']);
        $container->setParameter('lzaztec_notification.realplexor_port', $config['realplexor_port']);
        $container->setParameter('lzaztec_notification.realplexor_ns', $config['realplexor_ns']);
        $container->setParameter('lzaztec_notification.js_api_host', $config['js_api_host']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        foreach ($config['enabled_adapters'] as $adapter => $enabled) {
            if ($enabled) {
                $container->getDefinition(sprintf('lzaztec_notification.adapter.%s', $adapter))->addTag('lzaztec_notification.adapter');
            }
        }
    }
}
