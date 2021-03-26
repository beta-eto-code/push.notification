<?php


namespace Push;


use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Push\Interfaces\DeviceInterface;
use Push\Interfaces\IOSPayloadType;
use Push\Interfaces\MessageInterface;
use Push\Interfaces\MessagePusherInterface;
use Push\Interfaces\PayloadInterface;
use Push\Interfaces\ResultInterface;

class IOSPusher implements MessagePusherInterface
{
    /**
     * @var string
     */
    private $kid;
    /**
     * @var string
     */
    private $iss;
    /**
     * @var string
     */
    private $keyFile;
    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var PayloadInterface[]
     */
    private $payloadResolver;
    /**
     * @var string
     */
    private $appId;

    /**
     * IOSPusher constructor.
     * @param string $keyFile
     * @param string $kid
     * @param string $iss
     * @param ClientInterface $client
     * @throws Exception
     */
    public function __construct(string $keyFile, string $kid, string $iss, string $appId, ClientInterface $client)
    {
        if(!file_exists($keyFile)) {
            throw new Exception('Key file is not exists!');
        }

        $this->keyFile = $keyFile;
        $this->kid = $kid;
        $this->iss = $iss;
        $this->appId = $appId;
        $this->client = $client;
    }

    /**
     * @param MessageInterface $message
     * @return array
     * @throws Exception
     */
    private function getPayload(MessageInterface $message): array
    {
        $options = $message->getOptions(DeviceInterface::TYPE_IOS) ?? [];
        $type = $options['type'] ?? IOSPayloadType::ALERT;
        $payload = $this->payloadResolver[$type] ?? null;
        if (!($payload instanceof PayloadInterface)) {
            throw new Exception('Invalid payload type');
        }

        return $payload->toArray($message);
    }

    /**
     * @return string
     */
    private function getToken(): string
    {
        $key = file_get_contents($this->keyFile);
        return JWT::encode(
            [
                'iat' => time(),
                'iss' => $this->iss,
            ],
            $key,
            'ES256',
            $this->kid
        );
    }

    /**
     * @param DeviceInterface $device
     * @param MessageInterface $message
     * @return ResultInterface
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function sendMessage(DeviceInterface $device, MessageInterface $message): ResultInterface
    {
        $request = new Request(
            'post',
            "https://api.push.apple.com:443/3/device/".$device->getId(),
            [
                'Content-Type' => 'application/json',
                'apns-expiration' => 0,
                'apns-topic' => $this->appId,
                'authorization' => 'bearer '.$this->getToken(),
            ],
            json_encode($this->getPayload($message)),
            '2.0'
        );

        $response = $this->client->sendRequest($request);
        $code = $response->getStatusCode();
        if ($code !== 200) {
            $errorMessage = (string)$response->getBody();
            return new Result($message, $device, !empty($errorMessage) ? $errorMessage : 'Undefined error');
        }

        return new Result($message, $device);
    }

    public function setPayloadResolver(string $type, PayloadInterface $payload): MessagePusherInterface
    {
        $this->payloadResolver[$type] = $payload;
        return $this;
    }
}
