<?php


namespace Push\Interfaces;


interface DeviceInterface
{
    const TYPE_IOS = 'ios';
    const TYPE_ANDROID = 'android';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getType(): string;
}
