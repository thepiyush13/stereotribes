angular.module('app')

    /**
 * 
 * STEP 5 controller
 * 
 */
    
    .controller('step5Ctrl', function($scope, $http, $window, Utils){
        $scope.campaignId = $window.$campaignId;
        $scope.paymentType = '',
        $scope.rememberMe = false,
        $scope.promotionMethod = ''
        
        $http({
            method: 'POST',
            url: '/campaign/api',
            data: {
                method: 'campaign.getStep5',
                campaignId: $scope.campaignId,
                data: {
                    
                }
            }
        }).success(function(response) {
            if(response.error == 0) {
                var d = response.data.data;
                var c = response.data.config;
                $scope.paymentType = (d.paymentType) ? true : false,
                $scope.rememberMe = d.rememberMe ? true : false,
                $scope.promotionMethod = d.promotionMethod
                
            } else {
            } 
        });
        
        /**
     * save fund
     */       
    
        $scope.saveFund = function() {
            
            $http({
                method: 'POST',
                url: '/campaign/api',
                data: {
                    method: 'campaign.saveFund',
                    campaignId: $scope.campaignId,
                    data: {
                        paymentType : $scope.paymentType,
                        rememberMe : $scope.rememberMe,
                        promotionMethod : $scope.promotionMethod
                    }
                }
            }).success(function(response) {
                if(response.error == 0) {

                } else {
                        
                } 
            });
        }
    
    
        /**
     * go live
     * 
     * 
     */
        $scope.goLive = function() {
            
            $http({
                method: 'POST',
                url: '/campaign/api',
                data: {
                    method: 'campaign.goLive',
                    campaignId: $scope.campaignId,
                    data: {
                }
                }
            }).success(function(response) {
                if(response.error == 0) {

                } else {
                        
                } 
            });
        }  
       

    })
    
    
    
    
