<?php
/**
 * Webkul Software.
 *
 * @category Webkul
 * @package Webkul_DelhiveryExtend
 * @author Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license https://store.webkul.com/license.html
 */


namespace Webkul\DelhiveryExtend\Api;

/**
 * DelhiveryWarehouseRepository Interface
 */
interface DelhiveryWarehouseRepositoryInterface
{

    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\DelhiveryExtend\Model\DelhiveryWarehouse
     */
    public function getById($id);
    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\DelhiveryExtend\Model\DelhiveryWarehouse
     */
    public function save(\Webkul\DelhiveryExtend\Model\DelhiveryWarehouse $subject);
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
     * @param \Webkul\DelhiveryExtend\Model\DelhiveryWarehouse $subject
     * @return boolean
     */
    public function delete(\Webkul\DelhiveryExtend\Model\DelhiveryWarehouse $subject);
    /**
     * delete by id
     *
     * @param int $id
     * @return boolean
     */
    public function deleteById($id);

}

