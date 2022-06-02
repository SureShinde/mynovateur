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


namespace Webkul\CustomInvoice\Api\Data;

/**
 * SellerInvoice Interface
 */
interface SellerInvoiceInterface
{

    public const ENTITY_ID = 'entity_id';

    public const INVOICE_NUMBER = 'invoice_number';

    public const INT_DOC_CTR_N = 'int_doc_ctr_n';

    public const ORDER_ID = 'order_id';

    public const SELLER_ID = 'seller_id';

    public const PATH = 'path';

    /**
     * Set EntityId
     *
     * @param int $entityId
     * @return Webkul\CustomInvoice\Api\Data\SellerInvoiceInterface
     */
    public function setEntityId($entityId);
    /**
     * Get EntityId
     *
     * @return int
     */
    public function getEntityId();
    /**
     * Set InvoiceNumber
     *
     * @param string $invoiceNumber
     * @return Webkul\CustomInvoice\Api\Data\SellerInvoiceInterface
     */
    public function setInvoiceNumber($invoiceNumber);
    /**
     * Get InvoiceNumber
     *
     * @return string
     */
    public function getInvoiceNumber();
    /**
     * Set IntDocCtrN
     *
     * @param string $intDocCtrN
     * @return Webkul\CustomInvoice\Api\Data\SellerInvoiceInterface
     */
    public function setIntDocCtrN($intDocCtrN);
    /**
     * Get IntDocCtrN
     *
     * @return string
     */
    public function getIntDocCtrN();
    /**
     * Set OrderId
     *
     * @param int $orderId
     * @return Webkul\CustomInvoice\Api\Data\SellerInvoiceInterface
     */
    public function setOrderId($orderId);
    /**
     * Get OrderId
     *
     * @return int
     */
    public function getOrderId();
    /**
     * Set SellerId
     *
     * @param int $sellerId
     * @return Webkul\CustomInvoice\Api\Data\SellerInvoiceInterface
     */
    public function setSellerId($sellerId);
    /**
     * Get SellerId
     *
     * @return int
     */
    public function getSellerId();
    /**
     * Set Path
     *
     * @param string $path
     * @return Webkul\CustomInvoice\Api\Data\SellerInvoiceInterface
     */
    public function setPath($path);
    /**
     * Get Path
     *
     * @return string
     */
    public function getPath();

}

