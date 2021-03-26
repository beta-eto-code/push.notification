<?php


namespace Push;


use Push\Interfaces\DeviceInterface;
use Push\Interfaces\MessageInterface;
use Push\Interfaces\MessagePusherInterface;
use Push\Interfaces\PushManagerInterface;
use Push\Interfaces\ResultInterface;

class PushManager implements PushManagerInterface
{

    /**
     * @var MessagePusherInterface[]
     */
    private $pusher;

    /**
     * @param string $platform
     * @param MessagePusherInterface $pusher
     */
    public function setPusher(string $platform, MessagePusherInterface $pusher)
    {
        $this->pusher[$platform] = $pusher;
    }

    /**
     * @param MessageInterface $message
     * @param DeviceInterface ...$deviceList
     * @return ResultInterface[]
     */
    public function sendMessage(MessageInterface $message, DeviceInterface ...$deviceList): array
    {
        $result = [];
        foreach ($deviceList as $device) {
            $pusher = $this->pusher[$device->getType()] ?? null;
            if ($pusher instanceof MessagePusherInterface) {
                $result[] = $pusher->sendMessage($device, $message);
            }
        }

        return $result;
    }
}
