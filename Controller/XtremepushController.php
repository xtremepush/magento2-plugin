<?php

namespace Xtremepush\Core\Controller;

use Xtremepush\Core\Api\ConfigurationInterface;
use Xtremepush\Core\Model\ModuleConfig;

class XtremepushController implements ConfigurationInterface
{
    /** @var ModuleConfig */
    private $config;

    public function __construct(ModuleConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Saves XP integration configuration data
     * Response is wrapped in a wrapper array to avoid Magento's array flattening (array keys are removed)
     *
     * @param string $xpProjectTitle
     * @param string $xpAccessToken
     * @param string $xpWebhookUrl
     * @return array
     */
    public function configure(string $xpProjectTitle, string $xpAccessToken, string $xpWebhookUrl)
    {
        $this->config->setXpProjectTitle($xpProjectTitle);
        $this->config->setXpAccessToken($xpAccessToken);
        $this->config->setXpWebhookUrl($xpWebhookUrl);
        $this->config->setXpActive(0);
        $this->config->cacheCleanAndFlush();

        return [compact(['xpProjectTitle', 'xpAccessToken', 'xpWebhookUrl'])];
    }
}
