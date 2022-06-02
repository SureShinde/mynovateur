<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Webkul\MarketplaceGstIndia\Block\Checkout;

use Magento\Sales\Model\ConfigInterface;

/**
 * Subtotal Total Row Renderer Webkul
 */
class Grandtotal extends \Magento\Checkout\Block\Total\DefaultTotal
{
    /**
     * Path to template file
     *
     * @var string
     */
    protected $_template = 'Magento_Tax::checkout/grandtotal.phtml';

    /**
     * @var \Magento\Tax\Model\Config
     */
    protected $_taxConfigUpdated;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param ConfigInterface $salesConfig
     * @param \Magento\Tax\Model\Config $taxConfigUpdated
     * @param array $layoutProcessors
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        ConfigInterface $salesConfig,
        \Magento\Tax\Model\Config $taxConfigUpdated,
        array $layoutProcessors = [],
        array $data = []
    ) {
        $this->_taxConfigUpdated = $taxConfigUpdated;
        parent::__construct($context, $customerSession, $checkoutSession, $salesConfig, $layoutProcessors, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * Check if we have include tax amount between grandtotal incl/excl tax
     *
     * @return bool
     */
    public function includeTax()
    {
        if ($this->getTotal()->getValue()) {
            return $this->_taxConfigUpdated->displayCartTaxWithGrandTotal($this->getStore());
        }
        return false;
    }

    /**
     * Get grandtotal exclude tax
     *
     * @return float
     */
    public function getTotalExclTax()
    {
        $excl = $this->getTotal()->getValue() - $this->_totals['gst']->getValue();
        $excl = max($excl, 0);
        return $excl;
    }
}
