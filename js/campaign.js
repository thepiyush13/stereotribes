Campaign = {
    
    flipImageIframeLoad : function () {
        var response = jQuery('#flipImageUploadIframe').contents().find("body").text();
        if (!response) return;
    
        try {
            var json = jQuery.parseJSON(response);
        } catch (err) {
            var json = false;
        }
   
        //jQuery('.ajax-loader').hide();
        //if(!json) return;
    
        console.log("res :",json);
    
        jQuery('#flipImage').attr('src', json.data.picUrl);
    
    },
    
    awsomeCampaignIframeLoad : function() {
        
    } 
}