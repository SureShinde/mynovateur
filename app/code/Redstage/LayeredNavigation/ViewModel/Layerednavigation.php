<?php
/**
 * Redstage LayeredNavigation module use for customize numeric configurator for layared navigation
 *
 * @category: PHP
 * @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */

namespace Redstage\LayeredNavigation\ViewModel;
use Redstage\LayeredNavigation\Model\ResourceModel\LayeredNavigation\CollectionFactory;
use Magento\Catalog\Model\Layer\Resolver;
use Redstage\LayeredNavigation\Helper\Data;
use Magento\Framework\Serialize\SerializerInterface;
use Redstage\LayeredNavigation\Model\ResourceModel\WattCalculation\CollectionFactory as WattCollectionFactory;
class Layerednavigation implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @param \Magento\Framework\Registry $registry
     */

    protected $_registry;
    public function __construct(
      CollectionFactory $collectionFactory,
      \Magento\Framework\Registry $registry,
      \Magento\Customer\Model\Session $customerSession,
      \Magento\Framework\Session\SessionManager $sessionManager,
      WattCollectionFactory $wattcollectionFactory,
      SerializerInterface $serializer,
      Data $helper,
      \Magento\Store\Model\StoreManagerInterface $storeManager,
      \Magento\Framework\App\Request\Http $request
    ) {
      $this->collectionFactory = $collectionFactory;
      $this->_registry = $registry;
      $this->serializer = $serializer;
      $this->customerSession = $customerSession;
      $this->_session = $sessionManager;
      $this->_wattcollectionFactory = $wattcollectionFactory;
      $this->helper = $helper;
      $this->_storeManager = $storeManager;
      $this->request = $request;
    }
    public function getAttributeHide()
    {
      if($this->request->getModuleName() == 'catalogsearch' && $this->request->getControllerName() == 'result' && $this->request->getRouteName() == 'catalogsearch'){
          return;
      }
      if($this->isModuleEnabled() == 0 || $this->getAttributeCollection()->count()==0){
        return 0;
      }
      return $this->getAttributeCollection()->count();
    }

    public function getAttributeCollection($parent = '')
    {
      if($this->request->getModuleName() == 'catalogsearch' && $this->request->getControllerName() == 'result' && $this->request->getRouteName() == 'catalogsearch'){
          return;
      }
      $catId = $this->_registry->registry('current_category')->getId();
      $applications = $this->collectionFactory->create()->addFieldToFilter('category_apply', $catId)->addFieldToFilter('status', 1);
      if($parent){
        $applications->addFieldToFilter('application', $parent);
      }else{
        $applications->addFieldToFilter('application', ['eq' => '']);
      }
      $applications->setOrder('sorting','ASC');
      return $applications;
    }

    public function getSelectedOption ()
    {
        if($this->request->getModuleName() == 'catalogsearch' && $this->request->getControllerName() == 'result' && $this->request->getRouteName() == 'catalogsearch'){
            return;
        }
        $catId = $this->_registry->registry('current_category')->getId();
        $collection = $this->_wattcollectionFactory->create();
        if($this->customerSession->getCustomer()->getId()){
            $data['customer_id'] = $this->customerSession->getCustomer()->getId();
            $collection->addFieldToFilter('customer_id', $data['customer_id']);
            $collection->addFieldToFilter('category_id', $catId);
        }else{
            $data['session_id'] = $this->_session->getSessionId();
            $collection->addFieldToFilter('session_id', $data['session_id']);
            $collection->addFieldToFilter('category_id', $catId);
        }

        $optionSelect = $collection->getFirstItem()->getOptionselect();
        $optionSelectArray = explode('#',$optionSelect);
        //echo '<pre>';print_r($optionSelectArray);
        return $optionSelectArray;
    }

    public function getApplicationOptions($htmlJs)
    {
      if($this->request->getModuleName() == 'catalogsearch' && $this->request->getControllerName() == 'result' && $this->request->getRouteName() == 'catalogsearch'){
          return;
      }
      $html = '';
      if($this->isModuleEnabled() == 0 || $this->getAttributeCollection()->count()==0){
          return $html;
      }
      //option selection
      $catId = $this->_registry->registry('current_category')->getId();
      $collection = $this->_wattcollectionFactory->create();
        if($this->customerSession->getCustomer()->getId()){
            $data['customer_id'] = $this->customerSession->getCustomer()->getId();
            $collection->addFieldToFilter('customer_id', $data['customer_id']);
            $collection->addFieldToFilter('category_id', $catId);
        }else{
            $data['session_id'] = $this->_session->getSessionId();
            $collection->addFieldToFilter('session_id', $data['session_id']);
            $collection->addFieldToFilter('category_id', $catId);
        }

      $wattSelect = $collection->getFirstItem()->getWattselect();
      $wattSelectArray = explode('#',$wattSelect);
      //echo '<pre>';print_r($wattSelectArray);
      $wattArray = array();
      foreach($wattSelectArray as $value){
        if($value){
        $explodeVal = explode('|',$value);
        $wattArray[$explodeVal[0]] = $explodeVal[1];
        }

      }
      //echo '<pre>';print_r($wattArray);

      $optionSelect = $collection->getFirstItem()->getOptionselect();
      $optionSelectArray = explode('#',$optionSelect);
      //echo '<pre>';print_r($optionSelectArray);

      $radioSelect = $collection->getFirstItem()->getRadioselect();
      $radioSelectArray = explode('#',$radioSelect);
      //end of selection
      //echo '<pre>';print_r($radioSelectArray);
      $html .='<div class="application-main">Applications</div>';
      //collection of main parent
      foreach($this->getAttributeCollection() as $application){
      $i=0;
      $html .='<div class="'.strtolower($application->getTitle()).'-main filter-options-title">'.$application->getTitle().'</div>';
      $secondLevelCollection = $this->getAttributeCollection($application->getId());
      //echo '<pre>';print_r($secondLevelCollection->getData());

      //second level
      foreach($secondLevelCollection as $secondLevel){
        //echo $secondLevel->getTitle().'--';
        $html .='<div style=display:block; class="main-child  '.strtolower($application->getTitle()).'-chlid">
        <div class="'.strtolower($secondLevel->getTitle()).'-child inner-child">- '.$secondLevel->getTitle().'</div>';
        if($secondLevel->getApplicationAttributes()){
          $applicationOptions = $this->unserializeData($secondLevel->getApplicationAttributes());
          //echo '<pre>';print_r($applicationOptions);
          foreach($applicationOptions as $options){
            $html .='<li class="item" data-label="'.$options['options'].'" style="list-style:none;">';
            if($secondLevel->getTitle() == 'Quantity' && isset($options['options'])){
              
              $html .='<input name="'.$secondLevel->getId().'quantity" class="nav-radio" value="'.strtolower($application->getTitle()).'-'.$secondLevel->getId().'-'.$options['options'].'" type="radio"><span class="label">'.$options['options'].'</span></li>';
            }else{
              if(isset($options['options'])){
                $watt = 0;
                if(isset($options['watt'])){
                   $watt = $options['watt'];
                }

                $wattValueCheckbox = strtolower($application->getTitle()).'-'.$secondLevel->getId().'-'.$options['options'].'-'.$watt;
                $wattValueCheckboxS = str_replace(' ','',$wattValueCheckbox);
                $wattValueCheckboxSK = str_replace('"','',$wattValueCheckboxS);
                
                //$html .='<input name="amshopby" class="nav-checkbox" type="checkbox" value="'.strtolower($application->getTitle()).'-'.$secondLevel->getId().'-'.$options['options'].'-'.$watt.'"><span class="label">'.$options['options'].'</span></li>';
                $html .='<input name="amshopby" class="nav-checkbox" type="checkbox" value="'.$wattValueCheckboxSK.'"><span class="label">'.$options['options'].'</span></li>';

              }
            }

          }
        }

        //third level data
        $thirdLevelCollection = $this->getAttributeCollection($secondLevel->getId());
        /*echo '<pre>';print_r($thirdLevelCollection->getData());
        echo '~~~~~';*/
        //echo '<pre>';print_r($optionSelectArray);
        foreach($thirdLevelCollection as $thirdLevel){
          $html .='<div class="main-chlid '.strtolower($application->getTitle()).'-chlid">
          <div class="'.strtolower($thirdLevel->getTitle()).'-child inner-child">'.$thirdLevel->getTitle().'</div>';
           $applicationOptions = $this->unserializeData($thirdLevel->getApplicationAttributes());
          //echo '<pre>';print_r($applicationOptions);
          foreach($applicationOptions as $options){
            $html .='<li style="list-style:none;" class="item" data-label="'.$options['options'].'">';
            if($thirdLevel->getTitle() == 'Quantity' && isset($options['options'])){
                
              $html .='<input name="'.$thirdLevel->getId().'quantity" class="nav-radio" value="'.strtolower($application->getTitle()).'-'.$thirdLevel->getId().'-'.$options['options'].'" type="radio"><span class="label">'.$options['options'].'</span></li>';
            }else{
              if(isset($options['options'])){
                $watt = 0;
                if(isset($options['watt'])){
                   $watt = $options['watt'];
                }

                $wattValueCheckbox = strtolower($application->getTitle()).'-'.$thirdLevel->getId().'-'.$options['options'].'-'.$watt;
                $wattValueCheckboxS = str_replace(' ','',$wattValueCheckbox);
                $wattValueCheckboxSK = str_replace('"','',$wattValueCheckboxS);
                //echo $wattValueCheckboxSK.'---';
                //if($this->getSelectOption($wattValueCheckboxSK,$optionSelectArray)){
                
                $html .='<input name="amshopby" class="nav-checkbox" type="checkbox" value="'.$wattValueCheckboxSK.'"><span class="label">'.$options['options'].'</span></li>';
              }
            }

          }
          $html .= '</div>';
        }
        $html .= '</div>';
      }



      $wattvalue = 0;
      if(isset($wattArray[strtolower($application->getTitle()).'-wattvalue'])){
        $wattvalue = $wattArray[strtolower($application->getTitle()).'-wattvalue'];
      }
      $html .= '<input type="hidden" name="'.strtolower($application->getTitle()).'-wattvalue" value="'.$wattvalue.'" id="'.strtolower($application->getTitle()).'-wattvalue" class="'.strtolower($application->getTitle()).'-wattvalue wattcalculation" />';

      $wattvalue = 1;
      if(isset($wattArray[strtolower($application->getTitle()).'-wattqty'])){
        $wattvalue = $wattArray[strtolower($application->getTitle()).'-wattqty'];
      }
      $html .= '<input type="hidden" name="'.strtolower($application->getTitle()).'-wattqty" id="'.strtolower($application->getTitle()).'-wattqty" value="'.$wattvalue.'" class="'.strtolower($application->getTitle()).'-wattqty wattcalculation" />';

      $wattvalue = 0;
      if(isset($wattArray[strtolower($application->getTitle()).'-totalwatt'])){
        $wattvalue = $wattArray[strtolower($application->getTitle()).'-totalwatt'];
      }
      $html .= '<input type="hidden" name="'.strtolower($application->getTitle()).'-totalwatt" value="'.$wattvalue.'" id="'.strtolower($application->getTitle()).'-totalwatt" class="'.strtolower($application->getTitle()).'-totalwatt innertotalwatt wattcalculation" />';

    }
    $totalwatt = 0;
    if(isset($wattArray['totalwatt'])){
      $totalwatt = $wattArray['totalwatt'];
    }
    $optionSelectVal = '';
    if($optionSelect){
       $optionSelectVal = $optionSelect;
    }
    $html .= '<input type="hidden" name="totalwatt" value="'.$totalwatt.'" id="totalwatt" class="totalwatt wattcalculation" />';
    $html .= '<input type="hidden" name="select-option" value="'.$optionSelectVal.'" id="select-option" class="select-option" />';
    $html .= '<input type="hidden" name="category_id" value="'.$catId.'" id="category_id" class="category_id" />';
    if($htmlJs==1){
      return $html;
    }
    }

    public function getApplicationOptionsValue()
    {
        $applicationType = $this->helper->getValueFromApplication();
        $applicationOption = array();
        foreach($applicationType as $option){
            $applicationOption[$option['application']] = $option['application'];
        }
        return $applicationOption;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function unserializeData($string)
    {
        $result = json_decode($string, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            if ($this->serializer->unserialize($string)!==false) {
                return $this->serializer->unserialize($string);
            }
            throw new \InvalidArgumentException('Unable to unserialize value.');
        }
        return $result;
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getSelectOption($optionValue, $selectoptionArray){
      if (in_array($optionValue, $selectoptionArray))
      {
        return 1;
      }else{
        return 0;
      }

    }

    public function isModuleEnabled(){
      return $this->helper->isModuleEnabled();
    }
}