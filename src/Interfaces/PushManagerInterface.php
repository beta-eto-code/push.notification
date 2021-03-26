<?php


namespace Push\Interfaces;


interface PushManagerInterface
{
    /**
     * @param string $platform
     * @param MessagePusherInterface $pusher
     * @return void
     */
    public function setPusher(string $platform, MessagePusherInterface $pusher);

    /**
     * @param MessageInterface $message
     * @param DeviceInterface ...$deviceList
     * @return ResultInterface[]
     */
    public function sendMessage(MessageInterface $message, DeviceInterface ...$deviceList): array;
}
