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
 * ShipmentRepository Interface
 */
interface ShipmentRepositoryInterface
{

    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\DelhiveryExtend\Model\Shipment
     */
    public function getById($id);
    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\DelhiveryExtend\Model\Shipment
     */
    public function save(\Webkul\DelhiveryExtend\Model\Shipment $subject);
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
     * @param \Webkul\DelhiveryExtend\Model\Shipment $subject
     * @return boolean
     */
    public function delete(\Webkul\DelhiveryExtend\Model\Shipment $subject);
    /**
     * delete by id
     *
     * @param int $id
     * @return boolean
     */
    public function deleteById($id);

}

