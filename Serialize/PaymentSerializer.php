<?php

namespace Xtremepush\Core\Serialize;

use Magento\Sales\Api\Data\OrderPaymentInterface;

class PaymentSerializer
{
    /**
     * @param OrderPaymentInterface $payment
     * @return array
     */
    public function toArray(OrderPaymentInterface $payment)
    {
        return [
            'account_status' => $payment->getAccountStatus(),
            'additional_information' => $payment->getAdditionalInformation(),
            'amount_ordered' =>$payment->getAmountOrdered(),
            'amount_paid' => $payment->getAmountPaid(),
            'base_amount_ordered' => $payment->getBaseAmountOrdered(),
            'base_amount_paid' => $payment->getBaseAmountPaid(),
            'base_shipping_amount' => $payment->getBaseShippingAmount(),
            'base_shipping_captured' => $payment->getBaseShippingCaptured(),
            'cc_last4' => $payment->getCcLast4(),
            'entity_id' => $payment->getEntityId(),
            'method' => $payment->getMethod(),
            'parent_id' => $payment->getParentId(),
            'shipping_amount' => $payment->getShippingAmount(),
            'shipping_captured' => $payment->getShippingCaptured()
        ];
    }
}
