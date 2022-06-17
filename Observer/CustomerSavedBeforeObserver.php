<?php

namespace Xtremepush\Module\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Module\Helper\WebhookService;
use Xtremepush\Module\Model\ModuleConfig;

class CustomerSavedBeforeObserver extends AbstractObserver
{
    /** @var CustomerSession */
    private $customerSession;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config,
        CustomerSession $customerSession
    ) {
        $this->customerSession = $customerSession;
        parent::__construct($logger, $webhookService, $authSession, $config);
    }

    public function execute(Observer $observer)
    {
        if (!$customer = $observer->getEvent()->getData('customer')) {
            return $this;
        }

        $this->customerSession->setIsCustomerNew((bool)$customer->isObjectNew());
        return $this;
    }
}
