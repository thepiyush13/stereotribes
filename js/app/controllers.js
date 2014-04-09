angular.module('app')

    .controller('step2Ctrl',  function($scope, $http, $window, Utils){
        
        
        $scope.campaignId = $window.$campaignId; //most important
        
        $scope.config = {}
        
        $scope.designFlipBox = {
            title: '',
            shortSummary: '',
            country: '',
            city: '',
            flipImageUrl: ''
        }
        
        $scope.goalSetting = {
            currency: 'adsfa',
            goal: 'asdf',
            fundingType: 'flexible',
            campaignLengthType: 'paymentDate',
            campaignLength: {
                'daysRun': '10', 
                'endDate': '', 
                'paymentDate': ''
            },
            
        };
        
        $scope.awesomeCampaign = {
            mediaType: 'image',
            videoUrl: '',
            imageUrl: '',
            newVideoUrl:'',
            hasFocus: false,
            pitchStory: '',
            showVideo: function() {
                alert(this.videoUrl);
            }
        }
        
        //reward
        $scope.reward={}
        $scope.reward.rewardDisclaimer='no';
        $scope.reward.list = [{
            "id": null, //not in database
            "serial":"",
            "fundAmount":'', 
            "name":"", 
            "rewardTypes": [],
            "available": "", 
            "estimatedDelivery": "", 
            "description": "", 
            "fundersShippingAddressRequired": "" 
            
        }];
        
        $http({
            method: 'POST',
            url: '/campaign/api',
            data: {
                method: 'campaign.getStep2',
                data: {
                    'campaignId': $scope.campaignId
                }
            }
        }).success(function(response) {
            console.log(response.error);
            if(response.error == 0) {
                $scope.config = response.data.config;
                var d = response.data.data;
                console.log(response.data.data)
                var f = {}
                
                //design flip box
                $scope.designFlipBox.title = d.title;
                $scope.designFlipBox.shortSummary = d.shortSummary;
                $scope.designFlipBox.country = d.country;
                $scope.designFlipBox.city = d.city;
                $scope.designFlipBox.flipImageUrl = d.flipImageUrl;
                
                //goal settings
                $scope.goalSetting = {
                    currency: d.currency,
                    goal: d.goal,
                    fundingType: (d.fundingType) ? d.fundingType : 'fixed',
                    campaignLengthType: (d.fundingType =='fixed' || d.fundingType =='') ? '' : ((d.daysRun) ? 'run' : (d.endDate) ? 'endDate' : 'paymentDate'),
                    campaignLength: {
                        'daysRun': d.daysRun, 
                        'endDate': d.endDate, 
                        'paymentDate': d.paymentDate
                    }
                };
                
                //awesome campaign
                $scope.awesomeCampaign = {
                    mediaType: (d.mediaType) ? d.mediaType : 'video',
                    videoUrl: d.videoUrl,
                    imageUrl: d.imageUrl,
                    newVideoUrl: d.videoUrl, //??
                    hasFocus: false,
                    pitchStory: d.pitchStory 
                }
                jQuery('.jqte_editor', $('#awesomePitchStory').parent().parent()).html(d.pitchStory);//copy to editor
                
                //reward
                $scope.reward.rewardDisclaimer=(d.rewardsDisclaimer) ? true : false;
                if(d.rewards) {
                    $scope.reward.list = d.rewards;
                    for(var i=0; i < d.rewards.length; i++) {
                        $scope.reward.list[i].fundersShippingAddressRequired = (d.rewards[i].fundersShippingAddressRequired == 1) ? true : false;
                    }
                    
                    
                } 
                
                
            //reward
            //$scope.reward = response.data.reward;
            } else {
                console.log('--');
            //$scope.error = response.error;
            } 
        });
        
        $scope.$watch('goalSetting.fundingType', function(){
            if($scope.goalSetting.fundingType == 'flexible' && $scope.goalSetting.campaignLengthType == '' ) {
                $scope.goalSetting.campaignLengthType = 'run';
            }
        })
        
        $scope.$watch('awesomeCampaign.pitchStory', function(){
            console.log('wat'+$scope.awesomeCampaign.pitchStory);
        //            if($scope.awesomeCampaign.pitchStory == 'test' ) {
        //            //$scope.goalSetting.campaignLengthType = 'run';
        //            }
        })
        
        $scope.$watch('goalSetting.fundingType', function(){
            if($scope.goalSetting.fundingType == 'flexible' && $scope.goalSetting.campaignLengthType == '' ) {
                $scope.goalSetting.campaignLengthType = 'run';
            }
        })
        
        $scope.charCount = function(s) {
            if(s) return s.length;
            return 0;
        }
        
    
        $scope.getYoutubeVideoId = function(url){
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match&&match[7].length==11){
                $scope.awesomeCampaign.newVideoUrl = '//www.youtube.com/embed/'+match[7]
            }else{
                $scope.awesomeCampaign.newVideoUrl = ''
            }
        }
        
        
        //reward
        
    
        $scope.addReward = function() {
            console.log('add')
            $scope.reward.list.push({
                "id": null, //not in database
                "serial":"",
                "fundAmount":'', 
                "name":"", 
                "rewardTypes": [],
                "available": "", 
                "estimatedDelivery": "", 
                "description": "", 
                "fundersShippingAddressRequired": "",
                "projectId": $scope.campaignId 
            });
        }
    
        $scope.getSelectedRewardCategory = function(i, category) {
            var foundIndex = jQuery.inArray( category, $scope.reward.list[i].rewardTypes);
            if(foundIndex == -1) {
                $scope.reward.list[i].rewardTypes.push(category);
            } else {
                $scope.reward.list[i].rewardTypes.splice(foundIndex, 1);
            }
        }
        
        $scope.chkReward = function(i, type) {
            // console.log(i, type);
            var foundIndex = jQuery.inArray( type, $scope.reward.list[i].rewardTypes);
            if(foundIndex == -1) {
                return false;
            } else {
                return true;
            }
        }
        
        
        
        //save reward: index
    
        $scope.saveReward = function(index) {
            var extra = {
                index: index
            }
            $scope.reward.list[index];
            $scope.save('campaign.saveReward', '', $scope.reward.list[index], extra);
        }
        
        $scope.removeReward = function(index) {
            if($scope.reward.list[index].id) {
                //delete from database as well
                $scope.save('campaign.deleteReward', '', {
                    id: $scope.reward.list[index].id
                });
            }
            $scope.reward.list.splice(index,1);
        }
        
        //save design flipbox
        $scope.saveDesignFlipBox = function() {
            $scope.save('campaign.saveFlipbox', 'designFlipBox');
        }
        
        //save goalsetting
        $scope.saveGoalSetting = function() {
            if($scope.fundingType == 'fixed') {
                $scope.campaignLengthType = $scope.campaignLength.run = $scope.campaignLength.endDate = $scope.campaignLength.paymentDate = ''
            } else {
                if($scope.campaignLengthType == 'run') {
                    $scope.campaignLength.endDate = $scope.campaignLength.paymentDate = '';
                }
                if($scope.campaignLengthType == 'endDate') {
                    $scope.campaignLength.daysRun = $scope.campaignLength.paymentDate = '';
                }
                if($scope.campaignLengthType == 'paymentDate') {
                    $scope.campaignLength.daysRun = $scope.campaignLength.endDate = '';
                }
            }
            
            $scope.save('campaign.saveGoalSetting', 'goalSetting');
        }
        
        //save awesome campaign
        $scope.saveAwesomeCampaign = function() {
            //copy videoUrl
            if($scope.awesomeCampaign.videoUrl) {
                $scope.awesomeCampaign.videoUrl = $scope.awesomeCampaign.newVideoUrl
            }
            
            //get pitchStory
            $scope.awesomeCampaign.pitchStory = jQuery('.jqte_editor', $('#awesomePitchStory').parent().parent()).html()
            $scope.save('campaign.saveAwesomeCampaign', 'awesomeCampaign');
        }
        
        
        $scope.save = function(method, section, data, extra) {
            var data = {
                campaignId: $scope.campaignId,
                method: method,
                data: ($scope[section]) ? $scope[section] : data
            }
            
            $http({
                method: 'POST',
                url: '/campaign/api',
                data: data
            }).success(function(response) {
                console.log(response.error);
                if(response.error == 0) {
                    if(response.data.section == 'reward') {
                        var idx = extra.index;
                        $scope.reward.list[idx].id=response.data.id;
                    }
                    
                } else {
                    console.log('handle error response');
                } 
            });
            
            
        }
    })
    
    
    
    
    /**
 * 
 * STEP 3 controller
 * 
 */
    
    .controller('step3Ctrl', function($scope, $http, $window, Utils){
        $scope.campaignId = $window.$campaignId; //most important
        
        
        //reward
        $scope.links={}
        
        $scope.links.list = [{
            "id": null, //not in database
            "title":"Add title...",
            "url":'', 
            "type":"", 
            "projectId": $scope.campaignId
        }];
    
        $scope.mediaLinks={}
        $scope.mediaLinks.video=[];
        $scope.mediaLinks.audio=[];
        $scope.mediaLinks.image=[];
        $scope.mediaLinks.pdf=[];
        
        
        $scope.fundThankyou = {
            mediaType: 'image',
            thankyouVideoUrl: '',
            thankyouImageUrl: '',
            newThankyouVideoUrl:'',
            hasFocus: false,
            showVideo: function() {
                alert(this.videoUrl);
            }
        }
        
        //$scope.masterMediaLinks = $scope.mediaLinks; //copy
        //        $scope.mediaLinks =
        
        $http({
            method: 'POST',
            url: '/campaign/api',
            data: {
                method: 'campaign.getStep3',
                data: {
                    'campaignId': $scope.campaignId
                }
            }
        }).success(function(response) {
            console.log(response);
            if(response.error == 0) {
                var d = response.data.data;
                
                //Links
                if(d.links) {
                    $scope.links.list = d.links;
                }
                
                
                //Media Links
                if(d.mediaLinks.video.length) {
                    $scope.mediaLinks.video = d.mediaLinks.video;
                } else { //add an empty video
                    $scope.mediaLinks.video.push({
                        id:null, 
                        title:"", 
                        description:"", 
                        type : "video", 
                        codeUrl: "", 
                        projectId: $scope.campaignId, 
                        editing: false
                    })
                }
                
                
                if(d.mediaLinks.image.length) {
                    $scope.mediaLinks.image = d.mediaLinks.image;
                } else { //add an empty image
                    $scope.mediaLinks.image.push({
                        id: Utils.getUniqueId(),  //random unique id
                        title:"", 
                        description:"", 
                        type : "image", 
                        codeUrl: "", 
                        projectId: $scope.campaignId, 
                        editing: false
                    })
                }
                
                if(d.mediaLinks.audio.length) {
                    
                    $scope.mediaLinks.audio = d.mediaLinks.audio;
                }else {
                    $scope.mediaLinks.audio.push({
                        id: null, 
                        title:"", 
                        description:"", 
                        type : "audio", 
                        codeUrl: "", 
                        projectId: $scope.campaignId, 
                        editing: false
                    })
                }
                
                
                if(d.mediaLinks.pdf.length) {
                    $scope.mediaLinks.pdf = d.mediaLinks.pdf;
                }else {
                    $scope.mediaLinks.pdf.push({
                        id: Utils.getUniqueId(), 
                        title:"", 
                        description:"", 
                        type : "pdf", 
                        codeUrl: "", 
                        projectId: $scope.campaignId, 
                        editing: false
                    })
                }
                
                $scope.fundThankyou = {
                    thankyouMediaType: (d.thankyouMediaType) ? d.thankyouMediaType : 'video',
                    thankyouVideoUrl: d.thankyouVideoUrl,
                    thankyouImageUrl: d.thankyouImageUrl,
                    newThankyouVideoUrl: d.thankyouVideoUrl, //??
                    hasFocus: false
                }
                
                //get a master copy
                $scope.masterMediaLinks = $scope.mediaLinks;
                
                
                console.log($scope.mediaLinks);
            } else {
                console.log('--');
            //$scope.error = response.error;
            } 
        });
        
        //add link
        $scope.addLink = function() {
            $scope.links.list.push({
                "id": null, //not in database
                "title":"Add title...",
                "url":'', 
                "type":"custom",
                "editing": false,
                "projectId": $scope.campaignId
            });
        }
        
        $scope.editLink = function(link){
            if(link.type != 'custom') return;
            link.editing=true;
            $scope.editedLinkItem = link;
        }
        
        $scope.removeLink = function(index) {
            
            if($scope.links.list[index].id != null) {
                $http({
                    method: 'POST',
                    url: '/campaign/api',
                    data: {
                        method: 'campaign.removeLink',
                        campaignId: $scope.campaignId,
                        id: $scope.links.list[index].id
                    }
                }).success(function(response){
                    if(response.error == 0) {
                        $scope.links.list.splice(index, 1);
                    }
                }) 
            }
        }
        
        $scope.doneLinkEditing = function(link){
            link.editing=false;
            $scope.editedLinkItem = null;
        }
        
        //save links
        $scope.saveLinks = function() {
            $http({
                method: 'POST',
                url: '/campaign/api',
                data: {
                    method: 'campaign.saveLinks',
                    campaignId: $scope.campaignId,
                    data: {
                        links: $scope.links
                    }
                }
            }).success(function(response) {
                if(response.error == 0) {
                    var d = response.data.data;
                    $scope.links.list = d.links;
                
                } else {
                    console.log('--');
                //$scope.error = response.error;
                } 
        
            });
        }
        
        $scope.media = {};
        $scope.media.selectedType = 'video';
        $scope.selectedMedia = function(type) {
            $scope.media.selectedType = type;
            console.log($scope.media.selectedType);
        }
        
        
        $scope.addMediaLink = function(type) {
            var _id = Utils.getUniqueId();
            $scope.mediaLinks[type].push({
                id:_id, 
                title:"", 
                description:"", 
                type : type, 
                codeUrl: "", 
                projectId: $scope.campaignId, 
                editing: true
            });
        }
        
        $scope.removeMediaLink = function(type, index) {
            var _item = $scope.mediaLinks[type][index];
            if($scope.mediaLinks[type][index].id < 1000000000000 && $scope.mediaLinks[type][index].id != null) {
                $http({
                    method: 'POST',
                    url: '/campaign/api',
                    data: {
                        method: 'campaign.removeMediaLink',
                        campaignId: $scope.campaignId,
                        id: _item.id
                    }
                }).success(function(response){
                    if(response.error == 0) {
                        $scope.mediaLinks[type].splice(index,1);
                    }
                })
            } else {
                $scope.mediaLinks[type].splice(index,1); //just delete from client object 
            }
        }
        
        //medialink video editing
        $scope.editMedia = function(type, index) {
            $scope.mediaLinks[type][index].editing = true;
        }
        
        //editing is over
        $scope.doneEditMedia = function(type, index) {
            $scope.mediaLinks[type][index].editing = false;
        }
        
        //save Media Links
        $scope.saveMediaLinks = function() {
            $http({
                method: 'POST',
                url: '/campaign/api',
                data: {
                    method: 'campaign.saveMediaLinks',
                    campaignId: $scope.campaignId,
                    data: {
                        mediaLinks: $scope.mediaLinks
                    }
                }
            }).success(function(response) {
                if(response.error == 0) {
                    var d = response.data.data;
                
                } else {
                    console.log('--');
                //$scope.error = response.error;
                } 
        
            });
        }
        
        
        //fund thankyou
        $scope.getThankyouYoutubeVideoId = function(url){
            if(!url) return;
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match&&match[7].length==11){
                $scope.fundThankyou.newThankyouVideoUrl = '//www.youtube.com/embed/'+match[7]
            }else{
                $scope.fundThankyou.newThankyouVideoUrl = ''
            }
        }
        
        //save thankyou video 
        $scope.saveThankyouVideo = function() {
            //copy videoUrl
            if($scope.fundThankyou.thankyouVideoUrl) {
                $scope.fundThankyou.thankyouVideoUrl = $scope.fundThankyou.newThankyouVideoUrl
            }
            $http({
                method: 'POST',
                url: '/campaign/api',
                data: {
                    method: 'campaign.saveThankyouVideo',
                    campaignId: $scope.campaignId,
                    data: {
                        fundThankyou: $scope.fundThankyou
                    }
                }
            }).success(function(response) {
                if(response.error == 0) {
                    var d = response.data.data;
                } else {
                    console.log('--');
                } 
        
            });
        }
        
        
    })

    
    
    
    /**
     * 
     * STEP 4 controller
     * 
     */
    
    .controller('step4Ctrl', function($scope, $http){
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
            //STEP2 Links
                
            } else {
                console.log('--');
            //$scope.error = response.error;
            } 
        });
        
    })
    
    
    
    /**
     * 
     * STEP 5 controller
     * 
     */
    
    .controller('step5Ctrl', function($scope, $http){
        
        
        })
    
    

    .controller('Step1Ctrl', function($scope, $http, $window){
        //$http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $scope.campaignId = $window.$campaignId;
        $scope.config = {
        }
        
        $scope.createCampaign = {
            category: '',
            currency: 'GBP',
            goal: '',
            projectFor: 'team'
        }
        
        $http({
            method: 'POST',
            url: '/campaign/api',
            
            data: {
                campaignId: $scope.campaignId,
                method: 'campaign.getStep1'
            }
        }).success(function(response) {
            console.log(response.error);
            if(response.error == 0) {
                $scope.config = response.data.config;
                $scope.createCampaign.category = response.data.data.category;
                $scope.createCampaign.currency = response.data.data.currency;
                $scope.createCampaign.goal = response.data.data.goal;
                $scope.createCampaign.projectFor = response.data.data.projectFor;
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
                    campaignId: $scope.campaignId,
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
