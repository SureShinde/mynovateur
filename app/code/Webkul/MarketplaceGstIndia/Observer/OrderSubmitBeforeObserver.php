<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 *
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Webkul gst OrderSubmitBeforeObserver Observer Model.
 */
class OrderSubmitBeforeObserver implements ObserverInterface
{
    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $helper;
    
    /**
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $helper
     */
    public function __construct(
        \Webkul\MarketplaceGstIndia\Helper\Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Set SGST, CGST, IGST
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->helper->getConfigValue('status')) {
            $quote = $observer->getQuote();
            foreach ($quote->getAllVisibleItems() as $item) {
                $productId = $item->getProductId();
                if (!empty($productId)) {
                    $product = $this->helper->getProductById($productId);
                    $taxPercent = $product->getGstPercent();
                    if (!empty($taxPercent)) {
                        $item->setTaxPercent($taxPercent)
                            ->save();
                    }
                }
            }
        }
    }
}
