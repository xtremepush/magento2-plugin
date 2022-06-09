<?php

namespace Xtremepush\Module\Serialize;

use Magento\Sales\Api\Data\OrderInterface;

class OrderSerializer
{
    /** @var OrderBillingAddressSerializer */
    private $billingAddressSerializer;

    /** @var PaymentSerializer */
    private $paymentSerializer;

    /** @var OrderItemsSerializer */
    private $orderItemsSerializer;

    /** @var OrderExtensionAttributesSerializer */
    private $extensionAttributesSerializer;

    public function __construct(
        OrderBillingAddressSerializer $billingAddressSerializer,
        PaymentSerializer $paymentSerializer,
        OrderItemsSerializer $orderItemsSerializer,
        OrderExtensionAttributesSerializer $extensionAttributesSerializer
    )
    {
        $this->billingAddressSerializer = $billingAddressSerializer;
        $this->paymentSerializer = $paymentSerializer;
        $this->orderItemsSerializer = $orderItemsSerializer;
        $this->extensionAttributesSerializer = $extensionAttributesSerializer;
    }

    /**
     * @param OrderInterface $order
     * @return array
     */
    public function toArray(OrderInterface $order)
    {
        return [
            'applied_rule_ids' => $order->getAppliedRuleIds(),
            'base_currency_code' => $order->getBaseCurrencyCode(),
            'base_discount_amount' => $order->getBaseDiscountAmount(),
            'base_discount_invoiced' => $order->getBaseDiscountInvoiced(),
            'base_grand_total' => $order->getBaseGrandTotal(),
            'base_discount_tax_compensation_amount' => $order->getBaseDiscountTaxCompensationAmount(),
            'base_discount_tax_compensation_invoiced' => $order->getBaseDiscountTaxCompensationInvoiced(),
            'base_shipping_amount' => $order->getBaseShippingAmount(),
            'base_shipping_discount_amount' => $order->getBaseShippingDiscountAmount(),
            'base_shipping_discount_tax_compensation_amnt' => $order->getBaseShippingDiscountTaxCompensationAmnt(),
            'base_shipping_incl_tax' => $order->getBaseShippingInclTax(),
            'base_shipping_invoiced' => $order->getShippingInvoiced(),
            'base_shipping_tax_amount' => $order->getBaseShippingTaxAmount(),
            'base_subtotal' => $order->getBaseSubtotal(),
            'base_subtotal_incl_tax' => $order->getBaseSubtotalInclTax(),
            'base_subtotal_invoiced' => $order->getBaseSubtotalInvoiced(),
            'base_tax_amount' => $order->getBaseTaxAmount(),
            'base_tax_invoiced' => $order->getBaseTaxInvoiced(),
            'base_total_due' => $order->getBaseTotalDue(),
            'base_total_invoiced' => $order->getBaseTotalInvoiced(),
            'base_total_invoiced_cost' => $order->getBaseTotalInvoicedCost(),
            'base_total_paid' => $order->getBaseTotalPaid(),
            'base_to_global_rate' => $order->getBaseToGlobalRate(),
            'base_to_order_rate' => $order->getBaseToOrderRate(),
            'billing_address_id' => $order->getBillingAddressId(),
            'coupon_code' => $order->getCouponCode(),
            'created_at' => $order->getCreatedAt(),
            'customer_dob' => $order->getCustomerDob(),
            'customer_email' => $order->getCustomerEmail(),
            'customer_firstname' => $order->getCustomerFirstname(),
            'customer_gender' => $order->getCustomerGender(),
            'customer_group_id' => $order->getCustomerGroupId(),
            'customer_id' => $order->getCustomerId(),
            'customer_is_guest' => $order->getCustomerIsGuest(),
            'customer_lastname' => $order->getCustomerLastname(),
            'customer_note_notify' => $order->getCustomerNoteNotify(),
            'discount_amount' => $order->getDiscountAmount(),
            'discount_invoiced' => $order->getDiscountInvoiced(),
            'entity_id' => $order->getEntityId(),
            'global_currency_code' => $order->getGlobalCurrencyCode(),
            'grand_total' => $order->getGrandTotal(),
            'discount_tax_compensation_amount' => $order->getDiscountTaxCompensationAmount(),
            'discount_tax_compensation_invoiced' => $order->getDiscountTaxCompensationInvoiced(),
            'hold_before_state' => $order->getHoldBeforeState(),
            'hold_before_status' => $order->getHoldBeforeStatus(),
            'increment_id' => $order->getIncrementId(),
            'is_virtual' => $order->getIsVirtual(),
            'order_currency_code' => $order->getOrderCurrencyCode(),
            'protect_code' => $order->getProtectCode(),
            'quote_id' => $order->getQuoteId(),
            'shipping_amount' => $order->getShippingAmount(),
            'shipping_description' => $order->getShippingDescription(),
            'shipping_discount_amount' => $order->getShippingDiscountAmount(),
            'shipping_discount_tax_compensation_amount' => $order->getShippingDiscountTaxCompensationAmount(),
            'shipping_incl_tax' => $order->getShippingInclTax(),
            'shipping_invoiced' => $order->getShippingInvoiced(),
            'shipping_tax_amount' => $order->getShippingTaxAmount(),
            'state' => $order->getState(),
            'status' => $order->getStatus(),
            'store_currency_code' => $order->getStoreCurrencyCode(),
            'store_id' => $order->getStoreId(),
            'store_name' => $order->getStoreName(),
            'store_to_base_rate' => $order->getStoreToBaseRate(),
            'store_to_order_rate' => $order->getStoreToOrderRate(),
            'subtotal' => $order->getSubtotal(),
            'subtotal_incl_tax' => $order->getSubtotalInclTax(),
            'subtotal_invoiced' => $order->getSubtotalInvoiced(),
            'tax_amount' => $order->getTaxAmount(),
            'tax_invoiced' => $order->getTaxInvoiced(),
            'total_due' => $order->getTotalDue(),
            'total_invoiced' => $order->getTotalInvoiced(),
            'total_item_count' => $order->getTotalItemCount(),
            'total_paid' => $order->getTotalPaid(),
            'total_qty_ordered' => $order->getTotalQtyOrdered(),
            'updated_at' => $order->getUpdatedAt(),
            'weight' => $order->getWeight(),
            'billing_address' => $this->billingAddressSerializer->toArray($order->getBillingAddress()),
            'payment' => $this->paymentSerializer->toArray($order->getPayment()),
            'extension_attributes' => $this->extensionAttributesSerializer->toArray($order->getExtensionAttributes()),
            'items' => $this->orderItemsSerializer->toArray($order->getItems())
        ];
    }
}
