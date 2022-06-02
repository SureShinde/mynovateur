/**
 *  Amasty simple submenu UI Component
 */

define([
    'jquery',
    'ko',
    'uiComponent',
    'ammenu_helpers'
], function ($, ko, Component, helpers) {
    'use strict';

    return Component.extend({
        defaults: {
            activeElem: false,
            template: 'Amasty_MegaMenuLite/submenu/simple/wrapper',
            imports: {
                color_settings: "ammenu_wrapper:color_settings",
                is_icons_available: "ammenu_wrapper:is_icons_available",
                root_templates: "ammenu_wrapper:templates",
                animation_time: "ammenu_wrapper:animation_time"
            }
        },

        /**
         * Simple menu init method
         *
         * @params {Object} element - simple menu wrapper
         * @params {Object} context - view model
         */
        init: function (element, context) {
            this._applyBindings(element, context);
            helpers.sliderResizeSubscribe(element, context.item.isActive);
            helpers.updateFormKey(element);
        },

        /**
         * Applying Bindings in target element
         *
         * @private
         */
        _applyBindings: function (element, context) {
            ko.applyBindingsToDescendants(context, element);
            $(element).trigger('contentUpdated');
        }
    });
});
