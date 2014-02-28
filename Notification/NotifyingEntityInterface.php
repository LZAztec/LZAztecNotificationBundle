<?php
namespace LZAztec\NotificationBundle\Notification;

/**
 * Интерфейс сущности с возможностью уведомления
 * Interface NotificationInterface
 * @package LZAztec\NotificationBundle\Notification
 */
interface NotifyingEntityInterface
{
    /**
     * Возвращает данные для уведомления
     * @return mixed
     */
    public function getNotificationData();

    /**
     * Возвращает список каналов для уведомления
     * @return array
     */
    public function getChannelsForNotification();

} 