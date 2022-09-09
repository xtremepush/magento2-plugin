<?php

namespace Xtremepush\Core\Serialize;

use Magento\Quote\Api\Data\AddressInterface;

class QuoteBillingAddressSerializer
{
    /**
     * @param AddressInterface $address
     * @return array
     */
    public function toArray(AddressInterface $address)
    {
        return [
            'id' => $address->getId(),
            'region' => $address->getRegion(),
            'region_id' => $address->getRegionId(),
            'region_code' => $address->getRegionCode(),
            'country_id' => $address->getCountryId(),
            'street' => $address->getStreet(),
            'telephone' => $address->getTelephone(),
            'postcode' => $address->getPostcode(),
            'city' => $address->getCompany(),
            'firstname' => $address->getFirstname(),
            'email' => $address->getEmail(),
            'lastname' => $address->getLastname(),
            'same_as_billing' => $address->getSameAsBilling(),
        ];
    }
}
