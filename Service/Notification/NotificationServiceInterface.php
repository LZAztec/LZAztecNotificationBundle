<?php
namespace LZAztec\NotificationBundle\Service\Notification;

use LZAztec\NotificationBundle\Notification\NotificationInterface;
use LZAztec\NotificationBundle\Notification\NotifyingEntityInterface;

/**
 * Notification service interface
 *
 * Interface NotificationServiceInterface
 * @package LZAztec\NotificationBundle\Service\Notification
 */
interface NotificationServiceInterface
{
    /**
     * Send notification to clients
     * @param NotificationInterface $notification
     */
    public function sendNotification(NotificationInterface $notification);

    /**
     * Send notification about entity to clients
     * @param $entity
     */
    public function sendEntityNotification(NotifyingEntityInterface $entity);
}