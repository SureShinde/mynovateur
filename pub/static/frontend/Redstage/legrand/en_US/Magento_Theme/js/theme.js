require([
    'jquery'
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
});