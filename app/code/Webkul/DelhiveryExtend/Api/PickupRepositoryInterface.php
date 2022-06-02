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
 * PickupRepository Interface
 */
interface PickupRepositoryInterface
{

    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\DelhiveryExtend\Model\Pickup
     */
    public function getById($id);
    /**
     * get by id
     *
     * @param int $id
     * @return \Webkul\DelhiveryExtend\Model\Pickup
     */
    public function save(\Webkul\DelhiveryExtend\Model\Pickup $subject);
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
     * @param \Webkul\DelhiveryExtend\Model\Pickup $subject
     * @return boolean
     */
    public function delete(\Webkul\DelhiveryExtend\Model\Pickup $subject);
    /**
     * delete by id
     *
     * @param int $id
     * @return boolean
     */
    public function deleteById($id);

}

