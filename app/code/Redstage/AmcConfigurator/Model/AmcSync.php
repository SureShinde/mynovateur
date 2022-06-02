<?php
/**
 * Redstage AMC Data sync module use for update amc records in bulk
 *
 * @package: Redstage/AmcConfigurator
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_AmcConfigurator
 */

namespace Redstage\AmcConfigurator\Model;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Redstage\AmcConfigurator\Model\AmcRecordFactory;
use Redstage\AmcConfigurator\Model\ResourceModel\AmcList\CollectionFactory as ListCollectionFactory;
use Redstage\AmcConfigurator\Model\AmcListFactory;
use Redstage\Logger\Model\LoggerFactory;

class AmcSync implements \Redstage\AmcConfigurator\Api\AmcApiSyncInterface
{
    /**
     * @var AmcRecordFactory
     */
    protected $amcRecordFactory;

    /**
     * @param Redstage\AmcConfigurator\Model\ResourceModel\AmcList\CollectionFactory as ListCollectionFactory;
     * @param Redstage\AmcConfigurator\Model\AmcListFactory $amcListFactory
     */
    protected $amcListFactory;
    protected $amcListCollectionFactory;

    /**
     * @var LoggerFactory
     */
    protected $loggerFactory;

    /**
     * 
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request,
        Json $json,
        AmcRecordFactory $amcRecordFactory,
        ListCollectionFactory $amcListCollectionFactory,
        AmcListFactory $amcListFactory,
        LoggerFactory $loggerFactory
    ) {
        $this->request = $request;
        $this->json = $json;
        $this->amcRecordFactory = $amcRecordFactory;
        $this->amcListCollectionFactory = $amcListCollectionFactory;
        $this->amcListFactory = $amcListFactory;
        $this->loggerFactory = $loggerFactory;
    }

    /**
     * Updatedata function
     *
     * @api
     * @return string
     */
    public function Updatedata()
    {   
        $data = $this->request->getContent();
        $loggerData = array();
        $loggerData['request_data'] = $data;
        $loggerData['request_type'] = 'amc_sync';
        $loggerData['status'] = 'Pending';
        $modelLogger = $this->loggerFactory->create();
        $modelLogger->setData($loggerData)->save();
        //print_r(json_decode($data));die('hhh');
        try {
            //echo $jsonDecode = $this->json->unserialize($data);die('hhh');
            $amcData = array();
            $i_c = 0;
            foreach(json_decode($data) as $dataObj){
                $dataVal = (array) $dataObj;

                $model = $this->amcListCollectionFactory->create()->addFieldToFilter('asset_name', $dataVal['asset_name'])->getFirstItem();
                if($model->getId()){
                    $amc_model = $this->amcListFactory->create()->load($model->getId());
                }else{
                    $amc_model = $this->amcListFactory->create();
                }
                $amc_model->setInvoiceInvoiceNo($dataVal['invoice_no']);
                $amc_model->setInvoiceInvoiceDate($dataVal['invoice_date']);
                $amc_model->setSalesOrg($dataVal['sales_org']);
                $amc_model->setProductMeterialGroup1($dataVal['product_material_group_1']);
                $amc_model->setProductMeterialGroup3($dataVal['product_material_group_3']);
                $amc_model->setAssetName($dataVal['asset_name']);
                $amc_model->setSoldToAccountName($dataVal['sold_to_account_name']);
                $amc_model->setSapCustomerCode($dataVal['sap_customer_code']);
                $amc_model->setAccountAccountName($dataVal['account_name']);
                $amc_model->setAccountBillingStreet($dataVal['billing_street']);
                $amc_model->setData('account_city1', $dataVal['city']);
                $amc_model->setPostalCode($dataVal['postal_code']);
                $amc_model->setAccountRegion($dataVal['region']);
                $amc_model->setEquipmentMake($dataVal['equipment_make']);
                $amc_model->setAmcContractNumber($dataVal['amc_contract_number']);
                $amc_model->setAmcStartDate($dataVal['amc_start_date']);
                $amc_model->setAmcEndDate($dataVal['amc_end_date']);
                $amc_model->setContractNetRate($dataVal['amc_contract_net_rate']);
                $amc_model->setBatteryProductProductName($dataVal['battery_product_name']);
                $amc_model->setBatteryQuantity($dataVal['battery_qty']);
                $amc_model->setWarrantyStartDate($dataVal['battery_warranty_start_date']);
                $amc_model->setWarrantyEndDate($dataVal['battery_warranty_end_date']);
                $amc_model->setCustomerAssetStatus($dataVal['customer_asset_status']);
                $amc_model->setproductAccountAssignmentGroup($dataVal['product_account_assignment_group']);
                try {
                    $amc_model->save();   
                    $amcData[$i_c]['asset_name'] = $dataVal['asset_name'];
                    $amcData[$i_c]['status'] = 'success';
                } catch (Exception $e) {
                    $amcData[$i_c]['asset_name'] = $dataVal['asset_name'];
                    $amcData[$i_c]['status'] = 'faild';
                    $amcData[$i_c]['error_code'] = '503';
                    $amcData[$i_c]['error_message'] = 'Exception as given by magento';
                }
                $i_c++;
            }
            $status = 'pending';
            $responseData = '200';
            $responseReturn = ['assets' => $amcData];
        } catch (\Exception $e) {
            /*$status = 'failed';
            $responseData = $e->getMessage();
            $responseReturn[] = [
                "status" => 'failed'
            ];*/
        }
        $response = json_encode(['assets' => $amcData]);
        $modelLogger = $this->loggerFactory->create()->load($modelLogger->getId());
        $modelLogger->setStatus($status)->setResponseData($response)->save();
        //$response = json_decode($response, true, JSON_UNESCAPED_SLASHES);
        echo $response;
    }
}
