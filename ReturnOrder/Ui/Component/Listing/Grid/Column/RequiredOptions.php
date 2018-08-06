<?php

namespace Namespace\ReturnOrder\Ui\Component\Listing\Grid\Column;

class RequiredOptions implements \Magento\Framework\Option\ArrayInterface
{
    //Here you can __construct Model

    public function toOptionArray()
    {
        return [['value' => 1, 'label' => __('Refund')],
            ['value' => 2, 'label' => __('Replacement')],
            ['value' => 3, 'label' => __('Spare Part')],
            ['value' => 4, 'label' => __('Other')] ];
    }
}
