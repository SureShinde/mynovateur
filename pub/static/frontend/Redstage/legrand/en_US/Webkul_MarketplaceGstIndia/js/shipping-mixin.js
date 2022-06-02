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
    'underscore',
    'uiComponent',
], function (_, Component) {
    'use strict';
    return function (Component) {
        return Component.extend({
            getCustomAttributeLabel: function (attribute) {
                if(attribute.gstin) {
                    return attribute.gstin.value;
                } else {
                    this._super();
                }
            }
        });
    }
});
