/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

define([
    'Webkul_MarketplaceGstIndia/js/view/checkout/summary/gst'
], function (Component) {
    'use strict';

    return Component.extend({

        /**
         * @override
         */
        isFullMode: function () {
            return true;
        }
    });
});
