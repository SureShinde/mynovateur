/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

/**
 * @api
 */

define([
    'Magento_Checkout/js/view/summary/abstract-total',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/totals',
    'Magento_Catalog/js/price-utils'
], function(Component, quote, totals, $t) {
    'use strict';

    var adminState = window.checkoutConfig.gst_info.state;
    var gstModuleStatus = window.checkoutConfig.gst_info.status;

    return Component.extend({
        defaults: {
            template: 'Webkul_MarketplaceGstIndia/checkout/summary/gst'
        },
        isIncludedInSubtotal: window.checkoutConfig.isIncludedInSubtotal,
        totals: totals.totals,

        /**
         * @returns {Number}
         */
        getGstSegment: function() {
            var gst = totals.getSegment('gst');

            if (gst !== null && gst.hasOwnProperty('value')) {
                return gst.value;
            }

            return 0;
        },

        /**
         * Get Gst value
         * @returns {String}
         */
        getValue: function() {
            return this.getFormattedPrice(this.getGstSegment());
        },

        /**
         * Get Sgst value
         * @returns {String}
         */
        getSgstValue: function() {
            var sgst = totals.getSegment('sgst');

            if (sgst !== null && sgst.hasOwnProperty('value')) {
                return this.getFormattedPrice(sgst.value);
            }

            return 0;
        },

        /**
         * Get Cgst value
         * @returns {String}
         */
        getCgstValue: function() {
            var cgst = totals.getSegment('cgst');

            if (cgst !== null && cgst.hasOwnProperty('value')) {
                return this.getFormattedPrice(cgst.value);
            }

            return 0;
        },

        /**
         * Get Igst value
         * @returns {String}
         */
        getIgstValue: function() {
            let igst = totals.getSegment('igst');

            if (igst !== null && igst.hasOwnProperty('value')) {
                return this.getFormattedPrice(igst.value);
            }

            return 0;
        },

        /**
         * Get Igst value
         * @returns {String}
         */
        getUtgstValue: function() {
            let utgst = totals.getSegment('utgst');

            if (utgst !== null && utgst.hasOwnProperty('value')) {
                return this.getFormattedPrice(utgst.value);
            }

            return 0;
        },

        /**
         * Gst display flag
         * @returns {Boolean}
         */
        isDisplayed: function() {
            return this.isFullMode() && this.getGstSegment() > 0;
        },
        /**
         * Get Gst Module Status
         */
        getGstModuleStatus: function() {
            if (gstModuleStatus == 1 && this.isIndianAddress()) {
                return true;
            }

            return false;
        },
        /**
         * Is Indian Address
         */
        isIndianAddress: function() {
            if (quote.shippingAddress()) {
                if (quote.shippingAddress().countryId == 'IN') {
                    return true;
                }
            } else if (quote.billingAddress()) {
                if (quote.billingAddress().countryId == 'IN') {
                    return true;
                }
            }

            return false;
        },
        /**
         * return same state tax title
         */
        getStateTaxTitle: function() {
            return "SGST";
        },

        /**
         * return same state tax title
         */
        getCentralTaxTitle: function() {
            return "CGST";
        },

        /**
         * return other state tax title
         */
        getInterTaxTitle: function() {
            return "IGST";
        },
        
        /**
         * return other state tax title
         */
        getUtTaxTitle: function() {
            return "UTGST";
        },
    });
});
