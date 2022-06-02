/**
 * Amasty MegaMenu helpers
 */

define([
    'jquery',
    'underscore',
    'mage/cookies'
], function ($, _) {
    'use strict';

    return {
        selectors: {
            formKeyInput: 'input[name="form_key"]',
            slick: '.slick-slider',
            slide: '.slick-slide'
        },
        formKey: $.mage.cookies.get('form_key'),

        /**
         * Update Form Key
         *
         * @param {Object} node
         *
         * @desc Updating inner form key inserting
         */
        updateFormKey: function (node) {
            var self = this,
                formKeyInput = $(node).find(self.selectors.formKeyInput);

            if (formKeyInput.val() !== self.formKey) {
                formKeyInput.val(self.formKey);
            }
        },

        /**
         * Components Array initialization and setting in target component
         *
         * @param {Array} array target uiClasses
         * @param {Object} component current uiClass
         */
        initComponentsArray: function (array, component) {
            _.each(array, function (item) {
                component[item.uniq_name] = item;
            });
        },

        /**
         * Slick Slider Position checking via subscriber
         *
         * @desc checking and fixing new slick sliders positions
         * @param {Object} node - slider container node
         * @param {Object} observer - ko observer
         */
        sliderResizeSubscribe: function (node, observer) {
            var self = this,
                $slider,
                $slide,
                sliderSpeed,
                subscriber = observer.subscribe(
                    _.debounce(function (value) {
                        $slider = $(node).find(self.selectors.slick);
                        $slide = $slider.find(self.selectors.slide).first();

                        if (!value) {
                            return false;
                        }

                        if (!$slider.length || $slide.width() && $slider.width()) {
                            subscriber.dispose();

                            return false;
                        }

                        sliderSpeed = $slider.slick('slickGetOption', 'speed');

                        $slider.slick('slickSetOption', 'speed', 0);
                        $slider.slick('slickGoTo', 0);
                        $slider.slick('setPosition');
                        $slider.slick('setDimensions');
                        $slider.slick('slickSetOption', 'speed', sliderSpeed);
                    }, 100)
                )
        }
    }
});
