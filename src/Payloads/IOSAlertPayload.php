<?php


namespace Push\Payloads;


use Push\Interfaces\MessageInterface;

class IOSAlertPayload extends IOSBasePayload
{
    /**
     * @param MessageInterface $message
     * @return array
     */
    protected function internalMapData(MessageInterface $message): array
    {
        $options = $this->getOptions($message);
        $title = $message->getSubject();
        $body = $message->getMessage();
        $subtitle = $options['subtitle'] ?? null;
        $launchImage = $options['launch-image'] ?? null;
        $titleLocKey = $options['title-loc-key'] ?? null;
        $titleLocArgs = $options['title-loc-args'] ?? null;
        $subtitleLocKey = $options['subtitle-loc-key'] ?? null;
        $subtitleLocArgs = $options['subtitle-loc-args'] ?? null;
        $locKey = $options['loc-key'] ?? null;
        $locArgs = $options['loc-args'] ?? null;

        $alertData = [];
        if (!empty($title)) {
            $alertData['title'] = $title;
        }
        if (!empty($subtitle)) {
            $alertData['subtitle'] = $subtitle;
        }
        if (!empty($body)) {
            $alertData['body'] = $body;
        }
        if (!empty($launchImage)) {
            $alertData['launch-image'] = $launchImage;
        }
        if (!empty($titleLocKey)) {
            $alertData['title-loc-key'] = $titleLocKey;
        }
        if (!empty($titleLocArgs)) {
            $alertData['title-loc-args'] = $titleLocArgs;
        }
        if (!empty($subtitleLocKey)) {
            $alertData['subtitle-loc-key'] = $subtitleLocKey;
        }
        if (!empty($subtitleLocArgs)) {
            $alertData['subtitle-loc-args'] = $subtitleLocArgs;
        }
        if (!empty($locKey)) {
            $alertData['loc-key'] = $locKey;
        }
        if (!empty($locArgs)) {
            $alertData['loc-args'] = $locArgs;
        }

        return ['alert' => $alertData];
    }
}
