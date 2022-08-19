<?php

namespace Xtremepush\Core\Block\Adminhtml\System\Config\Form\Field;

use Magento\Framework\Data\OptionSourceInterface;

class Yesno implements OptionSourceInterface
{
    /** @return array */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Yes')],
            ['value' => 0, 'label' => __('No')],
        ];
    }
}
