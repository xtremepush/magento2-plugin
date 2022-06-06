<?php

namespace Xtremepush\Module\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Module\Helper\WebhookService;
use Xtremepush\Module\Model\Event;
use Xtremepush\Module\Model\ModuleConfig;
use Xtremepush\Module\Serialize\CustomerSerializer;

class CustomerRegisteredObserver extends AbstractObserver
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

        $event = Event::EVENT_CUSTOMER_CUSTOMER_REGISTERED;
        if ($this->isWebhookEnabled($event)) {
            $this->webhookService->sendWebhook($event, $this->customerSerializer->toArray($customer));
        }

        return $this;
    }
}
