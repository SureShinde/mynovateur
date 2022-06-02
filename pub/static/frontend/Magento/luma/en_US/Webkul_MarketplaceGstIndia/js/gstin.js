require([
  'jquery',
  'mage/mage',
], function($){   
    if($('#country').children("option:selected").val()=='IN'){
        $(".field-name-gstin").show();    
    }else{
        $(".field-name-gstin").hide();    
    } 
    $(document).on('change','#country',function() {
    var countryCode = $('#country').val();
        if(countryCode=='IN'){
            $(".field-name-gstin").show();    
        }else{
            $(".field-name-gstin").hide();    
        }  
    }); 
});