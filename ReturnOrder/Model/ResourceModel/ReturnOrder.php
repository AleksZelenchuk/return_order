<?php
namespace Fantronix\ReturnOrder\Model\ResourceModel;

/**
 * ReturnOrder Resource Model
 */
class ReturnOrder extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct(){
        $this->_init('order_refund_data_table', 'id');
    }
}