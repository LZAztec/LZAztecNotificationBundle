<?php
namespace LZAztec\NotificationBundle\Notification;

/**
 * Интерфейс уведомления
 * Interface NotificationInterface
 * @package LZAztec\NotificationBundle\Notification
 */
interface NotificationInterface
{

    /**
     * Возвращает список каналов, для которых предназначено оповещение
     * @return array
     */
    public function getChannels();

    /**
     * Возвращает данные уведомления
     * @return mixed
     */
    public function getData();

} 