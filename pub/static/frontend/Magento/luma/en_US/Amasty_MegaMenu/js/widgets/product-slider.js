define([
    'jquery',
    'uiRegistry',
    'ammenu_helpers',
    'Amasty_Base/vendor/slick/slick.min'
], function ($, registry, helpers) {
    $.widget('ammenu.ProductSlider', {
        components: [
            'index = ammenu_wrapper'
        ],
        selectors: {
          slickInit: '.slick-initialized'
        },

        _create: function () {
            var self = this;

            registry.get(self.components, function () {
                helpers.initComponentsArray(arguments, self);
                self._initSlider();
            });
        },

        /**
         * Slick Slider Initialization
         *
         * @desc Slick slider init and generating options
         */
        _initSlider: function () {
            var self = this;

            if (self.ammenu.isMobile) {
                self.options = {
                    infinite: true,
                    autoplay: false,
                    dots: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                };
            }

            $(self.element).not(self.selectors.slickInit).slick(self.options);
        }
    });

    return $.ammenu.ProductSlider;
});
