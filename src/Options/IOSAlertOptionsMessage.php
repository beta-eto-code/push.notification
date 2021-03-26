<?php

namespace Push\Options;

use Push\Interfaces\IOSPayloadType;
use Push\Interfaces\MessageInterface;

class IOSAlertOptionsMessage extends IOSBaseOptionsMessage
{
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $launchImage;
    /**
     * @var string
     */
    private $titleLocKey;
    /**
     * @var string
     */
    private $subtitleLocKey;
    /**
     * @var string[]
     */
    private $titleLocArgs;
    /**
     * @var string[]
     */
    private $subtitleLocArgs;
    /**
     * @var string
     */
    private $locKey;
    /**
     * @var string[]
     */
    private $locArgs;

    public static function init(): self
    {
        return new static();
    }

    protected function internalLoadOptions(MessageInterface $message)
    {
        $this->setOption($message, 'type', IOSPayloadType::ALERT);

        if (!empty($this->subtitle)) {
            $this->setOption($message, 'subtitle', $this->subtitle);
        }
        if (!empty($this->launchImage)) {
            $this->setOption($message, 'launch-image', $this->launchImage);
        }
        if (!empty($this->titleLocKey)) {
            $this->setOption($message, 'title-loc-key', $this->titleLocKey);
        }
        if (!empty($this->titleLocArgs)) {
            $this->setOption($message, 'title-loc-args', $this->titleLocArgs);
        }
        if (!empty($this->subtitleLocKey)) {
            $this->setOption($message, 'subtitle-loc-key', $this->subtitleLocKey);
        }
        if (!empty($this->subtitleLocArgs)) {
            $this->setOption($message, 'subtitle-loc-args', $this->subtitleLocArgs);
        }
        if (!empty($this->locKey)) {
            $this->setOption($message, 'loc-key', $this->locKey);
        }
        if (!empty($this->locArgs)) {
            $this->setOption($message, 'loc-args', $this->locArgs);
        }
    }

    /**
     * @param string $subtitle
     * @return $this
     */
    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setLaunchImage(string $image): self
    {
        $this->launchImage = $image;
        return $this;
    }

    /**
     * @param string $titleLocKey
     * @return $this
     */
    public function setTitleLocKey(string $titleLocKey): self
    {
        $this->titleLocKey = $titleLocKey;
        return $this;
    }

    /**
     * @param string $subtitleLocKey
     * @return $this
     */
    public function setSubtitleLocKey(string $subtitleLocKey): self
    {
        $this->subtitleLocKey = $subtitleLocKey;
        return $this;
    }

    /**
     * @param string ...$titleLocArgs
     * @return $this
     */
    public function setTitleLocArgs(string ...$titleLocArgs): self
    {
        $this->titleLocArgs = $titleLocArgs;
        return $this;
    }

    /**
     * @param string ...$subtitleLocArgs
     * @return $this
     */
    public function setSubtitleLocArgs(string ...$subtitleLocArgs): self
    {
        $this->subtitleLocArgs = $subtitleLocArgs;
        return $this;
    }

    /**
     * @param string $locKey
     * @return $this
     */
    public function setLocKey(string $locKey): self
    {
        $this->locKey = $locKey;
        return $this;
    }

    /**
     * @param string ...$locArgs
     * @return $this
     */
    public function setLocArgs(string ...$locArgs): self
    {
        $this->locArgs = $locArgs;
        return $this;
    }
}
