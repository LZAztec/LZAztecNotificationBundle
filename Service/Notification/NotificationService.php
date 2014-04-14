<?php
namespace LZAztec\NotificationBundle\Service\Notification;

use LZAztec\NotificationBundle\Adapter\AdapterInterface;
use LZAztec\NotificationBundle\Exception\NotificationException;
use LZAztec\NotificationBundle\Notification\Notification;
use LZAztec\NotificationBundle\Notification\NotificationInterface;
use LZAztec\NotificationBundle\Notification\NotifyingEntityInterface;

/**
 * Class NotificationService
 * @package LZAztec\NotificationBundle\Service\Notification
 */
class NotificationService implements NotificationServiceInterface
{
    /**
     * @var AdapterInterface[]
     */
    private $_adapters = [];

    /**
     * Sends notifications to clients
     * @param NotificationInterface $notification
     */
    public function sendNotification(NotificationInterface $notification)
    {
        foreach ($this->getAdapters() as $adapter)
        {
            $adapter->push($notification);
        }
    }

    /**
     * @param $entity
     */
    public function sendEntityNotification(NotifyingEntityInterface $entity)
    {
        $this->sendNotification(
            new Notification($entity->getChannelsForNotification(), $entity->getNotificationData())
        );
    }

    /**
     * @return \LZAztec\NotificationBundle\Adapter\AdapterInterface[]
     */
    public function getAdapters()
    {
        return $this->_adapters;
    }

    /**
     * @param AdapterInterface $adapter
     */
    public function addAdapter(AdapterInterface $adapter)
    {
        $this->_adapters[] = $adapter;
    }

}