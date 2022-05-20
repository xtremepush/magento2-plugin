<?php

namespace Xtremepush\Module\Model;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Newsletter\Model\SubscriptionManager;
use Xtremepush\Module\Api\SubscriptionInterface;

class Subscription implements SubscriptionInterface
{
    /** @var SubscriptionManager */
    protected $subscriptionManager;

    /** @var CustomerFactory */
    protected $customerFactory;

    public function __construct(
        SubscriptionManager $subscriptionManager,
        CustomerFactory $customerFactory
    ) {
        $this->subscriptionManager = $subscriptionManager;
        $this->customerFactory = $customerFactory;
    }

    /**
     * @throws NotFoundException
     */
    public function handleSubscriptionStatus(int $customerId, bool $status, int $storeId)
    {
        if (!$customerId || !$storeId) {
            throw new NotFoundException(__('Invalid customer or/and store IDs'));
        }

        $customer = $this->customerFactory->create()
            ->addFilter('entity_id', $customerId)
            ->addFilter('store_id', $storeId)
            ->getData();

        if (!$customer) {
            throw new NotFoundException(__("Customer doesn't exist"));
        }

        if ($status === true) {
            $this->subscriptionManager->subscribeCustomer($customerId, $storeId);
            return;
        }

        $this->subscriptionManager->unsubscribeCustomer($customerId, $storeId);
    }
}
