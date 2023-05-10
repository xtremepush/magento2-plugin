<?php

namespace Xtremepush\Core\Model;

use Magento\Sales\Model\Order;

class Event
{
    /* quote events */
    public const EVENT_ADMIN_QUOTE_CREATED = 'admin/quote/created';
    public const EVENT_CUSTOMER_QUOTE_CREATED = 'customer/quote/created';
    public const EVENT_ADMIN_QUOTE_UPDATED = 'admin/quote/updated';
    public const EVENT_CUSTOMER_QUOTE_UPDATED = 'customer/quote/updated';
    public const EVENT_ADMIN_QUOTE_COMPLETED = 'admin/quote/completed';
    public const EVENT_CUSTOMER_QUOTE_COMPLETED = 'customer/quote/completed';

    /* order events */
    public const EVENT_ADMIN_ORDER_CREATED = 'admin/order/created';
    public const EVENT_CUSTOMER_ORDER_CREATED = 'customer/order/created';
    public const EVENT_ADMIN_ORDERS_ADDRESS_UPDATED = 'admin/order/address/updated';
    public const EVENT_ORDER_STATE_NEW = 'admin/order/state/new';
    public const EVENT_ORDER_STATE_PENDING_PAYMENT = 'admin/order/state/pending_payment';
    public const EVENT_ORDER_STATE_PROCESSING = 'admin/order/state/processing';
    public const EVENT_ORDER_STATE_COMPLETE = 'admin/order/state/complete';
    public const EVENT_ORDER_STATE_CLOSED = 'admin/order/state/closed';
    public const EVENT_ORDER_STATE_CANCELED = 'admin/order/state/cancelled';
    public const EVENT_ORDER_STATE_HOLDED = 'admin/order/state/holded';
    public const EVENT_ORDER_STATE_PAYMENT_REVIEW = 'admin/order/state/payment_review';

    /* customer events */
    public const EVENT_CUSTOMER_CUSTOMER_REGISTERED = 'customer/customer/registered';
    public const EVENT_ADMIN_CUSTOMER_CREATED = 'admin/customer/created';
    public const EVENT_CUSTOMER_CUSTOMER_UPDATED = 'customer/customer/updated';
    public const EVENT_ADMIN_CUSTOMER_UPDATED = 'admin/customer/updated';
    public const EVENT_ADMIN_CUSTOMER_DELETED = 'admin/customer/deleted';

    /**
     * @param string $state
     * @return string
     */
    public static function getEventByState(string $state)
    {
        switch ($state) {
            case Order::STATE_CANCELED:
                return self::EVENT_ORDER_STATE_CANCELED;
            case Order::STATE_CLOSED:
                return self::EVENT_ORDER_STATE_CLOSED;
            case Order::STATE_COMPLETE:
                return self::EVENT_ORDER_STATE_COMPLETE;
            case Order::STATE_HOLDED:
                return self::EVENT_ORDER_STATE_HOLDED;
            case Order::STATE_NEW:
                return self::EVENT_ORDER_STATE_NEW;
            case Order::STATE_PAYMENT_REVIEW:
                return self::EVENT_ORDER_STATE_PAYMENT_REVIEW;
            case Order::STATE_PENDING_PAYMENT:
                return self::EVENT_ORDER_STATE_PENDING_PAYMENT;
            case Order::STATE_PROCESSING:
                return self::EVENT_ORDER_STATE_PROCESSING;
            default:
                return '';
        }
    }

    /**
     * @param string $event
     * @return string
     */
    public static function getPermissionByEvent(string $event)
    {
        switch ($event) {
            case self::EVENT_ADMIN_QUOTE_CREATED:
            case self::EVENT_CUSTOMER_QUOTE_CREATED:
            case self::EVENT_ADMIN_QUOTE_UPDATED:
            case self::EVENT_CUSTOMER_QUOTE_UPDATED:
            case self::EVENT_ADMIN_QUOTE_COMPLETED:
            case self::EVENT_CUSTOMER_QUOTE_COMPLETED:
                return ModuleConfig::WEBHOOK_QUOTES;

            case self::EVENT_ADMIN_ORDER_CREATED:
            case self::EVENT_CUSTOMER_ORDER_CREATED:
            case self::EVENT_ADMIN_ORDERS_ADDRESS_UPDATED:
            case self::EVENT_ORDER_STATE_NEW:
            case self::EVENT_ORDER_STATE_PENDING_PAYMENT:
            case self::EVENT_ORDER_STATE_PROCESSING:
            case self::EVENT_ORDER_STATE_COMPLETE:
            case self::EVENT_ORDER_STATE_CLOSED:
            case self::EVENT_ORDER_STATE_CANCELED:
            case self::EVENT_ORDER_STATE_HOLDED:
            case self::EVENT_ORDER_STATE_PAYMENT_REVIEW:
                return ModuleConfig::WEBHOOK_ORDERS;

            case self::EVENT_CUSTOMER_CUSTOMER_REGISTERED:
            case self::EVENT_ADMIN_CUSTOMER_CREATED:
            case self::EVENT_CUSTOMER_CUSTOMER_UPDATED:
            case self::EVENT_ADMIN_CUSTOMER_UPDATED:
            case self::EVENT_ADMIN_CUSTOMER_DELETED:
                return ModuleConfig::WEBHOOK_CUSTOMERS;
            default:
                return '';
        }
    }
}
