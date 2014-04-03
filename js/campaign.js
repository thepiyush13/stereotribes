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
            $scope.aweSomeCampaign.picUrl = json.data.picUrl;
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