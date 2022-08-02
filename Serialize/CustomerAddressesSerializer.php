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
            $data[] = [
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

    /**
     * @param array $address
     * @return array
     */
    public function remapArray(array $address)
    {
        return [
            'id' => $address['id'] ?? '',
            'customer_id' => $address['customer_id'] ?? '',
            'region' => $address['region'] ?? '',
            'region_id' => $address['region_id'] ?? '',
            'country_id' => $address['country_id'] ?? '',
            'street' => $address['street'] ?? '',
            'telephone' => $address['telephone'] ?? '',
            'postcode' => $address['postcode'] ?? '',
            'city' => $address['city'] ?? '',
            'firstname' => $address['firstname'] ?? '',
            'lastname' => $address['lastname'] ?? '',
            'default_shipping' => $address['is_default_shipping'] ?? '',
            'default_billing' => $address['is_default_billing'] ?? ''
        ];
    }
}
