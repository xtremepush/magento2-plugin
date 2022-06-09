<?php

namespace Xtremepush\Module\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Xtremepush\Module\Model\ModuleConfig;
use Psr\Log\LoggerInterface;
use Magento\Framework\Serialize\SerializerInterface;

class WebhookService extends AbstractHelper
{
    /** @var ModuleConfig */
    private $config;

    /** @var LoggerInterface */
    protected $_logger;

    /** @var SerializerInterface */
    protected $_serializer;

    public function __construct(
        ModuleConfig $config,
        LoggerInterface $logger,
        Context $context,
        SerializerInterface $serializer
    )
    {
        $this->config = $config;
        $this->_logger = $logger;
        $this->_serializer = $serializer;
        parent::__construct($context);
    }

    /**
     * @param string $event
     * @param array $payload
     * @return bool|string
     */
    public function sendWebhook(string $event, array $payload)
    {
        if (!$this->config->getXpActive()) {
            return '';
        }

        $url = $this->config->getXpWebhookUrl();
        $payload = $this->_serializer->serialize($payload);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'X-Api-Token: ' . $this->config->getXpAccessToken(),
                'Content-Length: ' . strlen($payload),
                'Topic: ' . $event
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_errno($curl);

        if ($err) {
            $this->_logger->warning(sprintf('Xtremepush: Unable to send webhook to %s with data: %s', $url, $payload));
        }

        curl_close($curl);
        return $response;
    }
}
