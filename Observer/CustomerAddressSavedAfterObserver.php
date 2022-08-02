<?php

namespace Xtremepush\Module\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Module\Helper\WebhookService;
use Xtremepush\Module\Model\Event;
use Xtremepush\Module\Model\ModuleConfig;
use Xtremepush\Module\Serialize\CustomerSerializer;

class CustomerAddressSavedAfterObserver extends AbstractObserver
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
        /** @var \Magento\Customer\Model\Address $address */
        $address = $observer->getData('customer_address');
        if (!$address || $this->isAdmin() || !$customer = $address->getCustomer()) {
            return $this;
        }

        if ($this->isWebhookEnabled(Event::EVENT_CUSTOMER_CUSTOMER_UPDATED)) {
            $this->webhookService->sendWebhook(Event::EVENT_CUSTOMER_CUSTOMER_UPDATED, $this->customerSerializer->toArray($customer->getDataModel()));
        }

        return $this;
    }
}
