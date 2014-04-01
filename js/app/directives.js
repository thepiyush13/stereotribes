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
});
