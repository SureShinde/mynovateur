/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'Webkul_MarketplaceGstIndia/js/action/set-shipping-information': true
            },
            'Magento_Checkout/js/view/billing-address': {
                'Webkul_MarketplaceGstIndia/js/billing-address-mixin': true
            },
            'Temando_Shipping/js/view/checkout/shipping-information/address-renderer/shipping': {
                'Webkul_MarketplaceGstIndia/js/shipping-mixin': true
            } ,
            'Magento_Checkout/js/view/shipping-address/address-renderer/default': {
                'Webkul_MarketplaceGstIndia/js/shipping-mixin': true
            }
    
        }
    },
};
