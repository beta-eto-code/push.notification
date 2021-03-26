<?php


namespace Push\Interfaces;


interface MessageInterface
{
    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @param string $messageText
     * @return void
     */
    public function setMessageText(string $messageText);

    /**
     * @param string $subject
     * @return void
     */
    public function setSubject(string $subject);

    /**
     * @param string $platform
     * @param string $optionName
     * @param $value
     * @return void
     */
    public function setOption(string $platform, string $optionName, $value);

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @return string
     */
    public function getSubject(): string;

    /**
     * @param string $platform
     * @return array
     */
    public function getOptions(string $platform): array;
}
