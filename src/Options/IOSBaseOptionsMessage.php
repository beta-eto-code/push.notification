<?php


namespace Push\Options;


use Push\Interfaces\DeviceInterface;
use Push\Interfaces\MessageInterface;
use Push\Interfaces\MessageOptionsInterface;

abstract class IOSBaseOptionsMessage implements MessageOptionsInterface
{
    /**
     * @var string
     */
    private $category;
    /**
     * @var int
     */
    private $mutableContent;
    /**
     * @var string
     */
    private $targetContentId;
    /**
     * @var string
     */
    private $threadId;
    /**
     * @var string
     */
    private $soundName;
    /**
     * @var int|null
     */
    private $soundCritical;
    /**
     * @var int|null
     */
    private $soundVolume;
    /**
     * @var int
     */
    private $badgeNumber;
    /**
     * @var array
     */
    private $addProps;

    /**
     * @param MessageInterface $message
     * @return void
     */
    abstract protected function internalLoadOptions(MessageInterface $message);

    public function loadTo(MessageInterface $message)
    {
        if (!empty($this->category)) {
            $this->setOption($message, 'category', $this->category);
        }

        if (!empty($this->threadId)) {
            $this->setOption($message, 'thread-id', $this->threadId);
        }

        if (!empty($this->mutableContent)) {
            $this->setOption($message, 'mutableContent', $this->mutableContent);
        }

        if (!empty($this->targetContentId)) {
            $this->setOption($message, 'targetContentId', $this->targetContentId);
        }

        if (!empty($this->soundCritical)) {
            $this->setOption($message, 'sound', [
                'critical' => (int)$this->soundCritical,
                'name' => $this->soundName,
                'volume' => (int)$this->soundVolume,
            ]);
        } elseif (!empty($this->soundName)) {
            $this->setOption($message, 'sound', $this->soundName);
        }

        if (!empty($this->badgeNumber)) {
            $this->setOption($message, 'badge', $this->badgeNumber);
        }

        if (!empty($this->addProps)) {
            $this->setOption($message, 'properties', $this->addProps);
        }

        $this->internalLoadOptions($message);
    }

    /**
     * @param MessageInterface $message
     * @param string $key
     * @param $value
     */
    protected function setOption(MessageInterface $message, string $key, $value)
    {
        $message->setOption(DeviceInterface::TYPE_IOS, $key, $value);
    }

    /**
     * @param string $category
     * @return $this
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @param string $threadId
     * @return $this
     */
    public function setThreadId(string $threadId): self
    {
        $this->threadId = $threadId;
        return $this;
    }

    /**
     * @param int $mutableContent
     * @return $this
     */
    public function setMutableContent(int $mutableContent): self
    {
        $this->mutableContent = $mutableContent;
        return $this;
    }

    /**
     * @param string $targetContentId
     * @return $this
     */
    public function setTargetContentId(string $targetContentId): self
    {
        $this->targetContentId = $targetContentId;
        return $this;
    }

    public function setBadge(int $badgeNumber): self
    {
        $this->badgeNumber = $badgeNumber;
        return $this;
    }

    /**
     * @param string $name
     * @param int|null $critical
     * @param int|null $volume
     * @return $this
     */
    public function setSound(string $name, int $critical = null, int $volume = null): self
    {
        $this->soundName = $name;
        $this->soundCritical = $critical;
        $this->soundVolume = $volume;
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function setAdditionalProp(string $key, $value): self
    {
        $this->addProps[$key] = $value;
        return $this;
    }
}
