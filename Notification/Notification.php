<?php
namespace LZAztec\NotificationBundle\Notification;

/**
 * Класс уведомления
 * Class Notification
 * @package LZAztec\NotificationBundle\Notification
 */
class Notification implements NotificationInterface
{
    /**
     * Channel list
     * @var array
     */
    private $_channels = array();

    /**
     * Data to send
     * @var mixed
     */
    private $_data;

    /**
     * @param array $channels
     * @param null $data
     */
    public function __construct(array $channels = array(), $data = null)
    {
        $this->_channels = $channels;
        $this->_data = $data;
    }

    /**
     * Возвращает список каналов, для которых предназначено оповещение
     * @return array
     */
    public function getChannels()
    {
        return $this->_channels;
    }

    /**
     * Возвращает данные уведомления
     * @return mixed
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @param array $channelParts
     * @return string
     */
    public static function makeChannel(array $channelParts)
    {
        return implode('_', $channelParts);
    }
}