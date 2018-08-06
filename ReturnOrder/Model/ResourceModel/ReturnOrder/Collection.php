<?php

namespace Namespace\ReturnOrder\Model\ResourceModel\ReturnOrder;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('Namespace\ReturnOrder\Model\ReturnOrder', 'Namespace\ReturnOrder\Model\ResourceModel\ReturnOrder');
    }
}
