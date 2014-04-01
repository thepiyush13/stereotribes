angular.module('app')

    .controller('step2Ctrl', function($scope, $http){
        
        $scope.config = {}
        
        $scope.designFlipBox = {
            title: '',
            shortSummary: '',
            country: '',
            city: ''
        }
        
        $scope.goalSetting = {
            currency: 'adsfa',
            goal: 'asdf',
            fundingType: 'flexible',
            campaignLengthType: 'paymentDate',
            campaignLength: {
                'run': '10', 
                'endDate': '', 
                'paymentDate': ''
            },
            daysRun: '',
            endDate: '',
            paymentDate: '05/04/2014'
        };
        
        $http({
            method: 'POST',
            url: '/campaign/api',
            data: {
                method: 'campaign.getStep2'
            }
        }).success(function(response) {
            console.log(response.error);
            if(response.error == 0) {
                $scope.config = response.data.config;
                
                //design flip box
                $scope.designFlipBox = response.data.designFlipBox;
                
                //goal settings
                $scope.goalSetting = response.data.goalSetting;
                
                //reward
                $scope.reward = response.data.reward;
            } else {
                console.log('--');
            //$scope.error = response.error;
            } 
        });
        
        
        
        $scope.campaignId = 121;
        
        
        $scope.charCount = function(s) {
            if(s) return s.length;
            return 0;
        }
    })
    
    
    
    .controller('designFlipCtrl', function($scope){
        var designFlipBox = {
            title: '',
            shortSummary: '',
            country: '',
            city: ''
        }
        
        $scope.designFlipBox = designFlipBox;
        $scope.campaignId = 121;
        $scope.charCount = function(s) {
            if(s) return s.length;
            return 0;
        }
        
    })

    .controller('goalSettingsCtrl', function($scope){
        $scope.currencies = [{
            code: 'GBP', 
            symbol: 'GBP'
        },{
            code: 'Dollar', 
            symbol: '$'
        }];
        $scope.goalSetting = {
            currency: 'adsfa',
            goal: 'asdf',
            fundingType: 'flexible',
            campaignLengthType: 'paymentDate',
            campaignLength: {
                'run': '10', 
                'endDate': '', 
                'paymentDate': ''
            },
            daysRun: '',
            endDate: '',
            paymentDate: '05/04/2014'
        };
        
        
    })
    
    .controller('rewardCtrl', function($scope){
        $scope.rewardTypes = [
        {
            id: "educational", 
            name: "Educational"
        },

        {
            id: "under18", 
            name: "Under 18"
        },

        {
            id: "swag", 
            name: "Swag"
        }
        ]
        $scope.list = [
        {
            "fundAmount":'99', 
            "rewardName":"", 
            "numberAvailable": "", 
            "estimatedDeliveryDate": "", 
            "description": "", 
            "addressRequired": "", 
            "rewaredTypes": ['educational']
        }
        ];
    
        $scope.addReward = function() {
            $scope.list.push({
                fundAmount:'', 
                "rewardName":"", 
                numberAvailable: "", 
                estimatedDeliveryDate: "", 
                description: "", 
                addressRequired: "", 
                rewaredTypes: []
            });
        }
    
        $scope.getSelectedCategory = function(i, category) {
        
            var foundIndex = jQuery.inArray( category, this.list[i].rewaredTypes);
            if(foundIndex == -1) {
                this.list[i].rewaredTypes.push(category);
            } else {
                this.list[i].rewaredTypes.splice(foundIndex, 1);
            }
        }
    
        $scope.removeReward = function(index) {
            this.list.splice(index,1);
        }
    })

    .controller('CampaignCreateCtrl', function($scope, $http, $window){
        //$http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $scope.config = {
        }
        
        $scope.createCampaign = {
            category: '',
            currency: '',
            goal: '',
            projectFor: ''
        }
        
        $http({
            method: 'POST',
            url: '/campaign/api',
            data: {
                method: 'campaign.getStep1'
            }
        }).success(function(response) {
            console.log(response.error);
            if(response.error == 0) {
                $scope.config = response.data.config;
            } else {
                console.log('--');
            //$scope.error = response.error;
            } 
        });
        
        $scope.selectCategory = function(category) {
            if($scope.createCampaign.category == category) return;
            //remove class from all categories
            $('.play-categories').each(function(){
                $(this).removeClass('active');
            })
            $('.color-'+category).addClass('active');
            $scope.createCampaign.category = category;
            
        }
        
        $scope.save = function() {
            $http({
                method: 'POST',
                url: '/campaign/api',
                data: {
                    method: 'campaign.create',
                    data: $scope.createCampaign
                }
            }).success(function(response) {
                console.log(response.error);
                if(response.error == 0) {
                    window.location.href = '/campaign/'+response.data.campaignId+'/step2';
                    
                } else {
                    console.log('--');
                //$scope.error = response.error;
                } 
            });
        }
        
       
        
    })
