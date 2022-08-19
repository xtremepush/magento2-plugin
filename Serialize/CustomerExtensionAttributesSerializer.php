<?php

namespace Xtremepush\Core\Serialize;

use Magento\Customer\Api\Data\CustomerExtensionInterface;

class CustomerExtensionAttributesSerializer
{
    /**
     * @param CustomerExtensionInterface|null $attributes
     * @return array
     */
    public function toArray(?CustomerExtensionInterface $attributes)
    {
        if ($attributes !== null && method_exists($attributes, '__toArray')) {
            return $attributes->__toArray();
        }

        return [];
    }
}
