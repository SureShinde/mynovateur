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
 * SellerInvoice Class
 */
class SellerInvoice extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, \Webkul\CustomInvoice\Api\Data\SellerInvoiceInterface
{

    public const NOROUTE_ENTITY_ID = 'no-route';

    public const CACHE_TAG = 'webkul_custominvoice_sellerinvoice';

    protected $_cacheTag = 'webkul_custominvoice_sellerinvoice';

    protected $_eventPrefix = 'webkul_custominvoice_sellerinvoice';

    /**
     * set resource model
     */
    public function _construct()
    {
        $this->_init(\Webkul\CustomInvoice\Model\ResourceModel\SellerInvoice::class);
    }

    /**
     * Load No-Route Indexer.
     *
     * @return $this
     */
    public function noRouteReasons()
    {
        return $this->load(self::NOROUTE_ENTITY_ID, $this->getIdFieldName());
    }

    /**
     * Get identities.
     *
     * @return []
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    /**
     * Set EntityId
     *
     * @param int $entityId
     * @return Webkul\CustomInvoice\Model\SellerInvoiceInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get EntityId
     *
     * @return int
     */
    public function getEntityId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * Set InvoiceNumber
     *
     * @param string $invoiceNumber
     * @return Webkul\CustomInvoice\Model\SellerInvoiceInterface
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        return $this->setData(self::INVOICE_NUMBER, $invoiceNumber);
    }

    /**
     * Get InvoiceNumber
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return parent::getData(self::INVOICE_NUMBER);
    }

    /**
     * Set IntDocCtrN
     *
     * @param string $intDocCtrN
     * @return Webkul\CustomInvoice\Model\SellerInvoiceInterface
     */
    public function setIntDocCtrN($intDocCtrN)
    {
        return $this->setData(self::INT_DOC_CTR_N, $intDocCtrN);
    }

    /**
     * Get IntDocCtrN
     *
     * @return string
     */
    public function getIntDocCtrN()
    {
        return parent::getData(self::INT_DOC_CTR_N);
    }

    /**
     * Set OrderId
     *
     * @param int $orderId
     * @return Webkul\CustomInvoice\Model\SellerInvoiceInterface
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get OrderId
     *
     * @return int
     */
    public function getOrderId()
    {
        return parent::getData(self::ORDER_ID);
    }

    /**
     * Set SellerId
     *
     * @param int $sellerId
     * @return Webkul\CustomInvoice\Model\SellerInvoiceInterface
     */
    public function setSellerId($sellerId)
    {
        return $this->setData(self::SELLER_ID, $sellerId);
    }

    /**
     * Get SellerId
     *
     * @return int
     */
    public function getSellerId()
    {
        return parent::getData(self::SELLER_ID);
    }

    /**
     * Set Path
     *
     * @param string $path
     * @return Webkul\CustomInvoice\Model\SellerInvoiceInterface
     */
    public function setPath($path)
    {
        return $this->setData(self::PATH, $path);
    }

    /**
     * Get Path
     *
     * @return string
     */
    public function getPath()
    {
        return parent::getData(self::PATH);
    }


}

