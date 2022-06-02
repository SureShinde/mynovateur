<?php
namespace Redstage\AmcConfigurator\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\File\Csv;
use Psr\Log\LoggerInterface;

class CustomerSave extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Redstage_AmcConfigurator::customer';

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Csv
     */
    protected $csv;

    /**
     * @var CustomerFactory
     */
    protected $collectionFactory;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $_customerRepository;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var array
     */
    protected $amcConfig = [];

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        CustomerRepositoryInterface $customerRepository,
        ScopeConfigInterface $scopeConfig,
        Csv $csv,
        LoggerInterface $logger
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->collectionFactory = $collectionFactory;
        $this->_customerRepository = $customerRepository;
        $this->logger = $logger;
        $this->csv = $csv;
        parent::__construct($context);

    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        try {
            $mimes = array('application/vnd.ms-excel', 'text/plain', 'text/csv', 'text/tsv');
            if (in_array($_FILES['import_file']['type'], $mimes)) {
                $this->prepareConfig();
                $customerData = $this->getCustomerData();
                foreach ($customerData as $key => $data) {
                    if (!in_array($data['sales_organization'], $this->amcConfig['allowed_sales_organization'])) {
                        $this->messageManager->addErrorMessage(__('Sales Organization not valid for row ' . ($key + 1)));
                    } else if (!in_array($data['distribution_channel'], $this->amcConfig['allowed_distribution_channel'])) {
                        $this->messageManager->addErrorMessage(__('Distribution Channel not valid for row ' . ($key + 1)));
                    } else if (!in_array($data['division'], $this->amcConfig['allowed_division'])) {
                        $this->messageManager->addErrorMessage(__('Division not valid for row ' . ($key + 1)));
                    }
                    /*else if(!in_array($data['region'], $this->amcConfig['allowed_region']))
                    {
                    $this->messageManager->addErrorMessage(__('Region not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['customer_account_group'], $this->amcConfig['allowed_customer_account_group']))
                    {
                    $this->messageManager->addErrorMessage(__('Customer Account Group not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['customer_type'], $this->amcConfig['allowed_customer_type']))
                    {
                    $this->messageManager->addErrorMessage(__('Customer Type not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['sales_group'], $this->amcConfig['allowed_sales_group']))
                    {
                    $this->messageManager->addErrorMessage(__('Sales Group not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['sales_office'], $this->amcConfig['allowed_sales_office']))
                    {
                    $this->messageManager->addErrorMessage(__('Sales Office not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['reconciliation_account'], $this->amcConfig['allowed_reconciliation_account']))
                    {
                    $this->messageManager->addErrorMessage(__('Reconciliation Account Office not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['account_assignment_group'], $this->amcConfig['allowed_account_assignment_group']))
                    {
                    $this->messageManager->addErrorMessage(__('Account assignment group not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['tax_clssification'], $this->amcConfig['allowed_tax_clssification']))
                    {
                    $this->messageManager->addErrorMessage(__('Tax Clssification not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['tax_clssification_1'], $this->amcConfig['allowed_tax_clssification']))
                    {
                    $this->messageManager->addErrorMessage(__('Tax Clssification not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['tax_clssification_2'], $this->amcConfig['allowed_tax_clssification']))
                    {
                    $this->messageManager->addErrorMessage(__('Tax Clssification not valid for row '. ($key + 1) ));
                    }
                    else if(!in_array($data['pricing'], $this->amcConfig['allowed_pricing']))
                    {
                    $this->messageManager->addErrorMessage(__('Priceing not valid for row '. ($key + 1) ));
                    }*/
                    else {
                        $customer = $this->collectionFactory->create()
                            ->addAttributeToSelect('sap_customer_code')
                            ->addAttributeToFilter('sap_customer_code', $data['sap_customer_code'])
                            ->load()->getFirstItem();
                        if ($customer->getId()) {
                            $dataModel = $customer->getDataModel();
                            foreach ($data as $attributeCode => $value) {
                                $dataModel->setCustomAttribute($attributeCode, $value);
                            }
                            $this->_customerRepository->save($dataModel);
                        } else {
                            $this->messageManager->addErrorMessage(__('Customer not exist for row ' . ($key + 1)));
                        }
                    }
                }
            } else {
                throw new LocalizedException(
                    new \Magento\Framework\Phrase('Please upload csv.')
                );
            }

            $this->messageManager->addSuccessMessage(
                __('Import has been done successfully')
            );

        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error has occurred. ' . $e->getMessage()));
            $this->logger->critical($e);
        }
        $this->_redirect($this->_redirect->getRefererUrl());
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function getCustomerData()
    {
        $data = $this->csv->getData($_FILES['import_file']['tmp_name']);
        $header = array_shift($data);
        array_shift($data);
        array_shift($data);
        $customerData = [];
        $newHeader = [];

        foreach ($header as $key => $value) {
            $newValue = strtolower(str_replace(' ', '_', trim($value)));
            $newValue = str_replace('/', '_', $newValue);
            $newValue = str_replace('?', '', $newValue);
            $newValue = str_replace('.', '', $newValue);
            $newValue = str_replace('__', '', $newValue);
            $newValue = str_replace('-', '', $newValue);
            $newHeader[$key] = $this->newUniqHeader($newValue, $newHeader, 1);
        }

        foreach ($data as $row) {
            $customerData[] = array_combine($newHeader, $row);
        }
        return $customerData;
    }

    public function newUniqHeader($newValue, $newHeader, $num)
    {
        if (in_array($newValue, $newHeader)) {
            if (in_array($newValue . '_' . $num, $newHeader)) {
                $num++;
                return $this->newUniqHeader($newValue, $newHeader, $num);
            } else {
                return $newValue . '_' . $num;
            }

        } else {
            return $newValue;
        }

    }

    /**
     * @return void
     */
    protected function prepareConfig()
    {
        $this->amcConfig['allowed_distribution_channel'] = explode(',',
            $this->scopeConfig->getValue('amc_config/customer/allowed_distribution_channel')
        );

        $this->amcConfig['allowed_sales_organization'] = explode(',',
            $this->scopeConfig->getValue('amc_config/customer/allowed_sales_organization')
        );

        $this->amcConfig['allowed_division'] = explode(',',
            $this->scopeConfig->getValue('amc_config/customer/allowed_division')
        );

        $this->amcConfig['allowed_region'] = explode(',',
            $this->scopeConfig->getValue('amc_config/customer/allowed_region')
        );

        $this->amcConfig['allowed_sales_office'] = explode(',',
            $this->scopeConfig->getValue('amc_config/customer/allowed_sales_office')
        );

        $this->amcConfig['allowed_reconciliation_account'] = explode(',',
            $this->scopeConfig->getValue('amc_config/customer/allowed_reconciliation_account')
        );

        $this->amcConfig['allowed_account_assignment_group'] = explode(',',
            $this->scopeConfig->getValue('amc_config/customer/allowed_account_assignment_group')
        );

        $this->amcConfig['allowed_tax_clssification'] = explode(',',
            $this->scopeConfig->getValue('amc_config/customer/allowed_tax_clssification')
        );

        $this->amcConfig['allowed_pricing'] = explode(',',
            $this->scopeConfig->getValue('amc_config/customer/allowed_pricing')
        );

    }
}
