<?php

namespace LZAztec\NotificationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Combines notification adapters
 * Class AddAdapterPass
 * @package FOQ\ElasticaBundle\DependencyInjection\Compiler
 */
class AddAdapterPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('lz_aztec_notification.service.notification')) {
            return;
        }

        $mobileDetectorDefinition = $container->findDefinition('lz_aztec_notification.service.notification');

        foreach($container->findTaggedServiceIds('lz_aztec_notification.adapter') as $id => $attributes) {
            $mobileDetectorDefinition->addMethodCall('addAdapter', array($container->getDefinition($id)));
        }
    }
}
