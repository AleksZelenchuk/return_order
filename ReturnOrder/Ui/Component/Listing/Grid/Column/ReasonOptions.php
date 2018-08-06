<?php

namespace Namespace\ReturnOrder\Ui\Component\Listing\Grid\Column;

class ReasonOptions implements \Magento\Framework\Option\ArrayInterface
{
    //Here you can __construct Model

    public function toOptionArray()
    {
        return [['value' => 1, 'label' => __('Item Faulty')],
            ['value' => 2, 'label' => __('Item not as described')],
            ['value' => 3, 'label' => __('Item ordered incorrectly')],
            ['value' => 4, 'label' => __('Item Damaged')],
            ['value' => 6, 'label' => __('Change of mind')],
            ['value' => 8, 'label' => __('Other')]];
    }
}
