<?php

namespace Push;

use Push\Interfaces\DeviceInterface;

class IOSDevice implements DeviceInterface
{
    /**
     * @var string
     */
    private $deviceId;

    public function __construct(string $deviceId)
    {
        $this->deviceId = $deviceId;
    }

    public function getId(): string
    {
        return $this->deviceId;
    }

    public function getType(): string
    {
        return DeviceInterface::TYPE_IOS;
    }
}
