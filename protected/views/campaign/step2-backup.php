<div class="container playcontainer" ng-app="app">

    <div class="row" ng-controller="step2Ctrl"> <!-- Do not modify this div -->

        <!-- steps come here -->
        <?php $this->widget('application.components.CampaignSteps');?>

        <section class="block-wrapper  col-md-12">

            <div class="top-title-wrap">

                <div class="col-md-6 text-left">
                    <h3 class="fund-main-title no-margin">Let's build your awesome campaign</h3>
                </div>

            </div>

            <p>We can't wait to see what you're project idea is! We begin with designing your promotional flip box. Its the first time to capture the interest of potential funders. When they click through they end up on your story page. let's begin...</p>

        </section>

        <section class="block-wrapper  col-md-12" >

            <!-- Design your flip box  form starts here -->



            <h3 class="article-head-collapse">Design your flip box <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container" ng-controller="designFlipCtrl">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-8">

                            <form name="flipForm" class="form-flipbox" action="action" novalidate > 

                                <div class="title-wrapper">

                                    <h4 class="article-inner-title">Title of your campaign</h4>

                                    <p>Give your campaign a name that will inspire us to learn more about you</p>

                                    <div class="form-group global-textbox">
                                        <input type="text" name="title" ng-model="designFlipBox.title" maxlength="50" class="form-control charcount" id="title-input" placeholder="Title of your campaign" required>
                                        <div class="inputchar-countwrap"><span ng-show="!flipForm.title.$pristine && flipForm.title.$error.required">Username is required.</span><span class="inputcount">{{ charCount(designFlipBox.title) }}</span>/50</div>
                                    </div>

                                </div>

                                <div class="summary-wrapper">

                                    <h4 class="article-inner-title">Short summary campaign</h4>

                                    <p>Give your campaign a name that will inspire us to learn more about you</p>

                                    <div class="form-group global-textarea">
                                        <textarea type="text" name="shortSummary" ng-model="designFlipBox.shortSummary" maxlength="180" class="form-control charcount" id="title-input" required></textarea>
                                        <div class="inputchar-countwrap"><span ng-show="!flipForm.shortSummary.$pristine && flipForm.shortSummary.$error.required">Username is required.</span><span class="inputcount">{{ charCount(designFlipBox.shortSummary) }}</span>/180</div>
                                    </div>

                                </div>

                                <div class="location-wrapper">

                                    <div id="prefetch" class="form-group global-textbox">
                                        <h4 class="article-inner-title">Country</h4>
                                        <input type="text" ng-model="designFlipBox.country" class="form-control stribescountry typeheadfix" placeholder="Countries" id="countries" />
                                    </div>

                                    <div id="prefetch" class="form-group global-textbox">
                                        <h4 class="article-inner-title">City</h4>
                                        <input type="text" ng-model="designFlipBox.city" class="form-control stribescity" placeholder="City" id="cities" />
                                    </div>

                                </div>
                            </form>

                            <div class="upload-wrapper">

                                <h4 class="article-inner-title">Flip box image</h4>
                                <!-- flip image upload -->
                                <form method="POST" action="/campaign/upload" name="flipImageUploadForm" target="flipImageUploadIframe" enctype="multipart/form-data">
                                    <input type="file" name="flipImage" multiple="multiple" />
                                    <input type="hidden" name="canpaignId" ng-model="campaignId" />
                                    <input type="hidden" name="method" value ="campaign.uploadFlipImage" />
                                    <input type="submit">
                                    <div class="ajax-loader"></div>
                                </form>
                                <iframe  class="flipImageUploadIframe" name="flipImageUploadIframe" id="flipImageUploadIframe" scrolling="yes" style="display: none;"></iframe>
                                <!-- flip image upload ends -->
                                <span class="btn btn-default btn-file">
                                    + Add Image <input type="file">
                                </span>

                                <span class="file-info">PNG, JPG or GIF 960x640 pixels</span>

                            </div>

                            <div class="col-md-2 savewrapper">
                                <button type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Save</button>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="upload-wrapper">

                                <h4 class="article-inner-title">Flip box preview</h4>

                                <div class="brick brickhover medium mediumpreview">

                                    <div class="brickinner">

                                        <img id="flipImage" src="/img/b.jpg" alt="" class="img-responsive" />

                                        <div class="fund-block-normal fund-block-normal-fix">

                                            <div class="fund-normal-count-block">

                                                <div class="normal-count">
                                                    <span class="fund-count">50%</span>
                                                    Funded
                                                </div>

                                                <div class="fund-notation notationfix"></div>							
                                            </div>

                                            <div class="fund-normal-title-block fund-normal-fix">

                                                <a href="#" id="fundlive-title" class="fund-normal-title normaltitle">{{designFlipBox.title}}</a>

                                                <div class="fund-normal-location-block">

                                                    <i class="icon-location"></i>
                                                    <span class="fund-normal-location">{{designFlipBox.city}} {{designFlipBox.country}}</span>

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="mask">

                                        <a href="#">
                                            <span class="link-spanner"></span>
                                        </a>

                                        <div class="maskheaderwrap">
                                            <h4 class="maskheader">Production</h4>
                                            <span class="bordercut"></span>
                                            <a href="#" class="icon-heart" data-toggle="modal" data-target="#myModal"></a>
                                        </div>

                                        <div class="fund-normal-title-block">

                                            <a href="#" class="fund-normal-title normaltitle">{{designFlipBox.title}}</a>

                                            <div class="fund-normal-location-block">

                                                <i class="icon-location"></i>
                                                <span class="fund-normal-location">{{designFlipBox.country}}</span><br>
                                                <span class="fund-normal-author">{{designFlipBox.city}}</span>

                                            </div>

                                        </div>			

                                        <p>{{designFlipBox.shortSummary}}</p>  

                                        <div class="fund-normal-count-block">

                                            <div class="normal-count">
                                                <span class="fund-count">49%</span>
                                                Funded
                                            </div>

                                            <div class="fund-notation notationfix"></div>							
                                        </div>

                                        <ul class="campain-info-wrap">
                                            <li>
                                                <div>30</div>
                                                <div>Days left</div>
                                            </li>

                                            <li>
                                                <div>110</div>
                                                <div>Backers</div>
                                            </li>

                                            <li>
                                                <div>&pound;4251</div>
                                                <div>Pledge</div>
                                            </li>
                                            <li>
                                                <a href="#">Fund<br> Now</a>
                                            </li>
                                        </ul>

                                    </div>

                                </div>

                            </div>	                        

                        </div>

                    </div>	                       

                </div>
                {{ designFlipBox }}

            </div>

            </form><!-- Design your flip box  form Ends here -->

        </section>

        <section class="block-wrapper col-md-12" ng-controller="goalSettingsCtrl"> <!-- THE MONEY STUFF -->

            <!-- Form for The money stuff form Starts here -->

            <form name="goalSetting" class="form-moneystuff"  novalidate> 

                <h3 class="article-head-collapse">The money stuff <span class="collapse-sign col-close"></span></h3>

                <div class="row collapse-container" >

                    <div class="col-md-12">

                        <div class="row">

                            <div class="col-md-8"><!-- Left side wrapper starts -->

                                <div class="target-wrapper">

                                    <h4 class="article-inner-title">What's your target</h4>

                                    <p>One of the most important decision about your campaign is what to set your target at. The min is $500. The most successfull campaigns are between $5000 - $10000.</p>
                                    <pre>
                                    </pre>
                                    <select class="price-dropdown" ng-model="currency">
                                        <option ng-repeat="c in currencies" value="0">{{c.symbol}} {{c.code}}</option>
                                    </select> 

                                    <div class="form-group price-text">
                                        <input name="goal" ng-model="goalSetting.goal" ng-pattern="/^[1-9]([0-9]){3}$/" type="text" class="form-control" placeholder="Price" required>
                                        <span class="error" ng-show="goalSetting.goal.$error.pattern">Min 500</span>
                                    </div>

                                </div><!-- /.target-wrapper -->

                                <div class="funding-method-wrapper">

                                    <h4 class="article-inner-title">Choose your funding method</h4>
                                    <!-- added by kanchan start -->
                                    <style>
                                        .st-btn-radio {
                                            height: 60px; overflow: hidden;
                                        }
                                        .st-radio-hdn {
                                            position: absolute;
                                            top: -40px;
                                        }
                                    </style>
                                    <div class="row">
                                        <div class="col-md-3 fixedflexwrapper st-btn-radio st-btn-radio">
                                            <label class="blue btn btn-primary btn-lg btn-block fixedflexbutton">
                                                <input ng-model="goalSetting.fundingType" class="st-radio-hdn" type="radio" name="fundingType" value="fixed"><span>Fixed</span>
                                            </label>
                                        </div>
                                        <div class="col-md-1 fixedflexwrapper"><label class="orseparator">OR</label></div>
                                        <div class="col-md-4 fixedflexwrapper st-btn-radio">
                                            <label class="blue btn btn-primary btn-lg btn-block fixedflexbutton">
                                                <input ng-model="goalSetting.fundingType" class="st-radio-hdn" type="radio" name="fundingType" value="flexible"><span>Flexible</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- added by kanchan end -->


                                    <div class="col-md-5 fixedflexwrapper">


                                        <!--                                        <button type="button" class="btn btn-primary btn-lg btn-block fixedflexbutton">Fixed</button>-->

                                        <!--                                        <label class="orseparator">OR</label>-->

                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>

                                        <ul class="fixedflexinfolist">
                                            <li>Paymeny by: Paypal</li>
                                            <li>Maximum campaign length: 60 days</li>
                                            <li>Our fee is 7% if you reach your target. If you don't reach your target, you won't receive any money.</li>
                                        </ul>

                                    </div>

                                    <div class="col-md-5 fixedflexwrapper">

                                        <!--                                        <button type="button" class="btn btn-primary btn-lg btn-block fixedflexactivebutton">Flexible</button>-->

                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>

                                        <ul class="fixedflexinfolist">
                                            <li>Paymeny by: Paypal</li>
                                            <li>Maximum campaign length: 60 days</li>
                                            <li>Our fee is 7% if you reach your target. If you don't reach your target, you won't receive any money.</li>
                                        </ul>

                                    </div>

                                </div><!-- /.funding-method-wrapper -->

                                <div class="camplength-wrapper" ng-show="goalSetting.fundingType =='flexible'">

                                    <h4 class="article-inner-title">Choose your campaign length</h4>

                                    <div class="row" >

                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input ng-model="goalSetting.campaignLengthType" type="radio" name="campaignLengthType" id="radio_campaign_days" value="runs"> Days campaign runs
                                                </label>
                                            </div>
                                            <div class="form-group global-textbox">
                                                <input ng-model="goalSetting.campaignLength.run" name="campaignLengthRun" type="text" class="form-control" id="campaign_days" placeholder="Days">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input ng-model="goalSetting.campaignLengthType" type="radio" name="campaignLengthType" id="radio_campaign_end_date" value="endDate"> Campaign end date
                                                </label>
                                            </div>
                                            <div class="form-group global-textbox">
                                                <input ng-model="goalSetting.campaignLength.endDate" name="CampaignLengthEndDate"  class="form-control" placeholder="Date" datepicker/>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input ng-model="goalSetting.campaignLengthType" type="radio" name="campaignLengthType" id="radio_campaign_payment_date" value="paymentDate"> Date payment
                                                </label>
                                            </div>
                                            <div class="form-group global-textbox">
<!--                                                <input ng-model="goalSetting.campaignLength.paymentDate" name="CampaignLengtPaymentDate" id="date-picker" value="200" class="date-pick form-control" placeholder="Date" />-->
                                                <input  type="text" ng-model="goalSetting.campaignLength.paymentDate" class="form-control" datepicker/>
                                            </div>
                                        </div>

                                    </div>

                                </div><!-- /.camplength-wrapper-->

                            </div><!-- Left Side wrapper ends -->

                            <div class="col-md-4"><!-- Right side wrapper starts-->


                            </div><!-- Right side wrapper ends -->

                        </div>

                    </div>

                </div>

            </form><!-- For for The money stuff form Ends here -->

        </section>

        <section class="block-wrapper  col-md-12"> 

            <form class="form-buildcampaign" action="action"> 

                <h3 class="article-head-collapse">Let's build your awesome campaign <span class="collapse-sign col-close"></span></h3>

                <div class="row collapse-container">

                    <div class="col-md-12 pitchvideo-container"><!-- Whole Pitch Video Wrapper Starts -->

                        <div class="row">

                            <div class="col-md-8"><!-- Left side pitchvideo wrapper starts -->

                                <div class="pitchvideoupload-wrapper">

                                    <h4 class="article-inner-title">Upload your pitch video</h4>

                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>
                                        <a href="#"><b><span class="red-highlight">TIP:</span> Top ten tips to make a pitch video</b></a></p>

                                    <select class="price-dropdown">
                                        <option value="0">Select</option>
                                        <option value="1">$600</option>
                                        <option value="2">$600</option>
                                        <option value="3">$600</option>
                                        <option value="4">$600</option>
                                        <option value="5">$600</option>
                                    </select> 

                                    <div class="form-group price-text">
                                        <input type="text" class="form-control" id="price" placeholder="Price">
                                    </div>

                                </div><!-- /.target-wrapper -->

                                <div class="pitchvideo-wrapper row">

                                    <div class="col-md-6">

                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="radio_campaign_payment_date" value=""> Add a video link (Youtube or Vimeo)
                                            </label>
                                        </div>
                                        <div class="form-group global-textbox">
                                            <input type="text" class="form-control" id="video-url" placeholder="Video URL">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="radio_campaign_payment_date" value=""> Add image
                                            </label>
                                        </div>
                                        <div class="form-group global-textbox">
                                            <span class="btn btn-default btn-file">
                                                + Add Image <input type="file">
                                            </span>

                                            <span class="file-info">PNG, JPG or GIF 960x640 pixels</span>
                                        </div>

                                    </div>

                                </div>

                            </div><!-- Left side pitchvideo wrapper ends -->

                            <div class="col-md-4"><!-- Right side pitchvideo wrapper enstartsds -->

                                <iframe class="pitchvideo" src="//www.youtube.com/embed/8SbUC-UaAxE?rel=0" frameborder="0" allowfullscreen=""></iframe>

                            </div><!-- Right side pitchvideo wrapper ends -->

                        </div>	  

                    </div>


                    <!-- Whole text editor wrapper starts here -->

                    <div class="col-md-12 pitchstory-container"><!-- Whole Pitch Story Wrapper Starts -->

                        <div class="row">

                            <div class="col-md-8"><!-- Left side Pitch Story wrapper starts -->

                                <textarea name="textarea" class="pitchstorytextarea"></textarea>

                                <div class="col-md-2 savewrapper savemagin">
                                    <button type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Save</button>
                                </div>	

                                <div class="col-md-2 savewrapper">
                                    <button type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Preview</button>
                                </div>

                            </div><!-- Left side Pitch Story wrapper ends -->

                            <div class="col-md-4"><!-- Right side Pitch Story wrapper enstartsds -->

                                <div class="pitchtips">
                                    <a href="#"><b><span class="red-highlight">TIP:</span> Visit 'Soundcheck' for campaign building support</b></a>
                                </div>

                            </div><!-- Right side Pitch Story wrapper ends -->

                        </div>	  

                    </div>

                </div>

            </form>

        </section>

        <section class="block-wrapper  col-md-12">

            <form class="form-rewardscampaign" action="action"> 

                <h3 class="article-head-collapse">The rewards your funders will love! <span class="collapse-sign col-close"></span></h3>

                <div class="row collapse-container">

                    <div class="col-md-12 rewardisclaimer-container"><!-- Whole Pitch Reward Disclaimer Wrapper Starts -->
                        <div class="row">

                            <div class="col-md-8">

                                <div class="radiowrapper">

                                    <label class="radiolabel-inline">
                                        Reward Disclaimer Option
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios" id="radio_reward_yes" value="Yes" checked=""> Yes
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="optionsRadios" id="radio_reward_no" value="No" checked=""> No
                                    </label>

                                </div>

                                <div class="pitchreward-info">
                                    <b>Lorem Ipsum is simply dummy text</b> of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="rewardisclaimer-wrapper">

                                    <h5>Reward disclaimer</h5>

                                    <div class="rewardisclaimer-message">

                                        <span class="red-highlight">Note to funders: </span>
                                        We will do everything possible to deliver on your reward, however, legally, 'reward crowdfunding' implies we cannot guarantee reward delivery as stated.

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div><!-- Whole Pitch Reward Disclaimer Wrapper Ends -->

                    <div class="col-md-12 rewarbuilderinfo-container"><!-- Whole Pitch Reward Builder Info Wrapper Starts -->

                        <div class="row">

                            <div class="col-md-8">

                                <h4 class="article-inner-title">Your reward builder</h4>

                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>

                            </div>

                        </div>

                    </div><!-- Whole Pitch Reward Builder Info Wrapper Ends -->
                    <ul ng-controller="rewardCtrl">
                        {{list}}
                        <li ng-repeat="(index, reward) in list">

                            <div class="col-md-12 rewarbuilder-container"><!-- Whole Pitch Reward Builder Wrapper Starts -->		                 

                                <div class="col-md-8 rewardbuilder-wrapper">

                                    <h3 class="rewardbuilder-countheader">Reward One</h3>

                                    <div class="row">

                                        <div class="col-md-8 form-horizontal">

                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label">Fund Amount GBP</label>
                                                <div class="col-sm-8">
                                                    <input name="fundAmount" ng-model="reward.fundAmount" type="text" class="form-control" id="inputEmail3">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label">Reward Name</label>
                                                <div class="col-sm-8">
                                                    <input name="rewardName" ng-model="reward.rewardName" type="text" class="form-control" id="inputEmail3">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label">Number Available</label>
                                                <div class="col-sm-8">
                                                    <input name="numberAvailable" ng-model="reward.numberAvailable" type="text" class="form-control" id="inputEmail3">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-4 control-label">Estimated Delivery</label>
                                                <div class="col-sm-8">
                                                    <div class="global-textbox">
                                                        <input name="date1" ng-model="reward.estimatedDeliveryDate"  id="date-picker" class="date-pick form-control" placeholder="Date" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-12 control-label">Description focus on value</label>
                                                <div class="col-sm-12">
                                                    <textarea name="description" ng-model="reward.description" class="form-control" id="inputPassword3"></textarea>
                                                    <div class="inputchar-countwrap"><span class="inputcount">0</span>/180</div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-12 checkfix">
                                                    <label>
                                                        <input name="addressRequired" ng-model="reward.addressRequired" type="checkbox">Funders shipping address are required 
                                                    </label>
                                                </div>
                                            </div>									

                                        </div>

                                        <div class="col-md-4">

                                            <h4 class="reward-title">Your reward builder</h4>
                                            <span>(Click one or more)</span>

                                            <ul class="rewardtype-catlist">
                                                <li ng-repeat="type in rewardTypes"><a ng-click="getSelectedCategory(index, type.id)">{{type.name}}</a></li>
                                            </ul>

                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-default">Save</button>
                                            <span class="remove-button" ng-click="removeReward(index)">Remove reward</span>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-4">



                                </div>

                            </div><!-- Whole Pitch Reward Builder Wrapper Ends -->
                        </li>
                        <input type="button" ng-click="addReward()" value="Add">
                    </ul>



                </div>

            </form>

        </section>

    </div>

</div>


