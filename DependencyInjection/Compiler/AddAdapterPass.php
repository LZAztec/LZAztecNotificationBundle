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
        if (!$container->hasDefinition('lzaztec_notification.service.notification')) {
            return;
        }

        $mobileDetectorDefinition = $container->findDefinition('lzaztec_notification.service.notification');

        foreach($container->findTaggedServiceIds('lzaztec_notification.adapter') as $id => $attributes) {
            $mobileDetectorDefinition->addMethodCall('addAdapter', array($container->getDefinition($id)));
        }
    }
}
