<?php


namespace Push\Interfaces;


interface ResultInterface
{
    /**
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * @return string
     */
    public function getErrorMessage(): string;

    /**
     * @return DeviceInterface
     */
    public function getDevice(): DeviceInterface;

    /**
     * @return MessageInterface
     */
    public function getMessage(): MessageInterface;
}
