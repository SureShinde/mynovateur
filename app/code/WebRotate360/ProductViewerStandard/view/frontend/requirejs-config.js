var config = {
    config: {
        mixins: {
            'mage/gallery/gallery': {
                'Fastly_Cdn/js/gallery/gallery-mixin': false,
                'WebRotate360_ProductViewerStandard/wr360hook': true
            }
        },
    },

    map: {
        '*': {
            'imagerotator': 'WebRotate360_ProductViewerStandard/imagerotator/html/js/imagerotator'
        }
    }
};
