<?php

namespace Namespace\ReturnOrder\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;
use Namespace\ReturnOrder\Block\Adminhtml\Grid\View;
use Magento\Ui\Component\MassAction\Filter;
use Namespace\ReturnOrder\Model\ResourceModel\ReturnOrder\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $_collection;
    protected $_gridView;
    /**
     * @var Filter
     */
    protected $filter;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        CollectionFactory $collection,
        View $view,
        Filter $filter
    ) {
        parent::__construct($context);
        $this->_gridView = $view;
        $this->_collection = $collection;
        $this->filter = $filter;
    }

    public function execute()
    {
        $col = $this->filter->getCollection($this->_collection->create());
        $collectionSize = $col->getSize();
        try {
            foreach ($col as $page) {
                $files = $page->getFiles();
                $this->_gridView->deleteAllFiles($files);
                $page->delete();
            }
            $this->messageManager->addSuccess(
                __('A total of %1 record(s) have been deleted.', $collectionSize)
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $this->_redirect('uigrid/grid/index');
    }
}
