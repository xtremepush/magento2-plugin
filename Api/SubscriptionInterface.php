<?php

namespace Xtremepush\Core\Api;

interface SubscriptionInterface
{
    /**
     * Handle Xtremepush subscription statuses on Magento shop side
     *
     * @param int $customerId
     * @param bool $status
     * @param int $storeId
     * @return bool
     */
    public function handleSubscriptionStatus(int $customerId, bool $status, int $storeId);
}
