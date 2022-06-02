require([
    'jquery',
    'mage/smart-keyboard-handler',
    'mage/mage',
    'mage/ie-class-fixer',
    'domReady!'
], function($){
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 300) {
            jQuery('#back_top').fadeIn();
        } else {
            jQuery('#back_top').fadeOut();
        }
    });
    jQuery("#back_top").click(function() {
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
    jQuery('.product.media').mage('sticky', {
        container: '.product-info-main-wrapper'
    });
    jQuery(".product-info-main .data.item.title").click(function(){
        setTimeout(function (){
            $('.product.media').trigger("dimensionsChanged");
        }, 500);
    });
});
