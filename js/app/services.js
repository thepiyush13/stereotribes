var app = angular.module('app');

app.factory('Utils', function($q) {
    return {
        isImage: function(src) {
        
            var deferred = $q.defer();
        
            var image = new Image();
            image.onerror = function() {
                deferred.resolve(false);
            };
            image.onload = function() {
                deferred.resolve(true);
            };
            image.src = src;
        
            return deferred.promise;
        },
        
        /**
         * 
         * var p = {
                action: '',
                frmName: '',
                frmId: '',
                target: '',
                name: '',
                id: '',
                data: [{'name': '', 'value':''}],
                callback:'',
                frameId: ''
            }
         * 
         * 
         */
        fileLoader: function(p) {
            var hdnFields = '';
            for(i=0; i< data.length; i++) {
                hdnFields =+ '<input type="hidden" name="' + data[i].name + '"  value="' + data[i].name + '" />';
            }
            return '<form method="POST" action="' + p.action + '" name="' + p.frmName + '" id= "' + p.frmId + '" target="' + p.target + '" enctype="multipart/form-data">'+
            '<input type="file" name="' + p.name + '" id="' + p.id + '" multiple="multiple" />'+
            hdnFields +
            '<div class="ajax-loader"></div>'+
            '</form>'+
            '<iframe onload="' + p.callback + '" name="' + p.frameId + '" id="' + p.frameId + '"></iframe>';
        }, 
        
        isEmail: function (email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
        
        
    };
});