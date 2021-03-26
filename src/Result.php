<?php


namespace Push;


use Push\Interfaces\DeviceInterface;
use Push\Interfaces\MessageInterface;
use Push\Interfaces\ResultInterface;

class Result implements ResultInterface
{
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var MessageInterface
     */
    private $message;
    /**
     * @var DeviceInterface
     */
    private $device;

    public function __construct(MessageInterface $message, DeviceInterface $device, string $errorMessage = null)
    {
        $this->message = $message;
        $this->device = $device;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return empty($this->errorMessage);
    }

    /**
     * @return DeviceInterface
     */
    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    /**
     * @return MessageInterface
     */
    public function getMessage(): MessageInterface
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return (string)$this->errorMessage;
    }
}
