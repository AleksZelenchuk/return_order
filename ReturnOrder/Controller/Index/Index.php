<?php

namespace Fantronix\ReturnOrder\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Fantronix\ReturnOrder\Helper\SendEmail;
use Magento\Setup\Exception;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;

    protected $storeManager;

    protected $sendEmail;

    protected $transportBuilder;

    protected $filesystem;

    protected $returnOrder;

    protected $datetime;

    protected $fileUploaderFactory;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Filesystem $filesystem,
        \Fantronix\ReturnOrder\Model\ReturnOrder $returnOrder,
        \Magento\Framework\Stdlib\DateTime\DateTime $datetime,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        SendEmail $sendEmail
    )
    {
        $this->pageFactory = $pageFactory;
        $this->storeManager = $storeManager;
        $this->sendEmail = $sendEmail;
        $this->transportBuilder = $transportBuilder;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->returnOrder = $returnOrder;
        $this->datetime = $datetime;
        $this->fileUploaderFactory = $fileUploaderFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $fileNames = array();
        $filesArray = array();
        $allowed = array('png', 'jpg', 'gif','jpeg', 'pdf');
        $post = $this->getRequest()->getParams();
        if ($post) {
            if ($_FILES['upl']['name']['0']) {
                $files = $this->_reArrayFiles($_FILES['upl']);
                foreach ($files as $file) {
                    try{
                        $target = $this->_mediaDirectory->getAbsolutePath('returnOrder_img');
                        if (!is_dir($target)) {
                            if (!mkdir($target, 0777, true)) {
                                throw new \Exception(__('Can\'t create directory!'));
                            }
                        }
                        $uploader = $this->fileUploaderFactory->create(['fileId' => $file]);
                        $uploader->setAllowedExtensions($allowed);
                        $uploader->setAllowRenameFiles(true);
                        $img = $uploader->save($target);
                        $filesArray[] = $img;
                    } catch (\Exception $e) {
                        $this->messageManager->addError($e->getMessage());
                    }
                }
            }

            foreach ($filesArray as $fileInfo) {
                $fileNames[] = $fileInfo['file'];
            }

            $requestId = $this->saveInfo($post, !empty($fileNames)? $fileNames : null);

            try {
                $receiverInfo = [
                    'name' => $post['delivery-first-name'].' '.$post['delivery-second-name'],
                    'email' => $post['delivery-email']
                ];

                $emailTempVariables = $post;
                $emailTempVariables['request-id'] = $requestId;

                $this->sendEmail->sendEmailMessage(
                    $emailTempVariables,
                    $receiverInfo
                );
                
            } catch (Exception $e){

            }
        }
        return $this->pageFactory->create();
    }

    /**
     * @param $data
     * @param null $files files array
     * @throws \Exception
     * @return int
     */

    private function saveInfo($data, $files = null)
    {
        if ($data) {
            try {
                $error = false;
                if (!\Zend_Validate::is(trim($data['delivery-first-name']), 'NotEmpty')) {
                    $error = true;
                }
                if (!\Zend_Validate::is(trim($data['delivery-second-name']), 'NotEmpty')) {
                    $error = true;
                }
                if (!\Zend_Validate::is(trim($data['delivery-email']), 'EmailAddress')) {
                    $error = true;
                }
                if (!\Zend_Validate::is(trim($data['delivery-adress-postcode']), 'NotEmpty')) {
                    $error = true;
                }
                if (!\Zend_Validate::is(trim($data['delivery-order-id']), 'NotEmpty')) {
                    $error = true;
                }
                if (!\Zend_Validate::is(trim($data['delivery-warranty']), 'NotEmpty')) {
                    $error = true;
                }
                if (!\Zend_Validate::is(trim($data['delivery-description']), 'NotEmpty')) {
                    $error = true;
                }
                if (!\Zend_Validate::is(trim($data['delivery-what-required']), 'NotEmpty')) {
                    $error = true;
                }
                if ($error) {
                    throw new \Exception();
                }

                $currentData = $this->datetime->gmtDate();
                $this->returnOrder->setFirstname($data['delivery-first-name']);
                $this->returnOrder->setLastname($data['delivery-second-name']);
                $this->returnOrder->setEmail($data['delivery-email']);
                $this->returnOrder->setContactNumber($data['delivery-contact-number']);
                $this->returnOrder->setAddress($data['delivery-adress-postcode']);
                $this->returnOrder->setOrderNumber($data['delivery-order-id']);
                $this->returnOrder->setPurchaseDate($data['delivery-date-value']);
                $this->returnOrder->setProductData($data['delivery-order-details']);
                $this->returnOrder->setContactReason($data['delivery-contact-reason']);
                $this->returnOrder->setExplanation($data['delivery-explanation']);
                $this->returnOrder->setWarranty($data['delivery-warranty']);
                $this->returnOrder->setProblemDescription($data['delivery-description']);
                $this->returnOrder->setWhatRequired($data['delivery-what-required']);
                $this->returnOrder->setParagraph($data['delivery-paragraph']);
                $this->returnOrder->setCreatedAt($currentData);

                if ($files) {
                    $filesString = implode(",", $files);
                    $this->returnOrder->setFiles($filesString);
                }
                try {
                    $data = $this->returnOrder->save();
                    $this->messageManager->addSuccess(__('Refund request was created'));
                    return $data->getId();
                } catch (Exception $e) {

                }
            } catch (Exception $e){

            }
        }
    }

    /**
     * @param $file_post
     * @return array
     */
    private function _reArrayFiles(&$file_post)
    {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }
}