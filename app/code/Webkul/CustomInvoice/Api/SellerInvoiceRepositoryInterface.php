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


namespace Webkul\CustomInvoice\Api;

/**
 * SellerInvoiceRepository Interface
 */
interface SellerInvoiceRepositoryInterface
{

    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\CustomInvoice\Model\SellerInvoice
     */
    public function getById($id);
    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\CustomInvoice\Model\SellerInvoice
     */
    public function save(\Webkul\CustomInvoice\Model\SellerInvoice $subject);
    /**
     * get list
     *
     * @param Magento\Framework\Api\SearchCriteriaInterface $creteria
     * @return Magento\Framework\Api\SearchResults
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $creteria);
    /**
     * delete
     *
     * @param \Webkul\CustomInvoice\Model\SellerInvoice $subject
     * @return boolean
     */
    public function delete(\Webkul\CustomInvoice\Model\SellerInvoice $subject);
    /**
     * delete by id
     *
     * @param int $id
     * @return boolean
     */
    public function deleteById($id);

}

