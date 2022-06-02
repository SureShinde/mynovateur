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
namespace Webkul\MarketplaceGstIndia\Block\Customer;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;

class ManageConfig extends Template
{
    /**
     * @var Session
     */
    protected $_customerSession;

    /**
     * @var \Webkul\MarketplaceGstIndia\Model\Config\Source\States
     */
    protected $_sourceStates;

    /**
     * @var \Webkul\Marketplace\Helper\Data
     */
    protected $_mpHelper;

    /**
     * @var \Webkul\MarketplaceGstIndia\Helper\Data
     */
    protected $_mpGstHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param Session $customerSession
     * @param \Webkul\MarketplaceGstIndia\Model\Config\Source\States $sourceStates
     * @param \Webkul\Marketplace\Helper\Data $mpHelper
     * @param \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Session $customerSession,
        \Webkul\MarketplaceGstIndia\Model\Config\Source\States $sourceStates,
        \Webkul\Marketplace\Helper\Data $mpHelper,
        \Webkul\MarketplaceGstIndia\Helper\Data $mpGstHelper,
        array $data = []
    ) {
        $this->_customerSession = $customerSession;
        $this->_sourceStates = $sourceStates;
        $this->_mpHelper = $mpHelper;
        $this->_mpGstHelper = $mpGstHelper;
        parent::__construct($context, $data);
    }

    /**
     * Get current customer session.
     *
     * @return \Magento\Customer\Model\Session
     */
    public function getCustomerData()
    {
        return $this->_customerSession->getCustomer();
    }
    
    /**
     * Get States Array
     *
     * @return array
     */
    public function getStatesArray()
    {
        return $this->_sourceStates->toOptionArray();
    }

    /**
     * Get Gst Helper
     *
     * @return array
     */
    public function getGstHelper()
    {
        return $this->_mpGstHelper;
    }

    /**
     * Get Mp Helper
     *
     * @return array
     */
    public function getMpHelper()
    {
        return $this->_mpHelper;
    }
}
