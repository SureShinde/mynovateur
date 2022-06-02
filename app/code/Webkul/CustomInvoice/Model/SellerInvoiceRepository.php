<?php
/**
 * Webkul Software.
 *
 * @category Webkul
 * @package Webkul_CustomInvoice
 * @author Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license https://store.webkul.com/license.html
 */


namespace Webkul\CustomInvoice\Model;

/**
 * SellerInvoiceRepository Class
 */
class SellerInvoiceRepository implements \Webkul\CustomInvoice\Api\SellerInvoiceRepositoryInterface
{

    protected $modelFactory = null;

    protected $collectionFactory = null;

    /**
     * initialize
     *
     * @param \Webkul\CustomInvoice\Model\SellerInvoiceFactory $modelFactory
     * @param \Webkul\CustomInvoice\Model\ResourceModel\SellerInvoice\CollectionFactory
     * $collectionFactory
     * @return void
     */
    public function __construct(\Webkul\CustomInvoice\Model\SellerInvoiceFactory $modelFactory, \Webkul\CustomInvoice\Model\ResourceModel\SellerInvoice\CollectionFactory $collectionFactory)
    {
        $this->modelFactory = $modelFactory; 
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\CustomInvoice\Model\SellerInvoice
     */
    public function getById($id)
    {
        $model = $this->modelFactory->create()->load($id);
        if (!$model->getId()) { 
         throw new \Magento\Framework\Exception\NoSuchEntityException(__('The CMS block with the "%1" ID doesn\'t exist.', $id)); 
         } 
        return $model;
    }

    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\CustomInvoice\Model\SellerInvoice
     */
    public function save(\Webkul\CustomInvoice\Model\SellerInvoice $subject)
    {
        try { 
         $subject->save(); 
        } catch (\Exception $exception) { 
         throw new \Magento\Framework\Exception\CouldNotSaveException(__($exception->getMessage())); 
        } 
         return $subject;
    }

    /**
     * get list
     *
     * @param Magento\Framework\Api\SearchCriteriaInterface $creteria
     * @return Magento\Framework\Api\SearchResults
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $creteria)
    {
        $collection = $this->collectionFactory->create(); 
         return $collection;
    }

    /**
     * delete
     *
     * @param \Webkul\CustomInvoice\Model\SellerInvoice $subject
     * @return boolean
     */
    public function delete(\Webkul\CustomInvoice\Model\SellerInvoice $subject)
    {
        try { 
        $subject->delete();
        } catch (\Exception $exception) {
        throw new \Magento\Framework\Exception\CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * delete by id
     *
     * @param int $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }


}

