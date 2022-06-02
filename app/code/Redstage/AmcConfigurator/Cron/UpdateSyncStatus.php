<?php
/**
 * Redstage Services Amc sync module use for update amc status in bulk and base on magento side created amc from SF
 *
 * @category: PHP
 * @package: Redstage/AmcConfigurator
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_AmcConfigurator
 */

namespace Redstage\AmcConfigurator\Cron;
use Redstage\AmcConfigurator\Model\ResourceModel\AmcRecord\CollectionFactory;
use Redstage\AmcConfigurator\Model\ResourceModel\AmcList\CollectionFactory as ListCollectionFactory;
use Redstage\AmcConfigurator\Model\AmcListFactory;
use Redstage\Logger\Model\ResourceModel\Logger\CollectionFactory as LoggerFactory;
use Psr\Log\LoggerInterface;

class UpdateSyncStatus {

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var AmcListFactory
     */
    protected $amcListFactory;
    protected $amcListCollectionFactory;
    protected $logger;
    protected $loggerFactory;
    /**
     * 
     * @param Redstage\AmcConfigurator\Model\ResourceModel\AmcRecord\CollectionFactory $collectionFactory
     * @param Redstage\AmcConfigurator\Model\ResourceModel\AmcList\CollectionFactory as ListCollectionFactory;
     * @param Redstage\AmcConfigurator\Model\AmcListFactory $amcListFactory
     */
    public function __construct(
    CollectionFactory $collectionFactory,
    ListCollectionFactory $amcListCollectionFactory,
    AmcListFactory $amcListFactory,
    LoggerInterface $logger,
    LoggerFactory $loggerFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->amcListCollectionFactory = $amcListCollectionFactory;
        $this->amcListFactory = $amcListFactory;
        $this->logger = $logger;
        $this->loggerFactory = $loggerFactory;
    }

    /**
     * Method is used to disable the products if the product is expired
     */
    public function execute() {
        $loggerCollection = $this->loggerFactory->create()->addFieldToFilter('status', 'pending')->addFieldToFilter('request_type', 'amc_sync');

        if($loggerCollection->getSize()){
            $data = $loggerCollection->getFirstItem();
            $amcRecordCollection = $this->collectionFactory->create()->addFieldToFilter('flow_status', 'pending')->addFieldToFilter('batch_id', $data->getId());
            $amcRecordCollection->addFieldToSelect('*');
            foreach ($amcRecordCollection as $amcRecord) {
                try {
                    $amcRecord->setFlowStatus('progress')->save(); 
                    //$model = $this->amcListFactory->create()->load($amcRecord->getId());
                    $model = $this->amcListCollectionFactory->create()->addFieldToFilter('asset_name', $amcRecord->getAssetName())->getFirstItem();
                    if($model->getId()){
                        $amc_model = $this->amcListFactory->create()->load($model->getId());
                    }else{
                        $amc_model = $this->amcListFactory->create();
                    }
                    $amc_model->setInvoiceInvoiceNo($amcRecord->getInvoiceInvoiceNo());
                    $amc_model->setInvoiceInvoiceDate($amcRecord->getInvoiceInvoiceDate());
                    $amc_model->setSalesOrg($amcRecord->getSalesOrg());
                    $amc_model->setProductMeterialGroup1($amcRecord->getProductMeterialGroup1());
                    $amc_model->setProductMeterialGroup3($amcRecord->getProductMeterialGroup3());
                    $amc_model->setAssetName($amcRecord->getAssetName());
                    $amc_model->setSoldToAccountName($amcRecord->getSoldToAccountName());
                    $amc_model->setSapCustomerCode($amcRecord->getSapCustomerCode());
                    $amc_model->setAccountAccountName($amcRecord->getAccountAccountName());
                    $amc_model->setAccountBillingStreet($amcRecord->getAccountBillingStreet());
                    $amc_model->setAccountCity1($amcRecord->getAccountCity1());
                    $amc_model->setPostalCode($amcRecord->getPostalCode());
                    $amc_model->setAccountRegion($amcRecord->getAccountRegion());
                    $amc_model->setEquipmentMake($amcRecord->getEquipmentMake());
                    $amc_model->setAmcContractNumber($amcRecord->getAmcContractNumber());
                    $amc_model->setAmcStartDate($amcRecord->getAmcStartDate());
                    $amc_model->setAmcEndDate($amcRecord->getAmcEndDate());
                    $amc_model->setContractNetRate($amcRecord->getContractNetRate());
                    $amc_model->setBatteryProductProductName($amcRecord->getBatteryProductProductName());
                    $amc_model->setBatteryQuantity($amcRecord->getBatteryQuantity());
                    $amc_model->setWarrantyStartDate($amcRecord->getWarrantyStartDate());
                    $amc_model->setWarrantyEndDate($amcRecord->getWarrantyEndDate());
                    $amc_model->setCustomerAssetStatus($amcRecord->getCustomerAssetStatus());
                    $amc_model->setproductAccountAssignmentGroup($amcRecord->getproductAccountAssignmentGroup());
                    $amc_model->save(); 
                    $amcRecord->setFlowStatus('complete')->save();
                } catch (Exception $e) {
                    
                }
            }
            $data->setStatus('success')->save();
        }    
    }

}
