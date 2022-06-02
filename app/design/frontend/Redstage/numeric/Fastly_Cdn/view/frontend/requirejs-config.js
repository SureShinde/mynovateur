var config = {
    config: {
        mixins: {
            'mage/gallery/gallery': {
                'Fastly_Cdn/js/gallery/gallery-mixin': false
            },
            'Magento_Swatches/js/swatch-renderer': {
                'Fastly_Cdn/js/swatch-renderer-mixin': true
            }
        }
    }
};
