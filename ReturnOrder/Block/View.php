<?php

namespace Namespace\ReturnOrder\Block;

class View extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\Filesystem $filesystem
     *
     */
    protected $filesystem;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     *
     * @param array $data
     */
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
                                \Magento\Framework\Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }

    /**
     * Retrieve form action
     *
     * @return string
     */
    public function getFormAction()
    {
        $baseUrl = $this->getBaseUrl();
        return $baseUrl.'returnorder/index/index';
    }
    /**
     * Get options for Contact Reason select
     *
     * @return array
     */
    public function getContactReasonOptions()
    {
        $options = array(
            1 => "Item Faulty",
            4 => "Item Damaged",
            2 => "Item not as described",
            3 => "Item ordered incorrectly",
            6 => "Change of mind",
            8 => "Other"
        );
        return $options;
    }

    /**
     * Get options for What is Required select
     *
     * @return array
     */
    public function getWhatRequiredOptions()
    {
        $options = array(
            1 => "Refund",
            2 => "Replacement",
            3 => "Spare Part",
            4 => "Other"
        );
        return $options;
    }

}
