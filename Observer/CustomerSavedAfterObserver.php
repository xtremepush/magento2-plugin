<?php

namespace Xtremepush\Module\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Module\Helper\WebhookService;
use Xtremepush\Module\Model\Event;
use Xtremepush\Module\Model\ModuleConfig;
use Xtremepush\Module\Serialize\CustomerSerializer;

class CustomerSavedAfterObserver extends AbstractObserver
{
    /** @var CustomerSerializer */
    private $customerSerializer;

    /** @var CustomerSession */
    private $customerSession;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config,
        CustomerSerializer $customerSerializer,
        CustomerSession $customerSession
    ) {
        $this->customerSerializer = $customerSerializer;
        $this->customerSession = $customerSession;
        parent::__construct($logger, $webhookService, $authSession, $config);
    }

    public function execute(Observer $observer)
    {
        if (!$customer = $observer->getEvent()->getData('customer')) {
            return $this;
        }

        if ($this->customerSession->getIsCustomerNew()) {
            $event = $this->isAdmin() ? Event::EVENT_ADMIN_CUSTOMER_CREATED : Event::EVENT_CUSTOMER_CUSTOMER_REGISTERED;
        } else {
            $event = $this->isAdmin() ? Event::EVENT_ADMIN_CUSTOMER_UPDATED : Event::EVENT_CUSTOMER_CUSTOMER_UPDATED;
        }

        if ($this->isWebhookEnabled($event)) {
            $this->webhookService->sendWebhook($event, $this->customerSerializer->toArray($customer->getDataModel()));
        }

        return $this;
    }
}
