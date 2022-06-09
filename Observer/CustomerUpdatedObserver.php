<?php

namespace Xtremepush\Module\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Module\Helper\WebhookService;
use Xtremepush\Module\Model\Event;
use Xtremepush\Module\Model\ModuleConfig;
use Xtremepush\Module\Serialize\CustomerSerializer;
use Magento\Customer\Api\CustomerRepositoryInterface;

class CustomerUpdatedObserver extends AbstractObserver
{
    /** @var CustomerSerializer */
    private $customerSerializer;

    /** @var CustomerRepositoryInterface */
    private $customerRepository;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config,
        CustomerRepositoryInterface $customerRepository,
        CustomerSerializer $customerSerializer
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerSerializer = $customerSerializer;
        parent::__construct($logger, $webhookService, $authSession, $config);
    }

    public function execute(Observer $observer)
    {
        $customer = $this->customerRepository->get($observer->getEvent()->getData('email'));
        if (!$customer) {
            return $this;
        }

        $event = $this->isAdmin() ? Event::EVENT_ADMIN_CUSTOMER_UPDATED : Event::EVENT_CUSTOMER_CUSTOMER_UPDATED;
        if ($this->isWebhookEnabled($event)) {
            $this->webhookService->sendWebhook($event, $this->customerSerializer->toArray($customer));
        }

        return $this;
    }
}
