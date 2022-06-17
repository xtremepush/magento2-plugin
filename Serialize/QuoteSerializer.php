<?php

namespace Xtremepush\Module\Serialize;

use Magento\Quote\Api\Data\CartInterface;

class QuoteSerializer
{
    /** @var QuoteBillingAddressSerializer */
    private $billingAddressSerializer;

    /** @var CurrencySerializer */
    private $currencySerializer;

    /** @var CustomerSerializer */
    private $customerSerializer;

    public function __construct(
        QuoteBillingAddressSerializer $billingAddressSerializer,
        CurrencySerializer $currencySerializer,
        CustomerSerializer $customerSerializer
    ) {
        $this->billingAddressSerializer = $billingAddressSerializer;
        $this->currencySerializer = $currencySerializer;
        $this->customerSerializer = $customerSerializer;
    }

    /**
     * @param CartInterface $quote
     * @return array
     */
    public function toArray(CartInterface $quote)
    {
        return [
            'id' => $quote->getId(),
            'created_at' => $quote->getCreatedAt(),
            'updated_at' => $quote->getUpdatedAt(),
            'is_active' => $quote->getIsActive(),
            'is_virtual' => $quote->getIsVirtual(),
            'items_count' => $quote->getItemsCount(),
            'items_qty' => $quote->getItemsQty(),
            'customer' => $this->customerSerializer->toArray($quote->getCustomer()),
            'billing_address' => $this->billingAddressSerializer->toArray($quote->getBillingAddress()),
            'reserved_order_id' => $quote->getReservedOrderId(),
            'orig_order_id' => $quote->getOrigOrderId(),
            'currency' => $this->currencySerializer->toArray($quote->getCurrency()),
            'customer_is_guest' => $quote->getCustomerIsGuest(),
            'customer_note_notify' => $quote->getCustomerNoteNotify(),
            'customer_tax_class_id' => $quote->getCustomerTaxClassId(),
            'store_id' => $quote->getStoreId()
        ];
    }
}
