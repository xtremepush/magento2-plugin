<?php

namespace Xtremepush\Module\Serialize;

use Magento\Customer\Api\Data\CustomerInterface;

class CustomerSerializer
{
    /** @var CustomerCustomAttributesSerializer */
    private $customAttributesSerializer;

    /** @var CustomerAddressesSerializer */
    private $addressesSerializer;

    public function __construct(
        CustomerCustomAttributesSerializer $customAttributesSerializer,
        CustomerAddressesSerializer $addressesSerializer
    )
    {
        $this->customAttributesSerializer = $customAttributesSerializer;
        $this->addressesSerializer = $addressesSerializer;
    }

    public function toArray(CustomerInterface $customer)
    {
        return [
            'id' => $customer->getId(),
            'group_id' => $customer->getGroupId(),
            'default_billing' => $customer->getDefaultBilling(),
            'default_shipping' => $customer->getDefaultShipping(),
            'created_at' => $customer->getCreatedAt(),
            'updated_at' => $customer->getUpdatedAt(),
            'created_in' => $customer->getCreatedIn(),
            'dob' => $customer->getDob(),
            'email' => $customer->getEmail(),
            'firstname' => $customer->getFirstname(),
            'lastname' => $customer->getLastname(),
            'gender' => $customer->getGender(),
            'store_id' => $customer->getStoreId(),
            'website_id' => $customer->getWebsiteId(),
            'addresses' => $this->addressesSerializer->toArray($customer->getAddresses()),
            'disable_auto_group_change' => $customer->getDisableAutoGroupChange(),
            'extension_attributes' => $customer->getExtensionAttributes()->__toArray(),
            'custom_attributes' => $this->customAttributesSerializer->toArray($customer->getCustomAttributes())
        ];
    }
}
