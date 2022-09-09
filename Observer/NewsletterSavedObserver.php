<?php

namespace Xtremepush\Core\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Core\Helper\WebhookService;
use Xtremepush\Core\Model\Event;
use Xtremepush\Core\Model\ModuleConfig;
use Xtremepush\Core\Serialize\CustomerSerializer;

class NewsletterSavedObserver extends AbstractObserver
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
        if (!$subscriber = $observer->getEvent()->getData('subscriber')) {
            return $this;
        }

        if (!$customer = $this->customerRepository->get($subscriber->getEmail())) {
            return $this;
        }

        $event = $this->isAdmin() ? Event::EVENT_ADMIN_CUSTOMER_UPDATED : Event::EVENT_CUSTOMER_CUSTOMER_UPDATED;
        if ($this->isWebhookEnabled($event)) {
            $this->webhookService->sendWebhook($event, $this->customerSerializer->toArray($customer));
        }

        return $this;
    }
}
