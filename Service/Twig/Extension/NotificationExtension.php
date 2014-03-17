<?php
namespace LZAztec\NotificationBundle\Service\Twig\Extension;

use LZAztec\NotificationBundle\Exception\NotificationException;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MainBundleExtension
 * @package LZAztec\MainBundle\Infrastructure\Twig\Extension
 */
class NotificationExtension extends \Twig_Extension
{

    /**
     * @var ContainerInterface
     */
    private $_container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'getParameter' => new \Twig_Function_Method($this, 'getParameterFromContainer', array('pre_escape' => 'html', 'is_safe' => array('html'))),
            'jsApiNotificationHost' => new \Twig_Function_Method($this, 'getJsApiHost', array('pre_escape' => 'html', 'is_safe' => array('html'))),
            'init_notification' => new \Twig_Function_Method($this, 'initNotification', array('is_safe' => array('html'))),
        );
    }

    /**
     * If exists returns parameter from container
     *
     * @param $name
     * @return mixed
     * @throws \LZAztec\NotificationBundle\Exception\NotificationException
     */
    public function getParameterFromContainer($name)
    {
        if ($this->_container->hasParameter($name))
        {
            return $this->_container->getParameter($name);
        }
        else
        {
            throw new NotificationException(sprintf('Parameter "%s" not exists.', $name));
        }
    }

    /**
     * Gets a service.
     *
     * @param string $id The service identifier
     *
     * @return object The associated service
     */
    public function getService($id)
    {
        return $this->_container->get($id);
    }

    /**
     * Returns js api host
     * @return string
     */
    public function getJsApiHost()
    {
        return $this->getParameterFromContainer('lz_aztec_notification.js_api_host');
    }

    /**
     * Renders initialization script
     * @param $variableName
     * @return string
     */
    public function initNotification($variableName)
    {
        return $this->getService('templating')->render('LZAztecNotificationBundle:Script:init.html.twig', array(
            'variableName' => $variableName
        ));
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "LZAztecNotification";
    }
}
