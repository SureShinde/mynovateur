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
namespace Webkul\MarketplaceGstIndia\Model\Checkout;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Store\Model\StoreManagerInterface;
use Webkul\MarketplaceGstIndia\Helper\Data;

class ConfigProvider implements ConfigProviderInterface
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @param StoreManagerInterface $storeManagerInterface
     * @param Data $helper
     */
    public function __construct(
        StoreManagerInterface $storeManagerInterface,
        Data $helper
    ) {
        $this->_storeManager = $storeManagerInterface;
        $this->helper = $helper;
    }

    /**
     * Get gst details
     */
    public function getConfig()
    {
        $baseUrl = $this->_storeManager->getStore()->getBaseUrl();
        $config = [];
        try {
            $config['gst_info']['state'] = $this->helper->getConfigValue('state');
            $config['gst_info']['status'] = $this->helper->getConfigValue('status');
            $config['gst_info']['gstin'] = $this->helper->getConfigValue('gstin');
            $config['gst_info']['baseUrl'] = $baseUrl;
            return $config;
        } catch (\Exception $e) {
            $config = [];
        }

        return $config;
    }
}
