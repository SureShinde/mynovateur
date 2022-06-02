<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Model\Total\Creditmemo;

use Webkul\MarketplaceGstIndia\Helper\Data as GstHelper;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\App\ObjectManager;

class Gst extends \Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal
{
    /**
     * Gst data
     *
     * @var GstHelper
     */
    protected $_mpGstHelper = null;

    /**
     * Instance of serializer.
     *
     * @var Json
     */
    private $serializer;

    /**
     * Constructor
     *
     * By default is looking for first argument as array and assigns it as object
     * attributes This behavior may change in child classes
     *
     * @param GstHelper $sstHelper
     * @param array $data
     * @param Json|null $serializer
     */
    public function __construct(
        GstHelper $sstHelper,
        array $data = [],
        Json $serializer = null
    ) {
        $this->_sstHelper = $sstHelper;
        $this->serializer = $serializer ?: ObjectManager::getInstance()->get(Json::class);
        parent::__construct($data);
    }

    /**
     * Collect Weee amounts for the creditmemo
     *
     * @param  \Magento\Sales\Model\Order\Invoice $creditmemo
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Creditmemo $creditmemo)
    {
        $store = $creditmemo->getStore();
        $order = $creditmemo->getOrder();
        $totalgst = 0;
        $basegstTotal = 0;

        if (!$this->_sstHelper->isEnabled() || !$this->_sstHelper->isGstExclude()) {
            return $this;
        }

        foreach ($creditmemo->getAllItems() as $item) {
            $orderItem = $item->getOrderItem();
            $orderItemQty = $orderItem->getQtyOrdered();
            $baseitemPrice = $orderItem->getBaseOriginalPrice();
            $taxPercent = $orderItem->getTaxPercent();
            if (!$orderItemQty || $orderItem->isDummy() || $item->getQty() < 0) {
                continue;
            }
            $ratio = $item->getQty() / $orderItemQty;
            $orderItemGstAmount = $orderItem->getGst();
            $totalgst += $creditmemo->roundPrice($orderItemGstAmount * $ratio);
            $basegstTotal += $creditmemo->roundPrice((($baseitemPrice*$ratio)*$taxPercent)/100);
        }
        $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $totalgst);
        $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $basegstTotal);
        return $this;
    }
}
