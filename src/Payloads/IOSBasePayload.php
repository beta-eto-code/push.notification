<?php


namespace Push\Payloads;


use Push\Interfaces\DeviceInterface;
use Push\Interfaces\MessageInterface;
use Push\Interfaces\PayloadInterface;

abstract class IOSBasePayload implements PayloadInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * @param MessageInterface $message
     * @return array
     */
    abstract protected function internalMapData(MessageInterface $message): array;

    /**
     * @param MessageInterface $message
     * @return array
     */
    protected function getOptions(MessageInterface $message): array
    {
        if ($this->options !== null) {
            return (array)$this->options;
        }

        return $this->options = $message->getOptions(DeviceInterface::TYPE_IOS) ?? [];
    }

    /**
     * @param MessageInterface $message
     * @return array
     */
    public function toArray(MessageInterface $message): array
    {
        $options = $this->getOptions($message);
        $threadId = $options['thread-id'] ?? null;
        $category = $options['category'] ?? null;
        $mutableContent = $options['mutable-content'] ?? null;
        $targetContentId = $options['target-content-id'] ?? null;
        $sound = $options['sound'] ?? null;
        $badge = $options['badge'] ?? null;
        $properties = $options['properties'] ?? [];

        $data = [];
        if (!empty($threadId)) {
            $data['thread-id'] = $threadId;
        }

        if (!empty($category)) {
            $data['category'] = $category;
        }

        if (!empty($mutableContent)) {
            $data['mutable-content'] = $mutableContent;
        }

        if (!empty($targetContentId)) {
            $data['target-content-id'] = $targetContentId;
        }

        if (!empty($sound)) {
            $data['sound'] = $sound;
        }

        if (!empty($badge)) {
            $data['badge'] = $badge;
        }

        $properties['aps'] = array_merge($data, $this->internalMapData($message));

        return $properties;
    }
}
