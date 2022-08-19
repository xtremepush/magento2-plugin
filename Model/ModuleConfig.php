<?php

namespace Xtremepush\Core\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool;

class ModuleConfig
{
    private const PREFIX_GENERAL = 'xtremepush_config/';
    private const PREFIX_WEBHOOKS = 'xtremepush_webhooks/';

    private const GROUP_GENERAL = 'general/';
    private const GROUP_WEBHOOKS = 'webhooks/';

    private const FIELD_XP_WEBHOOK_URL = 'xp_webhook_url';
    private const FIELD_XP_PROJECT_TITLE = 'xp_project_title';
    private const FIELD_XP_ACCESS_TOKEN = 'xp_access_token';
    private const FIELD_XP_ACTIVE = 'xp_active';
    private const DOCUMENTATION_URL = 'documentation_url';

    public const WEBHOOK_QUOTES = 'webhook_quotes';
    public const WEBHOOK_ORDERS = 'webhook_orders';
    public const WEBHOOK_CUSTOMERS = 'webhook_customers';

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    /** @var WriterInterface */
    private $configWriter;

    /** @var TypeListInterface */
    private $cacheTypeList;

    /** @var Pool */
    private $cacheFrontendPool;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->configWriter = $configWriter;
        $this->cacheTypeList = $cacheTypeList;
        $this->cacheFrontendPool = $cacheFrontendPool;
    }

    /**
     * @param bool $value
     * @return void
     */
    public function setXpActive(bool $value)
    {
        $this->configWriter->save(self::PREFIX_GENERAL . self::GROUP_GENERAL . self::FIELD_XP_ACTIVE, $value);
    }

    /**
     * @param string $value
     * @return void
     */
    public function setXpProjectTitle(string $value)
    {
        $this->configWriter->save(self::PREFIX_GENERAL . self::GROUP_GENERAL . self::FIELD_XP_PROJECT_TITLE, $value);
    }

    /**
     * @param string $value
     * @return void
     */
    public function setXpWebhookUrl(string $value)
    {
        $this->configWriter->save(self::PREFIX_GENERAL . self::GROUP_GENERAL . self::FIELD_XP_WEBHOOK_URL, $value);
    }

    /**
     * @param string $value
     * @return void
     */
    public function setXpAccessToken(string $value)
    {
        $this->configWriter->save(self::PREFIX_GENERAL . self::GROUP_GENERAL . self::FIELD_XP_ACCESS_TOKEN, $value);
    }

    /**
     * @return bool
     */
    public function getXpActive()
    {
        return (bool)$this->scopeConfig->getValue(self::PREFIX_GENERAL . self::GROUP_GENERAL . self::FIELD_XP_ACTIVE);
    }

    /**
     * @return string|null
     */
    public function getXpAccessToken()
    {
        return $this->scopeConfig->getValue(self::PREFIX_GENERAL . self::GROUP_GENERAL . self::FIELD_XP_ACCESS_TOKEN);
    }

    /**
     * @return string|null
     */
    public function getXpWebhookUrl()
    {
        return $this->scopeConfig->getValue(self::PREFIX_GENERAL . self::GROUP_GENERAL . self::FIELD_XP_WEBHOOK_URL);
    }

    /**
     * @return string|null
     */
    public function getXpProjectTitle()
    {
        return $this->scopeConfig->getValue(self::PREFIX_GENERAL . self::GROUP_GENERAL . self::FIELD_XP_PROJECT_TITLE);
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return $this->scopeConfig->getValue(self::PREFIX_GENERAL . self::GROUP_GENERAL . self::DOCUMENTATION_URL);
    }

    /**
     * @return bool
     */
    public function getWebhookSetting(string $webhook)
    {
        return (bool)$this->scopeConfig->getValue(self::PREFIX_WEBHOOKS . self::GROUP_WEBHOOKS . $webhook);
    }

    /**
     * Cache must be cleared after updating configuration for changes to take effect
     *
     * @return void
     */
    public function cacheCleanAndFlush()
    {
        $this->cacheTypeList->cleanType('config');
        foreach ($this->cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
    }
}
