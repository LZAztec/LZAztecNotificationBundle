<?php

namespace LZAztec\NotificationBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use LZAztec\NotificationBundle\DependencyInjection\Compiler as Compilers;

/**
 * Class LZAztecNotificationBundle
 * @package LZAztec\NotificationBundle
 */
class LZAztecNotificationBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new Compilers\AddAdapterPass());
    }
}
