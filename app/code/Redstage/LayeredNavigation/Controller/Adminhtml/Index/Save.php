<?php
/**
 * Redstage LayeredNavigation module use for customize numeric configurator for layared navigation
 *
 * @category: PHP
 * @package: Redstage/LayeredNavigation
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_LayeredNavigation
 */

namespace Redstage\LayeredNavigation\Controller\Adminhtml\Index;
use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Redstage\LayeredNavigation\Model\LayeredNavigation;
use Magento\Framework\Serialize\SerializerInterface;
class Save extends \Magento\Backend\App\Action
{
    /*
     * @var LayeredNavigation
     */
    protected $layerednavigationmodel;
    /**
     * @var Session
     */
    protected $adminsession;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param Action\Context $context
     * @param LayeredNavigation           $layerednavigationmodel
     * @param Session        $adminsession
     */
    public function __construct(
        Action\Context $context,
        LayeredNavigation $layerednavigationmodel,
        SerializerInterface $serializer,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->layerednavigationmodel = $layerednavigationmodel;
        $this->serializer = $serializer;
        $this->adminsession = $adminsession;
    }
    /**
     * Save layerednavigationmodel record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        //echo '<pre>';print_r($data);die;
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /*if(!empty($data['product_attributes'])){
                $data['product_attributes'] = implode(",",$data['product_attributes']);
            }*/
            if (isset($data['application_attributes']) && $data['application_attributes'][0]['options']!='') {
            //echo '<pre>';print_r($data['application_attributes']);die;
            $applicationAttribute = $this->serializer->serialize($data['application_attributes']);
            $data['application_attributes'] = $applicationAttribute;
            } else {
                $data['application_attributes'] = '';
            }
            $entity_id = $this->getRequest()->getParam('entity_id');
            if ($entity_id) {
                $this->layerednavigationmodel->load($entity_id);
            }
            $this->layerednavigationmodel->setData($data);
            try {
                $this->layerednavigationmodel->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->layerednavigationmodel->getEntityId(), '_current' => true]);
                    }
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}