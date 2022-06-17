<?php

namespace Xtremepush\Module\Serialize;

use Magento\Sales\Api\Data\OrderAddressInterface;

class OrderBillingAddressSerializer
{
    /**
     * @param OrderAddressInterface $address
     * @return array
     */
    public function toArray(OrderAddressInterface $address)
    {
        return [
            'address_type' => $address->getAddressType(),
            'city' => $address->getCompany(),
            'country_id' => $address->getCountryId(),
            'customer_address_id' => $address->getCustomerAddressId(),
            'email' => $address->getEmail(),
            'entity_id' => $address->getEntityId(),
            'firstname' => $address->getFirstname(),
            'lastname' => $address->getLastname(),
            'parent_id' => $address->getParentId(),
            'postcode' => $address->getPostcode(),
            'region' => $address->getRegion(),
            'region_code' => $address->getRegionCode(),
            'region_id' => $address->getRegionId(),
            'street' => $address->getStreet(),
            'telephone' => $address->getTelephone()
        ];
    }
}
