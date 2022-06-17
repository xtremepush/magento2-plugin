<?php

namespace Xtremepush\Module\Serialize;

use Magento\Framework\Api\AttributeInterface;

class CustomerCustomAttributesSerializer
{
    /**
     * @param AttributeInterface[] $attributes
     * @return array
     */
    public function toArray(array $attributes)
    {
        $data = [];

        foreach ($attributes as $attribute) {
            $data[] = $attribute->__toArray();
        }

        return $data;
    }
}
