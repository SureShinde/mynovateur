<?php

/**
 * Redstage CustomerInstallation module purpose admin user can export customer data predifined CSV.
 *
 * @category: PHP
 * @package: Redstage/CustomerInstallation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_CustomerInstallation
 */

namespace Redstage\CustomerInstallation\Block\Adminhtml\Customer\Edit;
use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Redstage\CustomerInstallation\Model\Config\SalesOrganization;
use Redstage\CustomerInstallation\Model\Config\DistributionChannel;
use Redstage\CustomerInstallation\Model\Config\CustomerAccountGroup;
use Redstage\CustomerInstallation\Model\Config\TitleText;
use Redstage\CustomerInstallation\Model\Config\ReconciliationAccount;
use Redstage\CustomerInstallation\Model\Config\NumericCustomerGroup;
use Redstage\CustomerInstallation\Model\Config\TaxClassification;
use Redstage\CustomerInstallation\Model\Config\SalesOffice;
use Redstage\CustomerInstallation\Model\Config\SalesGroup;
use Redstage\CustomerInstallation\Model\Config\CustomerType;
use Redstage\CustomerInstallation\Model\Config\AccountAssignmentGroup;
use Redstage\CustomerInstallation\Model\Config\Region;
use Redstage\CustomerInstallation\Model\Config\Pricing;
use Redstage\CustomerInstallation\Model\Config\Funded;
/**
 * Customer account form block
 */
class Tabs extends Generic implements TabInterface
{
     /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var Redstage\CustomerInstallation\Model\Config\SalesOrganization
    */
    protected $_salesOrganization;

    /**
     * @var Redstage\CustomerInstallation\Model\Config\DistributionChannel
    */
    protected $_distributionChannel;

    /**
     * @var Redstage\CustomerInstallation\Model\Config\CustomerAccountGroup
    */
    protected $_customerAccountGroup;

    /**
     * @var SalesOffice
     */
    protected $salesOffice;

    /**
     * @var SalesGroup
     */
    protected $salesGroup;

    /**
     * @var CustomerType
     */
    protected $customerType;

    /**
     * @var Region
     */
    protected $region;

    /**
     * @var Pricing
     */
    protected $pricing;

    /**
     * @var AccountAssignmentGroup
     */
    protected $accountAssignmentGroup;

    /**
     * @var Redstage\CustomerInstallation\Model\Config\TitleText
    */
    protected $_titleText;

    /**
     * @var Redstage\CustomerInstallation\Model\Config\ReconciliationAccount
    */
    protected $_reconciliationAccount;

    /**
     * @var Redstage\CustomerInstallation\Model\Config\NumericCustomerGroup
    */
    protected $_numericCustomerGroup;

    /**
     * @var Redstage\CustomerInstallation\Model\Config\TaxClassification
    */
    protected $_taxClassification;

    /**
     * @var Redstage\CustomerInstallation\Model\Config\Funded
    */
    protected $_funded;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param CustomerRepositoryInterface $customerRepository
     * @param SalesOrganization $salesOrganization
     * @param DistributionChannel $distributionChannel
     * @param CustomerAccountGroup $customerAccountGroup
     * @param TitleText $titleText
     * @param SalesOffice $salesOffice
     * @param SalesGroup $salesGroup
     * @param CustomerType $customerType
     * @param Region $region
     * @param Pricing $pricing
     * @param AccountAssignmentGroup $accountAssignmentGroup
     * @param ReconciliationAccount $reconciliationAccount
     * @param NumericCustomerGroup $numericCustomerGroup
     * @param TaxClassification $taxClassification
     * @param Funded $funded
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        CustomerRepositoryInterface $customerRepository,
        SalesOrganization $salesOrganization,
        DistributionChannel $distributionChannel,
        CustomerAccountGroup $customerAccountGroup,
        TitleText $titleText,
        SalesOffice $salesOffice,
        SalesGroup  $salesGroup,
        CustomerType $customerType,
        Region $region,
        Pricing $pricing,
        AccountAssignmentGroup $accountAssignmentGroup,
        ReconciliationAccount $reconciliationAccount,
        NumericCustomerGroup $numericCustomerGroup,
        TaxClassification $taxClassification,
        Funded $funded,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_systemStore = $systemStore;
        $this->customerRepository = $customerRepository;
        $this->_salesOrganization = $salesOrganization;
        $this->_distributionChannel = $distributionChannel;
        $this->_customerAccountGroup = $customerAccountGroup;
        $this->salesOffice = $salesOffice;
        $this->salesGroup = $salesGroup;
        $this->customerType = $customerType;
        $this->region = $region;
        $this->pricing = $pricing;
        $this->accountAssignmentGroup = $accountAssignmentGroup;
        $this->_titleText = $titleText;
        $this->_reconciliationAccount = $reconciliationAccount;
        $this->_numericCustomerGroup = $numericCustomerGroup;
        $this->_taxClassification = $taxClassification;
        $this->_funded = $funded;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Custom Attributes');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Custom Attributes');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
       if ($this->getCustomerId()) {
            return false;
        }
        return true;
    }

    /**
     * Tab class getter
     *
     * @return string
     */
    public function getTabClass()
    {
        return '';
    }

    /**
     * Return URL link to Tab content
     *
     * @return string
     */
    public function getTabUrl()
    {
        return '';
    }

    /**
     * Tab should be loaded trough Ajax call
     *
     * @return bool
     */
    public function isAjaxLoaded()
    {
        return false;
    }
    public function getAttributeValue($key)
    {
        $customerId = $this->getCustomerId();
        if($customerId){
            $customer = $this->customerRepository->getById($customerId);
            $customerdata = $customer->getCustomAttribute($key);
            if($customerdata){
                return $customerdata->getValue();
            }else{
               return '';
            }
        }else{
            return '';
        }


    }
    public function initForm()
    {
        if (!$this->canShowTab()) {
            return $this;
        }


        $form = $this->_formFactory->create();
       // $form->setHtmlIdPrefix('myform_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Enterprice Data Integration')]);

        // Update customer attributes
        $addUserDefineAttributes = [
            "sap_customer_code" => [ "type" => "text", "label" => "SAP Customer code"],
            "company_code" => [ "type" => "text", "label" => "Company Code"],
            "sales_organization" => [
                "type" => "select",
                "label" => "Sales Organization",
                "options" => $this->_salesOrganization->getOptionArray()
            ],
            "distribution_channel" => [
                "type" => "select",
                "label" => "Distribution Channel",
                "options" => $this->_distributionChannel->getOptionArray()
            ],
            "division" => [ "type" => "text", "label" => "Division"],
            "customer_account_group" => [
                "type" => "select",
                "label" => "Customer Account Group",
                "options" => $this->_customerAccountGroup->getOptionArray()
            ],
           "title_text" => [
                "type" => "select",
                "label" => "Title Text",
                "options" => $this->_titleText->getOptionArray()
            ],
            "name_1" => [ "type" => "text", "label" => "Name 1"],
            "name_2" => [ "type" => "text", "label" => "Name 2"],
            "short" => [ "type" => "text", "label" => "Short"],
            "street" => [ "type" => "text", "label" => "Street"],
            "street_4" => [ "type" => "text", "label" => "Street 4"],
            "street_5" => [ "type" => "text", "label" => "Street 5"],
            "district" => [ "type" => "text", "label" => "District"],
            "citypostalcode" => [ "type" => "text", "label" => "Citypostalcode"],
            "city" => [ "type" => "text", "label" => "City"],
            "country_key" => [ "type" => "text", "label" => "Country Key"],
            "region" => [
                "type" => "select",
                "label" => "Title Text",
                "options" => $this->region->getOptionArray()
            ],
            "transportation_zone" => [ "type" => "text", "label" => "Transportation zone"],
            "language_key" => [ "type" => "text", "label" => "Language Key"],
            "telephone_no" => [ "type" => "text", "label" => "Telephone No"],
            "mobile_telephone_no" => [ "type" => "text", "label" => "Mobile Telephone No"],
            "fax_number" => [ "type" => "text", "label" => "FAX_NUMBER"],
            "email_address" => [ "type" => "text", "label" => "E-Mail Address"],
            "customer_type" => [
                "type" => "select",
                "label" => "Customer Type",
                "options" => $this->customerType->getOptionArray()
            ],
            "ecc_number" => [ "type" => "text", "label" => "Ecc Number"],
            "excise_registration_number" => [ "type" => "text", "label" => "Excise Registration Number"],
            "excise_range" => [ "type" => "text", "label" => "Excise Range"],
            "excise_division" => [ "type" => "text", "label" => "Excise Division"],
            "excise_commissionerate" => [ "type" => "text", "label" => "Excise Commissionerate"],
            "excise_tax_indicator_for_customer" => [ "type" => "text", "label" => "Excise tax indicator for customer"],
            "central_sales_tax_number" => [ "type" => "text", "label" => "Central Sales Tax Number"],
            "local_sales_tax_number" => [ "type" => "text", "label" => "Local Sales Tax Number"],
            "tax_number_2" => [ "type" => "text", "label" => "Tax Number 2"],
            "name_1" => [ "type" => "text", "label" => "Name 1"],
            "reconciliation_account" => [
                "type" => "select",
                "label" => "Reconciliation Account",
                "options" => $this->_reconciliationAccount->getOptionArray()
            ],
            "terms_of_payment_key" => [ "type" => "text", "label" => "Terms of Payment key"],
            "order_probability_of_the_item" => [ "type" => "text", "label" => "Order probability of the item"],
            "sales_office" => [
                "type" => "select",
                "label" => "Sales Office",
                "options" => $this->salesOffice->getOptionArray()
            ],
            "sales_group" => [
                "type" => "select",
                "label" => "Sales Group",
                "options" => $this->salesGroup->getOptionArray()
            ],
            "customer_group" => [
                "type" => "select",
                "label" => "Customer Group",
                "options" => $this->_numericCustomerGroup->getOptionArray()
            ],
            "currency" => [ "type" => "text", "label" => "Currency"],
            "pricing" => [ "type" => "text", "label" => "Pricing"],
            "pricing" => [
                "type" => "select",
                "label" => "Pricing",
                "options" => $this->pricing->getOptionArray()
            ],
            "customer_statistics_group" => [ "type" => "text", "label" => "Customer statistics group"],
            "delivery_priority" => [ "type" => "text", "label" => "Delivery Priority"],
            "order_combination_indicator" => [ "type" => "text", "label" => "Order combination indicator"],
            "shipping_conditions" => [ "type" => "text", "label" => "Shipping conditions"],
            "complete_delivery_defined_for_each_sales_order" => [ "type" => "text", "label" => "Complete delivery defined for
each sales order?"],
            "partial_delivery_at_item_level" => [ "type" => "text", "label" => "Partial delivery at item level"],
            "account_assignment_group_for_this_customer" => [
                "type" => "select",
                "label" => "Account assignment group for
this customer",
                "options" => $this->accountAssignmentGroup->getOptionArray()
            ],
            "tax_clssification" => [
                "type" => "select",
                "label" => "Tax Classification",
                "options" => $this->_taxClassification->getOptionArray()
            ],
            "tax_clssification_1" => [
                "type" => "select",
                "label" => "Tax Classification",
                "options" => $this->_taxClassification->getOptionArray()
            ],
            "tax_clssification_2" => [
                "type" => "select",
                "label" => "Tax Classification",
                "options" => $this->_taxClassification->getOptionArray()
            ],
            "web_ref_customer_no" => [ "type" => "text", "label" => "Web Ref. customer no"],
            "reserved" => [ "type" => "text", "label" => "Reserved"],
            "reserved_1" => [ "type" => "text", "label" => "Reserved"],
            "funded_by_public_private" => [
                "type" => "select",
                "label" => "Funded by PUBLIC / PRIVATE",
                "options" => $this->_funded->getOptionArray()
            ],
            "gstin" => [ "type" => "text", "label" => "GSTIN"],
            "pan" => [ "type" => "text", "label" => "PAN"]
        ];
        $validation_require = [
            "sales_group" => true,

        ];
        foreach ($addUserDefineAttributes as $key => $value) {
            $requireVal = false;
            if(isset($validation_require[$key])){
               $requireVal = true;
            }
            if($key=='mobile_telephone_no'){
                $fieldset->addField(
                    $key,
                    'text',
                    [
                        'name' => 'customer['.$key.']',
                        'data-form-part' => $this->getData('target_form'),
                        'label' => __($value['label']),
                        'title' => __($value['label']),
                        'value' => $this->getAttributeValue($key),
                        'tabindex' => 1,
                        'class'    => 'validate-number validate-greater-than-zero validate-not-negative-number
                            validate-length
                            minimum-length-10
                            maximum-length-10',
                        'maxlength' => 10,
                        'note' => 'Please enter valid 10 digit number i.e 1234567890'
                    ]
                );

            }
            else if($value['type'] == 'select')
            {
                $fieldset->addField(
                    $key,
                    'select',
                    [
                        'name' => 'customer['.$key.']',
                        'data-form-part' => $this->getData('target_form'),
                        'label' => __($value['label']),
                        'title' => __($value['label']),
                        'value' => $this->getAttributeValue($key),
                        'values' => $value['options'],
                        'tabindex' => 1
                    ]
                );
            }
            else
            {
                $fieldset->addField(
                    $key,
                    'text',
                    [
                        'name' => 'customer['.$key.']',
                        'data-form-part' => $this->getData('target_form'),
                        'label' => __($value['label']),
                        'title' => __($value['label']),
                        'value' => $this->getAttributeValue($key),
                        'tabindex' => 1,
                        'required' => $requireVal
                    ]
                );
            }
        }

        $this->setForm($form);
        return $this;
    }
    /**
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->canShowTab()) {
            $this->initForm();
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}
