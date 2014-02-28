<?php
namespace LZAztec\NotificationBundle\Adapter;

use LZAztec\NotificationBundle\Notification\NotificationInterface;

/**
 * Интерфейс адаптера сервиса уведомлений
 * Interface AdapterInterface
 * @package LZAztec\NotificationBundle\Adapter
 */
interface AdapterInterface
{
    /**
     * Производит отправку оповещения
     * @param NotificationInterface $notification
     * @return void
     */
    public function push(NotificationInterface $notification);

    /**
     * Возвращает название адаптера
     * @return string
     */
    public function getName();
} 