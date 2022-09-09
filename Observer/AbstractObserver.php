<?php

namespace Xtremepush\Core\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Xtremepush\Core\Helper\WebhookService;
use Xtremepush\Core\Model\Event;
use Xtremepush\Core\Model\ModuleConfig;

abstract class AbstractObserver implements ObserverInterface
{
    /** @var LoggerInterface */
    protected $_logger;

    /** @var WebhookService */
    protected $webhookService;

    /** @var Session */
    protected $authSession;

    /** @var ModuleConfig */
    protected $config;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config
    ) {
        $this->_logger = $logger;
        $this->webhookService = $webhookService;
        $this->authSession = $authSession;
        $this->config = $config;
    }

    /**
     * Returns true if current session user is admin
     * @return bool
     */
    protected function isAdmin()
    {
        return !is_null($this->authSession->getUser());
    }

    /**
     * Returns true if user has enabled given webhook
     * @return bool
     */
    protected function isWebhookEnabled(string $event)
    {
        if (!$this->config->getXpActive()) {
            return false;
        }

        $permission = Event::getPermissionByEvent($event);
        return $this->config->getWebhookSetting($permission);
    }
}
