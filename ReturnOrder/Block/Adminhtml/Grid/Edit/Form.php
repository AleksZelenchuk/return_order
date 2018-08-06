<?php
/**
 * Namespace\ReturnOrder Add New Row Form Admin Block.
 *
 */
namespace Namespace\ReturnOrder\Block\Adminhtml\Grid\Edit;


/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    /**
    * @var \Namespace\ReturnOrder\Block\View
    */
    protected $_options;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Namespace\ReturnOrder\Block\View $options,
        array $data = []
    )
    {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }
    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post'
            ]
            ]
        );

        $form->setHtmlIdPrefix('frgrid_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Data'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'firstname',
            'text',
            [
                'name' => 'firstname',
                'label' => __('First Name'),
                'id' => 'firstname',
                'title' => __('First Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'lastname',
            'text',
            [
                'name' => 'lastname',
                'label' => __('Last Name'),
                'id' => 'lastname',
                'title' => __('Last Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'id' => 'email',
                'title' => __('Email'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'contact_number',
            'text',
            [
                'name' => 'contact_number',
                'label' => __('Contact Number'),
                'id' => 'contact_number',
                'title' => __('Contact Number'),
                'class' => 'required-entry',
                'required' => false,
            ]
        );
        $fieldset->addField(
            'address',
            'editor',
            [
                'name' => 'address',
                'label' => __('Address'),
                'id' => 'address',
                'title' => __('Address'),
                'required' => true,
                'rows' => '5',
                'cols' => '30',
                'wysiwyg' => true,
                'config' => $this->_wysiwygConfig->getConfig(),
            ]
        );
        $fieldset->addField(
            'order_number',
            'text',
            [
                'name' => 'order_number',
                'label' => __('Order Number'),
                'id' => 'order_number',
                'title' => __('Order Number'),
                'required' => false,
               // 'config' => $wysiwygConfig
            ]
        );
        $fieldset->addField(
            'purchase_date',
            'date',
            [
                'name' => 'purchase_date',
                'label' => __('Purchase Date'),
                'id' => 'purchase_date',
                'title' => __('Purchase Date'),
                'required' => false,
                'date_format' => 'yyyy-MM-dd',
            ]
        );
        $fieldset->addField(
            'product_data',
            'editor',
            [
                'name' => 'product_data',
                'label' => __('Product info'),
                'id' => 'product_data',
                'title' => __('Product info'),
                'required' => true,'rows' => '5',
                'cols' => '30',
                'wysiwyg' => true,
                'config' => $this->_wysiwygConfig->getConfig(),
            ]
        );
        $fieldset->addField(
            'contact_reason',
            'select',
            [
                'name' => 'contact_reason',
                'label' => __('Contact Reason'),
                'id' => 'contact_reason',
                'title' => __('Contact Reason'),
                'required' => true,
                'values' => $this->_options->getContactReasonOptions(),
            ]
        );
        $fieldset->addField(
            'files',
            'text',
            [
                'name' => 'files',
                'label' => __('Files'),
                'id' => 'files',
                'title' => __('Files'),
                'required' => false,

            ]
        );
        $fieldset->addField(
            'explanation',
            'editor',
            [
                'name' => 'explanation',
                'label' => __('Explanation'),
                'id' => 'explanation',
                'title' => __('Explanation'),
                'required' => false,
                'rows' => '5',
                'cols' => '30',
                'wysiwyg' => true,
                'config' => $this->_wysiwygConfig->getConfig(),
            ]
        );
        $fieldset->addField(
            'warranty',
            'text',
            [
                'name' => 'warranty',
                'label' => __('Warranty'),
                'id' => 'warranty',
                'title' => __('Warranty'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'problem_description',
            'editor',
            [
                'name' => 'problem_description',
                'label' => __('Problem Description'),
                'id' => 'problem_description',
                'title' => __('Problem Description'),
                'required' => false,
                'rows' => '5',
                'cols' => '30',
                'wysiwyg' => true,
                'config' => $this->_wysiwygConfig->getConfig(),
            ]
        );
        $fieldset->addField(
            'what_required',
            'select',
            [
                'name' => 'what_required',
                'label' => __('What Required'),
                'id' => 'what_required',
                'title' => __('What Required'),
                'required' => true,
                'values' => $this->_options->getWhatRequiredOptions(),
            ]
        );
        $fieldset->addField(
            'paragraph',
            'editor',
            [
                'name' => 'paragraph',
                'label' => __('Paragraph'),
                'id' => 'paragraph',
                'title' => __('Paragraph'),
                'required' => false,
                'rows' => '5',
                'cols' => '30',
                'wysiwyg' => true,
                'config' => $this->_wysiwygConfig->getConfig(),
            ]
        );
        $fieldset->addField(
            'created_at',
            'date',
            [
                'name' => 'created_at',
                'label' => __('Created At'),
                'id' => 'created_at',
                'title' => __('Created At'),
                'required' => false,
                'date_format' => 'yyyy-MM-dd',
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
