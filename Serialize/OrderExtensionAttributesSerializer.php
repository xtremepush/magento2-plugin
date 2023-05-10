<?php

namespace Xtremepush\Core\Serialize;

use Magento\Sales\Api\Data\OrderExtensionInterface;

class OrderExtensionAttributesSerializer
{
    /**
     * @param OrderExtensionInterface|null $attributes
     * @return array
     */
    public function toArray(?OrderExtensionInterface $attributes)
    {
        if ($attributes !== null && method_exists($attributes, '__toArray')) {
            return $attributes->__toArray();
        }

        return [];
    }
}
