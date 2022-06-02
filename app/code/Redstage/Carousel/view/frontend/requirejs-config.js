var config = {
    map: {
        '*': {
            'foundation':'Redstage_Carousel/js/carousel/foundation',
            'foundationOrbit':'Redstage_Carousel/js/carousel/foundation.orbit'

        }
    },
    shim: {
        'Redstage_Carousel/js/carousel/foundation': {
            deps: ['jquery']
        },
        'Redstage_Carousel/js/carousel/foundation.orbit': {
            deps: ['jquery','foundation']
        }
    }
};

