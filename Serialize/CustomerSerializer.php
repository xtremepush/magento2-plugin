<?php

namespace Xtremepush\Module\Serialize;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Newsletter\Model\Subscriber;

class CustomerSerializer
{
    /** @var CustomerCustomAttributesSerializer */
    private $customAttributesSerializer;

    /** @var CustomerAddressesSerializer */
    private $addressesSerializer;

    /** @var CustomerExtensionAttributesSerializer */
    private $extensionAttributesSerializer;

    /** @var Subscriber */
    private $_subscriber;

    public function __construct(
        CustomerCustomAttributesSerializer $customAttributesSerializer,
        CustomerAddressesSerializer $addressesSerializer,
        CustomerExtensionAttributesSerializer $extensionAttributesSerializer,
        Subscriber $subscriber
    ) {
        $this->customAttributesSerializer = $customAttributesSerializer;
        $this->addressesSerializer = $addressesSerializer;
        $this->extensionAttributesSerializer = $extensionAttributesSerializer;
        $this->_subscriber = $subscriber;
    }

    public function toArray(CustomerInterface $customer)
    {
        $subscriber = $this->_subscriber->loadBySubscriberEmail($customer->getEmail(), $customer->getWebsiteId());

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
            'extension_attributes' =>
                array_merge(
                    ['is_subscribed' => $subscriber->isSubscribed()],
                    $this->extensionAttributesSerializer->toArray(
                        $customer->getExtensionAttributes()
                    )
                ),
            'custom_attributes' => $this->customAttributesSerializer->toArray($customer->getCustomAttributes())
        ];
    }
}
