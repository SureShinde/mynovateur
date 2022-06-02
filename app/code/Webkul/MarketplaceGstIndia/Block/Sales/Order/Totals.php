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
namespace Webkul\MarketplaceGstIndia\Block\Sales\Order;

/**
 * @api
 */
class Totals extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $mpGstHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper
     * @param \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository
     * @param \Magento\Tax\Model\Config $taxConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper,
        \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository,
        \Magento\Tax\Model\Config $taxConfig,
        array $data = []
    ) {
        $this->mpGstHelper = $mpGstHelper;
        $this->orderItemRepository = $orderItemRepository;
        $this->_config = $taxConfig;
        parent::__construct($context, $data);
    }

    /**
     * Get totals source object
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    /**
     * Create the mpGstHelper ("GST") totals summary
     *
     * @return $this
     */
    public function initTotals()
    {
        $items = $this->getSource()->getAllItems();
        $store = $this->getSource()->getStore();
        $gstTotal = 0;
        $basegstTotal = 0;
        foreach ($items as $item) {
            if (!empty($item->getOrderItemId())) {
                $id = $item->getOrderItemId();
            } else {
                $id = $item->getId();
            }
            $orderItem = $this->orderItemRepository->get($id);

            $baseitemPrice = $orderItem->getBaseOriginalPrice();
            $taxPercent = $orderItem->getTaxPercent();
            if (empty($item->getQty())) {
                $ratio = 1;
                if ($item instanceof \Magento\Sales\Model\Order\Creditmemo\Item) {
                    $ratio = 0;
                }
            } else {
                $ratio = $item->getQty() / $orderItem->getQtyOrdered();
            }
            $gstTotal += ($orderItem->getData('gst') * $ratio);
            $basegstTotal += (($baseitemPrice*$ratio)*$taxPercent)/100;
        }
        $gstBaseTotal = $basegstTotal;
        if ($gstTotal) {
            $label = __('GST');
            if ($this->mpGstHelper->showIncludeExclude() == 1) {
                if ($this->mpGstHelper->isGstExclude()) {
                    $label = __('Exclusive GST');
                } else {
                    $label = __('Inclusive GST');
                }
            }
            // Add our total information to the set of other totals
            $total = new \Magento\Framework\DataObject(
                [
                    'code' => 'gst',
                    'label' => $label,
                    'value' => $gstTotal,
                    'base_value' => $gstBaseTotal
                ]
            );
            if ($this->getBeforeCondition()) {
                $this->getParentBlock()->addTotalBefore($total, $this->getBeforeCondition());
            } else {
                $this->getParentBlock()->addTotal($total, $this->getAfterCondition());
            }
        }
        $this->_initGrandTotal();
        return $this;
    }

    /**
     * Create the mpGstHelper ("Grand Total") totals summary
     *
     * @return $this
     */
    protected function _initGrandTotal()
    {
        $store = $this->getSource()->getStore();
        $parent = $this->getParentBlock();
        $grandototal = $parent->getTotal('grand_total');
        if (!$grandototal || !(double)$this->getSource()->getGrandTotal()) {
            return $this;
        }
        $items = $this->getSource()->getAllItems();
        $gstTotal = 0;
        $basegstTotal = 0;
        foreach ($items as $item) {
            if (!empty($item->getOrderItemId())) {
                $id = $item->getOrderItemId();
            } else {
                $id = $item->getId();
            }
            $orderItem = $this->orderItemRepository->get($id);
            $baseitemPrice = $orderItem->getBaseOriginalPrice();
            $taxPercent = $orderItem->getTaxPercent();
            if (empty($item->getQty())) {
                $ratio = 1;
                if ($item instanceof \Magento\Sales\Model\Order\Creditmemo\Item) {
                    $ratio = 0;
                }
            } else {
                $ratio = $item->getQty() / $orderItem->getQtyOrdered();
            }
            $gstTotal += ($orderItem->getData('gst') * $ratio);
            $basegstTotal += (($baseitemPrice*$ratio)*$taxPercent)/100;
        }
        if ($this->_config->displaySalesTaxWithGrandTotal($store)) {
            $grandtotal = $this->getSource()->getGrandTotal();
            $baseGrandtotal = $this->getSource()->getBaseGrandTotal();
            $grandtotalExcl = $grandtotal - $gstTotal;
            $baseGrandtotalExcl = $baseGrandtotal - $basegstTotal;
            $grandtotalExcl = max($grandtotalExcl, 0);
            $baseGrandtotalExcl = max($baseGrandtotalExcl, 0);
            $totalExcl = new \Magento\Framework\DataObject(
                [
                    'code' => 'grand_total',
                    'strong' => true,
                    'value' => $grandtotalExcl,
                    'base_value' => $baseGrandtotalExcl,
                    'label' => __('Grand Total (Excl.Tax)'),
                ]
            );
            $totalIncl = new \Magento\Framework\DataObject(
                [
                    'code' => 'grand_total_incl',
                    'strong' => true,
                    'value' => $grandtotal,
                    'base_value' => $baseGrandtotal,
                    'label' => __('Grand Total (Incl.Tax)'),
                ]
            );
            $parent->addTotal($totalIncl, 'grand_total');
            $parent->addTotal($totalExcl, 'tax');
            $this->_addTax('grand_total');
        }
        return $this;
    }
    /**
     * Add tax total string
     *
     * @param string $after
     * @return \Magento\Tax\Block\Sales\Order\Tax
     */
    protected function _addTax($after = 'discount')
    {
        $taxTotal = new \Magento\Framework\DataObject(['code' => 'gst', 'block_name' => $this->getNameInLayout()]);
        $totals = $this->getParentBlock()->getTotals();
        if (isset($totals['grand_total_incl'])) {
            $this->getParentBlock()->addTotal($taxTotal, 'grand_total');
        }
        $this->getParentBlock()->addTotal($taxTotal, $after);
        return $this;
    }
}
