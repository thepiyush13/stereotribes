Campaign = {
    
    flipImageIframeLoad : function () {
        var response = jQuery('#flipImageUploadIframe').contents().find("body").text();
    
        try {
            var json = jQuery.parseJSON(response);
        } catch (err) {
            var json = false;
        }
   
        //jQuery('.ajax-loader').hide();
        //if(!json) return;
    
        console.log("res :",json);
    
        jQuery('#flipImage').attr('src', json.data.picUrl);
    
    }
}