<?php


namespace Push\Interfaces;


interface MessagePusherInterface
{
    /**
     * @param string $type
     * @param PayloadInterface $payload
     * @return $this
     */
    public function setPayloadResolver(string $type, PayloadInterface $payload): self;

    /**
     * @param DeviceInterface $device
     * @param MessageInterface $message
     * @return ResultInterface
     */
    public function sendMessage(DeviceInterface $device, MessageInterface $message): ResultInterface;
}
