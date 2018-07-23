<?php
/**
 * Fantronix\ReturnOrder List Controller.
 */
namespace Fantronix\ReturnOrder\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;

class View extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;
    /**
     * @var \Fantronix\ReturnOrder\Model\GridFactory
     */
    private $gridFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Fantronix\ReturnOrder\Model\ReturnOrderFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->gridFactory = $gridFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->gridFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getEmail();
            if (!$rowData->getId()) {
                $this->messageManager->addError(__('Data no longer exist.'));
                $this->_redirect('returnorder/grid/index');
                return;
            }
        }
        $this->coreRegistry->register('row_data_view', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('View Request'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Fantronix_ReturnOrder::addrow');
    }
}