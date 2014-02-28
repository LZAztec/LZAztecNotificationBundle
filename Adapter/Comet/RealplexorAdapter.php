<?php
namespace LZAztec\NotificationBundle\Adapter\Comet;

use LZAztec\NotificationBundle\Adapter\AdapterInterface;
use LZAztec\NotificationBundle\Notification\NotificationInterface;

/**
 * Adapter for Dklab Realplexor comet server
 * Class RealplexorAdapter
 * @link http://dklab.ru/lib/dklab_realplexor/
 * @package LZAztec\NotificationBundle\Adapter\Realplexor
 */
class RealplexorAdapter implements AdapterInterface
{
    /**
     * @var \Dklab_Realplexor
     */
    private $_realplexor;

    /**
     * @param $host
     * @param $port
     * @param $namespace
     */
    public function __construct($host, $port, $namespace)
    {
        $this->_realplexor = new \Dklab_Realplexor($host, $port, $namespace);
    }

    /**
     * @param NotificationInterface $notification
     */
    public function push(NotificationInterface $notification)
    {
        // Send data to channels.
        $this->_realplexor->send($notification->getChannels(), $notification->getData());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Realplexor';
    }
}