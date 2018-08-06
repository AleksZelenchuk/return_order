<?php

namespace Namespace\ReturnOrder\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;
use Namespace\ReturnOrder\Block\Adminhtml\Grid\View;

class Delete extends \Magento\Backend\App\Action
{
    protected $_collection;
    protected $_gridView;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Namespace\ReturnOrder\Model\ReturnOrderFactory $collection,
        \Namespace\ReturnOrder\Block\Adminhtml\Grid\View $view
    ) {
        parent::__construct($context);
        $this->_gridView = $view;
        $this->_collection = $collection;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $col = $this->_collection->create();
                $row = $col->load($id);
                $files = $row->getFiles();
                $removeFiles = $this->_gridView->deleteAllFiles($files);
                $row->delete();
                $this->messageManager->addSuccess(
                    __('A record with id %1 have been deleted.', $id)
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
    }

    private function deleteFiles(){

    }
}
