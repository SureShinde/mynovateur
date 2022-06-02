/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

/*jshint browser:true jquery:true*/
/*global alert*/
define([
    'jquery',
    'underscore',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, _, wrapper, quote) {
    'use strict';

    return function (setShippingInformationAction) {
        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();
            var billingAddress = quote.billingAddress();
            var self = this;
            if (shippingAddress['extensionAttributes'] === undefined) {
                shippingAddress['extensionAttributes'] = {};
            }

            if (billingAddress != null && billingAddress['extensionAttributes'] === undefined) {
                billingAddress['extensionAttributes'] = {};
            }

            if (shippingAddress['extensionAttributes']['gstin'] === undefined) {
                shippingAddress['extensionAttributes']['gstin'] = '';
            }

            if (billingAddress != null && billingAddress['extensionAttributes']['gstin'] === undefined) {
                billingAddress['extensionAttributes']['gstin'] = '';
            }

            if (typeof shippingAddress.customAttributes == 'object') {
                $.each(shippingAddress.customAttributes, function (key, attr) {
                    if (attr.attribute_code == 'gstin' && key == 'gstin') {
                        shippingAddress['extensionAttributes']['gstin'] = attr.value;
                    }
                });
            }

            if (billingAddress != null && typeof billingAddress.customAttributes == 'object') {
                $.each(billingAddress.customAttributes, function (key, attr) {
                    if (attr.attribute_code == 'gstin' && key == 'gstin') {
                        billingAddress['extensionAttributes']['gstin'] = attr.value;
                    }
                });
            }
            return originalAction();
        });
    };
});
