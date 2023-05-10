<?php

namespace Xtremepush\Core\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Customer\Model\Address;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Xtremepush\Core\Helper\WebhookService;
use Xtremepush\Core\Model\Event;
use Xtremepush\Core\Model\ModuleConfig;
use Xtremepush\Core\Serialize\CustomerAddressesSerializer;
use Xtremepush\Core\Serialize\CustomerSerializer;

class CustomerAddressSavedAfterObserver extends AbstractObserver
{
    /** @var CustomerSerializer */
    private $customerSerializer;

    /** @var CustomerAddressesSerializer */
    private $addressesSerializer;

    public function __construct(
        LoggerInterface $logger,
        WebhookService $webhookService,
        Session $authSession,
        ModuleConfig $config,
        CustomerSerializer $customerSerializer,
        CustomerAddressesSerializer $addressesSerializer
    ) {
        $this->customerSerializer = $customerSerializer;
        $this->addressesSerializer = $addressesSerializer;
        parent::__construct($logger, $webhookService, $authSession, $config);
    }

    public function execute(Observer $observer)
    {
        /** @var Address $address */
        $address = $observer->getData('customer_address');
        if (!$address || $this->isAdmin() || !$customer = $address->getCustomer()) {
            return $this;
        }

        $addresses = $customer->getAddresses();
        $customer = $this->customerSerializer->toArray($customer->getDataModel());
        if (empty($addresses)) {
            $address = $address->getData();
            $customer['addresses'][] = $this->addressesSerializer->remapArray($address);
            if ($address['is_default_billing'] == '1') {
                $customer['default_billing'] = $address['id'];
            }
            if ($address['is_default_shipping'] == '1') {
                $customer['default_shipping'] = $address['id'];
            }
        }

        if ($this->isWebhookEnabled(Event::EVENT_CUSTOMER_CUSTOMER_UPDATED)) {
            $this->webhookService->sendWebhook(Event::EVENT_CUSTOMER_CUSTOMER_UPDATED, $customer);
        }

        return $this;
    }
}
