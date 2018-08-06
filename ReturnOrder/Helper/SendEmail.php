<?php
namespace Namespace\ReturnOrder\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

class SendEmail extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_EMAIL_TEMPLATE_FIELD  = 'namespace_returnorder_email_template';
    /* Here section and group refer to name of section and group where you create this field in configuration*/

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @var string
     */
    protected $temp_id;

    protected $_context;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->_context = $context;
        parent::__construct($context);
        $this->_storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Return store configuration value of your template field that which id you set for template
     *
     * @param string $path
     * @param int $storeId
     * @return mixed
     */
    protected function getConfigValue($path, $storeId)
    {
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Return store
     *
     * @return Store
     */
    public function getStore()
    {
        return $this->_storeManager->getStore();
    }

    /**
     * Return template id according to store
     *
     * @return mixed
     */
    public function getTemplateId($xmlPath)
    {
        return $this->getConfigValue($xmlPath, $this->getStore()->getStoreId());
    }

    /**
     * [generateTemplate description]  with template file and tempaltes variables values
     * @param  Mixed $emailTemplateVariables
     * @param  Mixed $senderInfo
     * @param  Mixed $receiverInfo
     * @return void
     */
    public function generateTemplate($emailTemplateVariables, $senderInfo, $receiverInfo)
    {
        $postObjectVars = new \Magento\Framework\DataObject();
        $postObjectVars->setData($emailTemplateVariables);
        
        $template =  $this->_transportBuilder->setTemplateIdentifier($this->temp_id)
            ->setTemplateOptions(
                [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND, /* here you can defile area and
                                                                                 store of template for which you prepare it */
                    'store' => $this->_storeManager->getStore()->getId(),
                ]
            );
            $template->setTemplateVars(['data' => $postObjectVars])
            ->setFrom($senderInfo)
            ->addTo($senderInfo['email'], $senderInfo['name']);

        return $this;
    }

    /**
     * [sendInvoicedOrderEmail description]
     * @param  Mixed $emailTemplateVariables
     * @param  Mixed $receiverInfo
     * @return void
     */
    /* your send mail method*/
    public function sendEmailMessage($emailTemplateVariables, $receiverInfo)
    {
        $this->temp_id = self::XML_PATH_EMAIL_TEMPLATE_FIELD;
        $this->inlineTranslation->suspend();
        $senderInfo = $this->getSalesSender();
        $this->generateTemplate($emailTemplateVariables, $senderInfo, $receiverInfo);
        $transport = $this->_transportBuilder->getTransport();

        try {
            $transport->sendMessage();
        } catch (Exception $e) {

        }

        $this->inlineTranslation->resume();
    }

    public function getSalesSender()
    {
        // Customer Support
        $name = $this->scopeConfig->getValue(
            'trans_email/ident_support/name',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        $email = $this->scopeConfig->getValue(
            'trans_email/ident_support/email',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        $sender = [
            'name' => $name,
            'email' => $email
        ];

        return $sender;
    }

}
