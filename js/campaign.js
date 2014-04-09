Campaign = {
    
    flipImageIframeLoad : function () {
        var response = jQuery('#flipImageUploadIframe').contents().find("body").text();
        if (!response) return;
    
        try {
            var json = jQuery.parseJSON(response);
        } catch (err) {
            var json = false;
        }
    
        jQuery('#flipImage').attr('src', json.data.picUrl);
        var scope = angular.element($("#step2")).scope();
        scope.$apply(function(){
            scope.designFlipBox.flipImageUrl = json.data.picUrl;
        })
    },
    
    awesomeCampaignIframeLoad : function() {
        var json = this.getFrameContent('#awesomeImageUploadIframe');
        if(!json) return;
    
        jQuery('#awesomePicUrl').attr('src', json.data.picUrl);
        var scope = angular.element($("#step2")).scope();
        scope.$apply(function(){
            scope.awesomeCampaign.imageUrl = json.data.picUrl;
        })
    },
    
    fundThankyouIframeLoad : function() {
        var json = this.getFrameContent('#fundThankyouUploadIframe');
        if(!json) return;
    
        jQuery('#thankyouPicUrl').attr('src', json.data.picUrl);
        var scope = angular.element($("#step3")).scope();
        scope.$apply(function(){
            scope.fundThankyou.thankyouImageUrl = json.data.picUrl;
        })
    },
    
    
    mediaLinkIframeUpload: function(e) {
        var json = this.getFrameContent('#mediaLinkIFrame_'+e);
        if(!json) return;
    
        jQuery('#mediaLinkIFrame_'+e).attr('src', json.data.picUrl);
        var scope = angular.element($("#step3")).scope();
        scope.$apply(function(){
            $(scope.mediaLinks.image).each(function(key, o) {
                console.log(e)
                if('image_'+o.id == e ) {
                    scope.mediaLinks.image[key].codeUrl = json.data.picUrl;
                    console.log(o);
                } 
            });
            scope.mediaLinks.image[0].picUrl = json.data.picUrl;
        })
    },
    
    getFrameContent: function(frameId) {
        var response = jQuery(frameId).contents().find("body").text();
        if (!response) return;
    
        try {
            var json = jQuery.parseJSON(response);
        } catch (err) {
            var json = false;
        }
        return json;
    }
    
    
}

/** 
     * Trigger flip image upload
     */
$('#flipImageUploadForm').on('change', function() {
    $('#flipImageUploadForm').submit();
});
    
    
/** 
     * Trigger campaign image upload
     */
$('#awesomeCampaignImage').on('change', function() {
    $('#awesomeImageUploadForm').submit();
});

$('#fundThankyouImage').on('change', function() {
    $('#fundThankyouUploadForm').submit();
});
