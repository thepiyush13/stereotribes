var app = angular.module('app');
app.directive('datepicker', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function (scope, element, attrs, ngModelCtrl) {
             
            element.datePicker().change(function(){
                var v = this.value;
                scope.$apply(function () {
                    ngModelCtrl.$setViewValue(v);
                });
            //scope.goalSetting.paymentDate = this.value;
            //scope.$apply();
            });
        }
    };
})

.directive('ngFocus', ['$parse', function($parse) {
    return function(scope, element, attr) {
        var fn = $parse(attr['ngFocus']);
        element.on('focus', function(event) {
            scope.$apply(function() {
                fn(scope, {
                    $event:event
                });
            });
        });
    };
}])

.directive('ngBlur', ['$parse', function($parse) {
    return function(scope, element, attr) {
        var fn = $parse(attr['ngBlur']);
        element.on('blur', function(event) {
            scope.$apply(function() {
                fn(scope, {
                    $event:event
                });
            });
        });
    };
}])

//Credit for ngBlur and ngFocus to https://github.com/addyosmani/todomvc/blob/master/architecture-examples/angularjs/js/directives/
app.directive('ngBlur', function() {
    return function( scope, elem, attrs ) {
        elem.bind('blur', function() {
            scope.$apply(attrs.ngBlur);
        });
    };
});

app.directive('ngFocus', function( $timeout ) {
    return function( scope, elem, attrs ) {
        scope.$watch(attrs.ngFocus, function( newval ) {
            if ( newval ) {
                $timeout(function() {
                    elem[0].focus();
                }, 0, false);
            }
        });
    };
});

app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });

                event.preventDefault();
            }
        });
    };
});



app.directive('uploader', function ($compile) {
    var _action = '/campaign/upload';
    var _frNamePrfx = 'mediaLinkForm_';
    var _framePrfx = 'mediaLinkIFrame_';
    var _namePrfx = 'mediaLinkFile_';
    var _callback = 'Campaign.mediaLinkIframeUpload';
    var getTemplate = function(p) {
        
        var suffix = p.type + '_' + p.id; 
    
        return '<form method="POST" action="' + _action + '" name="' + _frNamePrfx + suffix +'" id= "' + _frNamePrfx + suffix +'" target = "'+ _framePrfx + suffix +'" enctype="multipart/form-data">' +
        '<span class="btn btn-default btn-file"> + Add Image <input type="file" name="' + _namePrfx + suffix +'" multiple="multiple" /></span>' +
        '<input type="hidden" name="id"  value="'+p.id+'" /><input type="hidden" name="campaignId"  value="'+p.projectId+'" /><input type="hidden" name="method" value ="campaign.uploadMediaLinkImage" />'+
        '<div class="ajax-loader"></div>'+
        '</form>' +
        '<iframe  onload="'+_callback+'(\''+suffix+'\')" name="' + _framePrfx +  suffix +'" id="' + _framePrfx +  suffix +'" style="height: 0; width: 0; border: 0;"></iframe>'+
        '<script>jQuery("#'+_frNamePrfx + suffix+'").on("change", function(){jQuery("#'+_frNamePrfx + suffix+'").submit();})</script>';
    
    }

    return {
        restrict: 'E',
        scope: {
            m: "="
        },
        link: function(scope, element, attrs) {
          
            var el = $compile(getTemplate(scope.m))(scope);
            element.replaceWith(el);
            var suffix = scope.m.type + '_' + scope.m.id;
        }
    };
})


.factory('list', function($http) {
    /* errors_list.json should contain a map of errors and user-feedback.
     * we use, $http to retrieve values from file errors_list.json,
     * errorsList factory returns a promise. */
    //return $http.get('errors_list.json');
    return {
        invalid : "The errror is invalid",
        required : "This is required"
    }
})

.directive('alert', function () {
    return {
        restrict:'EA',
        controller: function ($scope, $attrs) {
            $scope.closeable = 'close' in $attrs;
        },
        templateUrl:'/templates/alert.html',
        transclude:true,
        replace:true,
        scope: {
            type: '@',
            close: '&'
        }
    };
})

.directive('sterror', function (list) {
    return {
        restrict: 'E',
        replace: true,
        scope: {
            target: '='
        },
        template: '<div> \
                     <table ng-show="showErr" class="alert alert-error fade in" style="width:100%;"><tr><td> \
                       <i class="fa fa-warning"></i> {{showMessage}} \
                     </td></td></table> \
                     <table ng-show="showSucc" class="alert fade in alert-success" style="width:100%;"><tr><td> \
                       <i class="fa fa-check-circle"></i> {{showMessage}} \
                     </td></tr></table> \
                   </div>',
        link: function(scope) {

            scope.messageMap = {};

            var _showMsg = function(val, args, target, str) {
                if (scope.target === target) {
                    if (!str) {
                        str = 'Undefined';
                    }
                    scope.showMessage = scope.messageMap[str];
                    if (args.name.indexOf('error') !== -1) {
                        scope.showErr = val;
                    } else {
                        scope.showSucc = val;
                    }
                }
            };

            /* fetching data present in 'errors-list.json' file */
            //            list.success(function(data) {
            //                scope.messageMap = data;
            //            });
        
            scope.messageMap = list;

            scope.$on('show error', function (args, target, err) {
                _showMsg(true, args, target, err);
            });

            scope.$on('hide all', function(args, target) {
                scope.showErr = false;
                scope.showSucc = false;
            });

            scope.$on('hide error', function (args, target) {
                _showMsg(false, args, target);
            });

            scope.$on('show success', function (args, target, succ) {
                _showMsg(true, args, target, succ);
            });

            scope.$on('hide success', function (args, target) {
                _showMsg(false, args, target);
            });
        }
    };
});
