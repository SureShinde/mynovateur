<?php
namespace Redstage\AmcConfigurator\Controller\Adminhtml\AmcOffer;

use Magento\Backend\App\Action\Context;
use Redstage\AmcConfigurator\Model\CustomerFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\File\Csv;
use Psr\Log\LoggerInterface;

class Save extends \Magento\Backend\App\Action
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
    protected $customerFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var array
     */
    protected $amcConfig = [];

    /**
     * @param Context $context
     * @param CustomerFactory $customerFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param Csv $csv
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        CustomerFactory $customerFactory,
        ScopeConfigInterface $scopeConfig,
        Csv $csv,
        LoggerInterface $logger
    ) {
        $this->customerFactory = $customerFactory;
        $this->scopeConfig = $scopeConfig;
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
        print_r($_FILES['import_file']);die;
        try {
            if($_FILES['import_file']['type'] == 'text/csv')
            {
                $this->prepareConfig();
                $customerData = $this->getCustomerData();
                foreach ($customerData as $key => $data)
                {
                   if(!in_array($data['sales_org'], $this->amcConfig['allowed_sales_org']))
                   {
                       $this->messageManager->addErrorMessage(__('Sales Org not valid for row '. ($key + 1) ));
                   }
                   else if(!in_array($data['customer_asset_status'], $this->amcConfig['allowed_asset_status']))
                   {
                       $this->messageManager->addErrorMessage(__('Asset status not valid for row '. ($key + 1) ));
                   }
                   else if($data['equipment_make'] && !in_array($data['equipment_make'], $this->amcConfig['allowed_equipment_make']))
                   {
                       $this->messageManager->addErrorMessage(__('Equipment Make not valid for row '. ($key + 1) ));
                   }
                   else if($data['postal_code'] && !is_numeric($data['postal_code']) )
                   {
                       $this->messageManager->addErrorMessage(__('Postal code not valid for row '. ($key + 1) ));
                   }
                   else
                   {
                       $customerModel = $this->customerFactory->create();
                       $customerModel->load($data['asset_name'], 'asset_name');
                       $customerModel->addData($data)->save();
                   }
                }
            }
            else
            {
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
            $this->messageManager->addErrorMessage(__('An error has occurred'));
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
        $data = $this->csv->getData($_FILES['import_file']['tmp_name']);;
        $header = array_shift($data);
        echo "<pre>";
        foreach ($header as $key => $value){
            $header[$key] = strtolower(str_replace(' ','_', $value));
            $header[$key] = str_replace(':','', $header[$key]);
            $header[$key] = str_replace('.','', $header[$key]);
        }
        print_r($header);die;
        $customerData = [];

        foreach ($data as $row)
        {
            $data = array_combine($header, $row);
            $data['invoice_invoice_date'] =  $data['invoice_invoice_date'] ? date('d-m-Y', strtotime($data['invoice_invoice_date'])) : '';
            $data['warranty_start_date'] =  $data['warranty_start_date'] ? date('d-m-Y', strtotime($data['warranty_start_date'])) : '';
            $data['warranty_end_date'] =  $data['warranty_end_date'] ? date('d-m-Y', strtotime($data['warranty_end_date'])) : '';
            $data['amc_start_date'] =  $data['amc_start_date'] ? date('d-m-Y', strtotime($data['amc_start_date'])) : '';
            $data['warranty_end_date'] =  $data['warranty_end_date'] ? date('d-m-Y', strtotime($data['warranty_end_date'])) : '';
            $data['amc_end_date'] =  $data['amc_end_date'] ? date('d-m-Y', strtotime($data['amc_end_date'])) : '';
            $data['battery_warranty_end_date'] =  $data['battery_warranty_end_date'] ? date('d-m-Y', strtotime($data['battery_warranty_end_date'])) : '';
            $customerData[] = $data;
        }

        return $customerData;
    }

    /**
     * @return void
     */
    protected function prepareConfig()
    {
        $this->amcConfig['allowed_asset_status'] = explode(',',
            $this->scopeConfig->getValue('amc_config/contractor/allowed_asset_status')
        );

        $this->amcConfig['allowed_sales_org'] = explode(',',
            $this->scopeConfig->getValue('amc_config/contractor/allowed_sales_org')
        );

        $this->amcConfig['allowed_equipment_make'] = explode(',',
            $this->scopeConfig->getValue('amc_config/contractor/allowed_equipment_make')
        );
    }
}
