define([
    "jquery",
    "jquery/ui",
    "Magento_Ui/js/modal/alert"
], function($, ui, alert){
    "use strict";
     
    function main(config, element) {
        var $element = $(element);
        var WarrantyUrl = config.WarrantyUrl;
         
        var dataForm = $('#warranty-form');
        dataForm.mage('validation', {});
        $(document).ready(function () { 
        $('#submit-warranty').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation(); 
            if (dataForm.valid()){
                $('#warranty-form').attr('action',WarrantyUrl);
                $('#warranty-form').submit();
                /*var param = dataForm.serialize();
                    $.ajax({
                        showLoader: true,
                        url: WarrantyUrl,
                        data: param,
                        type: "POST",
                        cache: false,
                        success: function(data){
                        var titleData;
                        if(data.success){
                            titleData = 'Success';
                        }else{
                            titleData = 'Error';
                        }
                        alert({
                            title: titleData,
                            content: data.html,
                            clickableOverlay:false,
                            actions: {
                                always: function(){}
                            }
                        });
                        document.getElementById("warranty-form").reset();
                        event.stopImmediatePropagation();
                        return false;
                        },
                        error: function(){}
                    });
                    event.stopImmediatePropagation();
                    return false;*/
                }
            });
    });
    };
return main;
     
     
});