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
namespace Webkul\MarketplaceGstIndia\Block\Customer\Widget;

use Magento\Customer\Model\AddressFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Gstin extends Template
{
    /**
     * @var AddressFactory
     */
    protected $_addressFactory;

    /**
     * Custom constructor.
     * @param Context $context
     * @param AddressFactory $addressFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        AddressFactory $addressFactory,
        array $data = []
    ) {
        $this->_addressFactory = $addressFactory;
        parent::__construct($context, $data);
    }

    /**
     * Initialized construct
     *
     * @return void
     */
    public function _construct()
    {
        parent::_construct();

        // default template location
        $this->setTemplate('Webkul_MarketplaceGstIndia::widget/gstin.phtml');
    }

    /**
     * Get GST Value From Address
     *
     * @return string|null
     */
    public function getValue()
    {
        $addressId = $this->getRequest()->getParam('id');
        if ($addressId) {
            $addressCollection = $this->_addressFactory->create()->load($addressId);
            $gstin = $addressCollection->getGstin();
            if ($gstin) {
                return $gstin;
            }
        }
        return null;
    }
}
