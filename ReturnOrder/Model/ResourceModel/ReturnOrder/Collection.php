<?php

/**
 *
 * @Author              Ngo Quang Cuong <bestearnmoney87@gmail.com>
 * @Date                2016-12-16 02:04:31
 * @Last modified by:   nquangcuong
 * @Last Modified time: 2016-12-24 17:57:36
 */

namespace Fantronix\ReturnOrder\Model\ResourceModel\ReturnOrder;

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
        $this->_init('Fantronix\ReturnOrder\Model\ReturnOrder', 'Fantronix\ReturnOrder\Model\ResourceModel\ReturnOrder');
    }
}
