<?php
/**
 * Fantronix\ReturnOrder Add Row Form Block.
 */
namespace Fantronix\ReturnOrder\Block\Adminhtml\Grid;


use Magento\Setup\Exception;

class View extends \Magento\Framework\View\Element\Template
{
    /**
     * Core registry.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    protected $_container;
    protected $_options;
    protected $_mediaDirectory;
    protected $_storeManager;
    protected $_directoryList;
    protected $_urlBuilder;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry           $registry
     * @param array                                 $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Block\Widget\Form\Container $container,
        \Fantronix\ReturnOrder\Block\View $view,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem\DirectoryList $directoryList,
        \Magento\Backend\Model\UrlInterface $urlBuilder,
        array $data = []
    )
    {
        $this->_options = $view;
        $this->_container = $container;
        $this->_coreRegistry = $registry;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_storeManager = $storeManager;
        $this->_directoryList = $directoryList;
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Initialize Imagegallery Images Edit Block.
     */
    protected function _construct()
    {

        $this->_objectId = 'row_id';
        $this->_blockGroup = 'Fantronix_ReturnOrder';
        $this->_controller = 'adminhtml_grid';
        parent::_construct();
    }

    /**
     * Retrieve text for header element depending on loaded image.
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('View Data');
    }

    public function getRefundOrder()
    {
        $data = $this->_coreRegistry->registry('row_data_view');
        return $data;
    }
    public function getAdminUrl($url = null){
        $urlPath = $this->_urlBuilder->getUrl($url);
        return $urlPath;
    }
    /**
     * Retrieve option for dropdown.
     *
     * @return string
     */
    public function getOption($reason = null, $required = null)
    {
        if ($reason || $required) {
            $val = null;
            $opt = null;
            if ($reason) {
                $val = $reason;
                $opt = $this->_options->getContactReasonOptions();
            } elseif ($required) {
                $val = $required;
                $opt = $this->_options->getWhatRequiredOptions();
            }
            if ($opt && $val) {
                foreach ($opt as $key => $value) {
                    if ($val == $key){
                        return $value;
                    }
                }
            }
        }
    }
    public function getAbsolutePath()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
    /**
     * Retrieve images folder absolute path.
     *
     * @return string
     */
    public function getFilePath()
    {
        $mediaUrl = $this ->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA ).'returnOrder_img';
        return $mediaUrl;
    }
    public function getFileAbsolutePath()
    {
        $mediaUrl = $this->_directoryList->getPath('media').DIRECTORY_SEPARATOR.'returnOrder_img';
        return $mediaUrl;
    }
    /**
     * Retrieve image url.
     *
     * @return string
     */
    public function getImgPath($img)
    {
        if ($img) {
            $path = $this->getFilePath() . DIRECTORY_SEPARATOR .$img;
            return $path;
        }
    }
    /**
     * Parse images string.
     * $images - string.
     *
     * @return array
     */
    public function parseImages($images)
    {
        if ($images) {
            $result = explode(',', $images);
            return $result;
        }
    }
    /**
     * Check file existence.
     *
     * @return array
     */
    public function checkIfFileExist($img)
    {
        if ($img) {
            $fileDir = $this->getFileAbsolutePath().DIRECTORY_SEPARATOR.$img;
            if (file_exists($fileDir)) {
                return true;
            }
        }
        return false;
    }
    public function checkFileFormat($img)
    {
        if ($img) {
            $nameArr = explode('.', $img);
            return end($nameArr);
        }
    }
    /**
     * Parse images string.
     * $images - string.
     *
     * @return array
     */
    public function returnImagesPath($images)
    {
        if ($images) {

            $pathArr = array();
            $parse = $this->parseImages($images);
            foreach ($parse as $image) {
                if ($this->checkIfFileExist($image)) {
                    $ext = $this->checkFileFormat($image);
                    $imgPath = $this->getImgPath($image);
                    if ($imgPath) {
                        if ($ext == 'pdf') {
                            $pathArr[] = "<a href = '$imgPath' target='_blank'>". __('Pdf file')."</a>";
                        } else {
                            $pathArr[] = "<img src='$imgPath'>";
                        }
                    }
                }
            }
            return $pathArr;
        }
    }

    public function deleteFile($file)
    {
        if ($file && $this->checkIfFileExist($file)) {
            $filePath = $this->getFileAbsolutePath().DIRECTORY_SEPARATOR.$file;
            try{
                unlink($filePath);
                return true;
            } catch (Exception $e){
                return false;
            }
        }
    }

    public function deleteAllFiles($files)
    {
        if($files){
            $parse = $this->parseImages($files);
            foreach ($parse as $file){
                $remove = $this->deleteFile($file);
            }
        }
    }

    public function getAdminLabel($key)
    {
        $label = '';
        switch ($key){
            case "firstname":
                $label = "Firstname";
                break;
            case "lastname":
                $label = "Lastname";
                break;
            case "email":
                $label = "Customer Email";
                break;
            case "contact_number":
                $label = "Contact Number";
                break;
            case "address":
                $label = "Customer Address";
                break;
            case "order_number":
                $label = "Order Number";
                break;
            case "purchase_date":
                $label = "Order purchase date";
                break;
            case "product_data":
                $label = "Product Data";
                break;
            case "contact_reason":
                $label = "Contact Reason";
                break;
            case "files":
                $label = "Files";
                break;
            case "explanation":
                $label = "Explanation";
                break;
            case "warranty":
                $label = "Warranty number";
                break;
            case "problem_description":
                $label = "Problem Description";
                break;
            case "what_required":
                $label = "What Required";
                break;
            case "paragraph":
                $label = "Paragraph";
                break;
            case "created_at":
                $label = "Created";
                break;
        }
        if ($label) {
            return __($label);
        }
    }
}