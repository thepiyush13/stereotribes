angular.module('app')

    /**
     * 
     * STEP 4 controller
     * 
     */
    
    
    .controller('step4Ctrl', function($scope, $http, $window, Utils){
        $scope.campaignId = $window.$campaignId;
        $scope.canEdit = false
        $scope.emails = [];
        $scope.tribes = [{
            id: '', 
            email: 'kanchan@inkoniq.com', 
            name: 'kanchan', 
            canEdit: false, 
            profilePic: '', 
            projectId: ''
        }];
    
        $scope.shareUrl = '';
        
        $http({
            method: 'POST',
            url: '/campaign/api',
            data: {
                method: 'campaign.getStep4',
                data: {
                    'campaignId': $scope.campaignId
                }
            }
        }).success(function(response) {
            if(response.error == 0) {
                var d = response.data.data;
                var c = response.data.config;
                console.log(d)
                $scope.shareUrl = d.shareUrl ? d.shareUrl : '';
                $scope.liveStatus = 'draft';
                $scope.tribes = d.tribes;
                $scope.emails = '';
                $scope.socialAmplifers = d.socialAmplifers;
                for(var i=0; i< $scope.socialAmplifers.length; i++) {
                    $scope.socialAmplifers[i].postStatus = ($scope.socialAmplifers[i].postStatus==1) ? true: false;
                }
                
                $scope.socialAmplifierStatus = (d.socialAmplifierStatus) ? 'd.socialAmplifierStatus' : 'off';

            } else {
                console.log('--');
            //$scope.error = response.error;
            } 
        });
        
        //valid emails
        $scope.validateEmails = function(p) {
            var method = (p == 'invite') ? 'campaign.inviteTribes' : 'campaign.processMails';
            console.log('validate   ')
            $delimeter = ',';
            $chkServer = true;
            if($scope.emails.length || $chkServer) {
                var emails = $scope.emails.split($delimeter);
                for(i=0; i < emails.length; i++) {
                    // if any email is valid send to server
                    if(Utils.isEmail(emails[i])) {
                        $chkServer = true;
                        break;
                    }
                }
                if($chkServer) {
                    $http({
                        method: 'POST',
                        url: '/campaign/api',
                        data: {
                            method: method,
                            campaignId: $scope.campaignId,
                            data: {
                                'emails': $scope.emails,
                                'tribes': $scope.tribes,
                                'canEdit': $scope.canEdit
                            }
                        }
                    }).success(function(response) {
                        if(response.error == 0) {
                            //STEP2 Links
                            $scope.tribes = response.data.tribes;
                            $scope.emails = '';

                        } else {
                        
                        } 
                    });
                }
            }
            
            
            
        }
        
        /**
         * save amplifers
         */
        
        //valid emails
        $scope.saveAmplifers = function() {
            
            $http({
                method: 'POST',
                url: '/campaign/api',
                data: {
                    method: 'campaign.saveAmplifers',
                    campaignId: $scope.campaignId,
                    data: {
                        'socialAmplifers': $scope.socialAmplifers,
                    }
                }
            }).success(function(response) {
                if(response.error == 0) {
                    //STEP2 Links
                    //do we need this ?
                    var d = response.data.data;
                    var c = response.data.config;
                    $scope.socialAmplifers = d.socialAmplifers;
                    for(var i=0; i< $scope.socialAmplifers.length; i++) {
                        $scope.socialAmplifers[i].postStatus = ($scope.socialAmplifers[i].postStatus==1) ? true: false;
                    }
                
                    $scope.socialAmplifierStatus = (d.socialAmplifierStatus) ? 'd.socialAmplifierStatus' : 'off';

                } else {
                        
                } 
            });
        }
            
            
            
        

    })
    
    
    
    
