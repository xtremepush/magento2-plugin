<?php

namespace Xtremepush\Module\Serialize;

use Magento\Quote\Api\Data\CurrencyInterface;

class CurrencySerializer
{
    /**
     * @param CurrencyInterface $currency
     * @return array
     */
    public function toArray(CurrencyInterface $currency)
    {
        return [
            'global_currency_code' => $currency->getGlobalCurrencyCode(),
            'base_currency_code' => $currency->getBaseCurrencyCode(),
            'store_currency_code' => $currency->getStoreCurrencyCode(),
            'quote_currency_code' => $currency->getQuoteCurrencyCode(),
            'store_to_base_rate' => $currency->getStoreToBaseRate(),
            'store_to_quote_rate' => $currency->getStoreToQuoteRate(),
            'base_to_global_rate' => $currency->getBaseToGlobalRate(),
            'base_to_quote_rate' => $currency->getBaseToQuoteRate()
        ];
    }
}
