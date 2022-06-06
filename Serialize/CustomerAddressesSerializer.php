<?php

namespace Xtremepush\Module\Serialize;

use Magento\Customer\Api\Data\AddressInterface;

class CustomerAddressesSerializer
{
    /**
     * @param AddressInterface[]|null $addresses
     * @return array
     */
    public function toArray(?array $addresses)
    {
        $data = [];

        foreach ($addresses ?? [] as $address) {
            return [
                'id' => $address->getId(),
                'customer_id' => $address->getCustomerId(),
                'region' => $address->getRegion(),
                'region_id' => $address->getRegionId(),
                'country_id' => $address->getCountryId(),
                'street' => $address->getStreet(),
                'telephone' => $address->getTelephone(),
                'postcode' => $address->getPostcode(),
                'city' => $address->getCity(),
                'firstname' => $address->getFirstname(),
                'lastname' => $address->getLastname(),
                'default_shipping' => $address->isDefaultShipping(),
                'default_billing' => $address->isDefaultBilling()
            ];
        }

        return $data;
    }
}
