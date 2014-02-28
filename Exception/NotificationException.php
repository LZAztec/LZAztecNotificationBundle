<?php
namespace LZAztec\NotificationBundle\Exception;

/**
 * Class NotificationException
 * @package LZAztec\NotificationBundle\Exception
 */
class NotificationException extends \Exception
{
    /**
     * Any additional parameters of exception
     * @var array
     */
    protected $_parameters;

    /**
     * @param string $message
     * @param array $parameters
     * @param null $code
     * @param null $previous
     */
    public function __construct($message, array $parameters = array(), $code = null, $previous = null)
    {
        $this->_parameters = $parameters;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->_parameters;
    }

}