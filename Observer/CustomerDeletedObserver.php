<?php

namespace Xtremepush\Core\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Core\Helper\WebhookService;
use Xtremepush\Core\Model\Event;
use Xtremepush\Core\Model\ModuleConfig;
use Xtremepush\Core\Serialize\CustomerSerializer;

class CustomerDeletedObserver extends AbstractObserver
{
    /** @var CustomerSerializer */
    private $customerSerializer;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config,
        CustomerSerializer $customerSerializer
    ) {
        $this->customerSerializer = $customerSerializer;
        parent::__construct($logger, $webhookService, $authSession, $config);
    }

    public function execute(Observer $observer)
    {
        if (!$customer = $observer->getEvent()->getData('customer')) {
            return $this;
        }

        $event = Event::EVENT_ADMIN_CUSTOMER_DELETED;
        if ($this->isWebhookEnabled($event)) {
            $this->webhookService->sendWebhook($event, $this->customerSerializer->toArray($customer));
        }

        return $this;
    }
}
