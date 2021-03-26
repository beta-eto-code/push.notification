<?php


namespace Push;


use Push\Interfaces\MessageInterface;

class Message implements MessageInterface
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $options;

    /**
     * Message constructor.
     * @param string $subject
     * @param string $message
     */
    public function __construct(string $subject, string $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->message;
    }

    /**
     * @param string $messageText
     */
    public function setMessageText(string $messageText)
    {
        $this->message = $messageText;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param string $platform
     * @param string $optionName
     * @param $value
     */
    public function setOption(string $platform, string $optionName, $value)
    {
        $this->options[$platform][$optionName] = $value;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $platform
     * @return array
     */
    public function getOptions(string $platform): array
    {
        return $this->options[$platform] ?? [];
    }
}
