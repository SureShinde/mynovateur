/**
 *  Amasty Submenu Builder UI Component
 */

define([
    'jquery',
    'ko',
    'uiComponent',
    'underscore',
    'ammenu_helpers'
], function ($, ko, Component, _, helpers) {
    'use strict';

    return Component.extend({
        defaults: {
            hoverTimeout: 350,
            activeElem: false,
            drawTimeOut: null,
            template: 'Amasty_MegaMenu/submenu/builder/wrapper',
            templates: {
                itemsList: 'Amasty_MegaMenu/submenu/builder/items_list',
                itemWrapper: 'Amasty_MegaMenu/submenu/builder/item_wrapper',
                contentBlock: 'Amasty_MegaMenu/submenu/builder/content_block'
            },
            imports: {
                color_settings: "ammenu_wrapper:color_settings",
                is_icons_available: "ammenu_wrapper:is_icons_available",
                root_templates: "ammenu_wrapper:templates",
                animation_time: "ammenu_wrapper:animation_time"
            }
        },
        selectors: {
            slick: '.slick-initialized'
        },

        /**
         * Init root submenu element
         *
         * @param {Object} item
         */
        initRoot: function (item) {
            var self = this;

            item.isActive.subscribe(function (value) {
                if (value) {
                    item.isContentActive(true);
                    self.activeElem = item;
                }
            });

            self._initElems(item.elems);
        },

        /**
         * Content Block Init
         *
         * @params {Object} node content node
         * @params {Object} item target item
         *
         * @desc Start method after render content block
         */
        initContent: function (node, item) {
            helpers.updateFormKey(node);
            helpers.sliderResizeSubscribe(node, item.isContentActive);
            $(node).trigger('contentUpdated');
        },

        /**
         * Set current item to active state with delay
         *
         * @param {Object} item
         */
        setActiveItem: function (item) {
            var self = this;

            if (item.isActive() && item.isContentActive()) {
                return;
            }

            self.clearHoverTimeout();

            self.drawTimeOut = setTimeout(function () {
                if (self.activeElem) {
                    self.setParentsTreeState(self.activeElem, false);
                    self.activeElem.isContentActive(false);
                }

                self.setParentsTreeState(item, true);
                item.isContentActive(true);
                self.activeElem = item;
            }, self.hoverTimeout);
        },

        /**
         * Reset target submenu to default state
         *
         * @param {Object} item target submenu
         */
        reset: function (item) {
            var self = this;

            self.clearHoverTimeout();
            self.setParentsTreeState(self.activeElem, false);
            item.isContentActive(true);
            self.activeElem = item;
        },

        /**
         * Set Active State for each items up the tree
         *
         * @param {Object} item
         * @param {Boolean} itemState
         */
        setParentsTreeState: function (item, itemState) {
            if (!item.level()) {
                return false;
            }

            item.isActive(itemState);
            this.setParentsTreeState(item.parent, itemState);
        },

        /**
         * Clearing hover effect interval
         */
        clearHoverTimeout: function () {
            if (this.drawTimeOut) {
                clearInterval(this.drawTimeOut);

                this.drawTimeOut = null;

                return true;
            }
        },

        /**
         * Init Target elements method
         *
         * @params {Object} elems
         */
        _initElems: function (elems) {
            var self = this;

            _.each(elems, function (elem) {
                self._initElem(elem);

                if (elem.elems.length) {
                    self._initElems(elem.elems);
                }
            });
        },

        /**
         * Init Target element method
         *
         * @params {Object} elem
         */
        _initElem: function (elem) {
            if (elem.type) {
                elem.type.label = elem.type.label.split(' ').join('_');
            }

            if (elem.parent.isChildHasIcons && elem.parent.type.value === 1) {
                elem.isIconVisible(true);
            } else {
                elem.isIconVisible(elem.icon);
            }
        }
    });
});
