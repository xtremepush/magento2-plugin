<?php

namespace Xtremepush\Module\Serialize;

use Magento\Sales\Api\Data\OrderItemInterface;

class OrderItemsSerializer
{
    /**
     * @param OrderItemInterface[] $items
     * @return array
     */
    public function toArray(array $items)
    {
        $data = [];

        foreach ($items as $item){
            $data[] = [
                'amount_refunded' => $item->getAmountRefunded(),
                'applied_rule_ids' => $item->getAppliedRuleIds(),
                'base_amount_refunded' => $item->getBaseAmountRefunded(),
                'base_discount_amount' => $item->getBaseDiscountAmount(),
                'base_discount_invoiced' => $item->getBaseDiscountInvoiced(),
                'base_discount_tax_compensation_amount' => $item->getBaseDiscountTaxCompensationAmount(),
                'base_discount_tax_compensation_invoiced' => $item->getBaseDiscountTaxCompensationInvoiced(),
                'base_original_price' => $item->getBaseOriginalPrice(),
                'base_price' => $item->getPrice(),
                'base_price_incl_tax' => $item->getBasePriceInclTax(),
                'base_row_invoiced' => $item->getBaseRowInvoiced(),
                'base_row_total' => $item->getBaseRowTotal(),
                'base_row_total_incl_tax' => $item->getBaseRowTotalInclTax(),
                'base_tax_amount' => $item->getBaseTaxAmount(),
                'base_tax_invoiced' => $item->getBaseTaxInvoiced(),
                'created_at' => $item->getCreatedAt(),
                'discount_amount' => $item->getDiscountAmount(),
                'discount_invoiced' => $item->getDiscountInvoiced(),
                'discount_percent' => $item->getDiscountPercent(),
                'free_shipping' => $item->getFreeShipping(),
                'discount_tax_compensation_amount' => $item->getDiscountTaxCompensationAmount(),
                'discount_tax_compensation_invoiced' => $item->getDiscountTaxCompensationInvoiced(),
                'is_qty_decimal' => $item->getIsQtyDecimal(),
                'item_id' => $item->getItemId(),
                'name' => $item->getName(),
                'no_discount' => $item->getNoDiscount(),
                'order_id' => $item->getOrderId(),
                'original_price' => $item->getOriginalPrice(),
                'price' => $item->getPrice(),
                'price_incl_tax' => $item->getPriceInclTax(),
                'product_id' => $item->getProductId(),
                'product_type' => $item->getProductType(),
                'qty_canceled' => $item->getQtyCanceled(),
                'qty_invoiced' => $item->getQtyInvoiced(),
                'qty_ordered' => $item->getQtyOrdered(),
                'qty_refunded' => $item->getQtyRefunded(),
                'qty_shipped' => $item->getQtyShipped(),
                'row_invoiced' => $item->getRowInvoiced(),
                'row_total' => $item->getRowTotal(),
                'row_total_incl_tax' => $item->getRowTotalInclTax(),
                'row_weight' => $item->getRowWeight(),
                'sku' => $item->getSku(),
                'store_id' => $item->getStoreId(),
                'tax_amount' => $item->getTaxAmount(),
                'tax_invoiced' => $item->getTaxInvoiced(),
                'tax_percent' => $item->getTaxPercent(),
                'updated_at' => $item->getUpdatedAt(),
                'weight' => $item->getWeight(),
                'product_option' => $item->getProductOptions()
            ];
        }

        return $data;
    }
}
