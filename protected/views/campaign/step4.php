<script>
    var $campaignId = <?php echo (int) $_GET['id'] ?>
</script>
<div class="container playcontainer" ng-app="app">

    <div id="step4" class="row" ng-controller="step4Ctrl">

        <!-- steps come here -->
        <?php $this->widget('application.components.CampaignSteps'); ?>

        <section class="block-wrapper  col-md-12">

            <div class="top-title-wrap">

                <div class="col-md-6 text-left">
                    <h3 class="fund-main-title no-margin">PUMP UP THE VOLUME</h3>
                </div>

            </div>

            <p>Your campaign is coming along well, now iits time to get some support and feedback from your tribe.</p>

        </section>

        <section class="block-wrapper  col-md-12">

            <!-- we are feeling linky starts here -->     

            <h3 class="article-head-collapse">CHECKOUT YOUR CAMPAIGN AND GET FEEDBACK <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-8">

                    <form class="form-campaignfeedback" action="action">

                        <div class="title-wrapper">

                            <p>Use the link below to preview your campaign. Share the feedback
                                link to get suggestions from your tribe before going live.</p>

                            <div class="form-group global-textbox">
                                <input ng-model="shareUrl" class="form-control charcount" disabled>
                            </div>

                        </div>								

                        <div class="col-md-3 savewrapper">
                            <button type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Live Link</button>
                        </div>


                    </form>

                </div>	



            </div>                 

        </section>

        <section class="block-wrapper  col-md-12">

            <!-- we are feeling linky starts here -->     

            <h3 class="article-head-collapse">ADD YOUR CAMPAIGN TRIBE <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-8">

                    <form class="form-campaignfeedback" action="action">

                        <div class="title-wrapper">

                            <p>Use the link below to preview your campaign. Share the feedback
                                link to get suggestions from your tribe before going live.</p>

                            <div class="form-group global-textbox">
                                <input ng-model="emails" ng-enter="validateEmails()" type="text" maxlength="250" class="form-control charcount">
                            </div>

                        </div>								

                        <div class="col-md-3 savewrapper">
                            <button ng-click="validateEmails('invite')" type="button" class="btn btn-primary btn-lg btn-block amplifybutton">SEND INVITE</button>
                        </div>

                        <div class="col-md-4 col-md-offset-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" ng-model="canEdit" name="canEdit" > Give this person editing rights
                                    (Unselected they will just just
                                    linked to the campaign)
                                </label>
                            </div>
                        </div>

                    </form>

                </div>	

                <div class="col-md-4">
                    <div ng-repeat="(index, tribe) in tribes">{{tribe.name}} {{tribe.email}} <input ng-model="tribe.canEdit" type="checkbox"> Editor</div>

                </div>		                     

            </div>                 

        </section><!-- Design your flip box  form Ends here -->

        <section class="block-wrapper col-md-12"><!-- For The money stuff form Starts here -->

            <h3 class="article-head-collapse">STEREOTRIBES SOCIAL AMPLIFER<sup>TM</sup> <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-8"><!-- Left side wrapper starts -->

                    <p>We understand that marketing is not for everyone. Use our automatic social amplify to post messages to your social media accounts when you reach key funding milestones. Use our copy that links back to your campaign or customise your own copy. You can even select which fund milestones posts to send. Need help?</p>

                    <form class="form-campaigntribe" action="action">

                        <h4 class="text-right">Turn social amplifer <input ng-model ="socialAmplifierStatus" name="socialAmpliferStatus" type="checkbox" class="red-highlight">{{}}</a></h4>
                        <div ng-repeat="(index, amplifer) in socialAmplifers" class="social-amplifer">

                            <p>At <span class="amplifier-percent">{{amplifer.percent}}%</span> {{amplifer.title}}</p>	

                            <div>
                                <textarea ng-model="amplifer.message" name="message" class="amplifier-box" rows="5" cols="90">{{amplifer.message}}</textarea>
                            </div>	

                            <div class="col-md-12 text-right">
                                <div class="checkbox">
                                    <label> 
                                        <input ng-model="amplifer.postStatus" type="checkbox" name="postStatus" id="radio_campaign_days" value="{{amplifer.postStatus}}"> Send post when I reach {{amplifer.percent}}% funding
                                    </label>
                                </div>
                            </div>						

                        </div>



                        <div class="row">
                            <div class="col-md-10">

                                <h4>Link the social amplifer to your groups social media accounts, or to
                                    the team member with largest social media coomunity. 
                                    Remember the rule, more fans more funds!
                                </h4>

                                <h4>Link with the social media accounts below:</h4>									
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-md-2">
                                <div class="linkedblock"></div>
                                <p class="text-center">Linked</p>
                            </div>
                            <div class="col-md-2">
                                <div class="linkedblock"></div>
                                <p class="text-center">Not Linked</p>
                            </div>
                            <div class="col-md-2">
                                <div class="linkedblock"></div>
                                <p class="text-center">Linked</p>
                            </div>
                            <div class="col-md-2">
                                <div class="linkedblock"></div>
                                <p class="text-center">Not Linked</p>
                            </div>
                        </div>
                        <div class="col-md-3 savewrapper">
                            <button ng-click="saveAmplifers()" type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Save</button>
                        </div>

                    </form>

                </div><!-- Left Side wrapper ends -->

                <div class="col-md-4"><!-- Right side wrapper starts-->


                </div><!-- Right side wrapper ends -->

            </div>	            

        </section>


        <section class="block-wrapper col-md-12"><!-- For The money stuff form Starts here -->

            <h3 class="article-head-collapse">TRACK YOUR CAMPAIGN <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-8"><!-- Left side wrapper starts -->

                    <p>Stereotribes will offer you some tracking and reports, however, if your a metrics
                        junkie, then we suggest generating a googleanalytics account and putting your
                        tracking code below.</p>  

                    <form class="form-analytics" action="action">

                        <div class="funding-video">
                            <div class="form-group global-textbox">
                                <input ng-model="trackerCode" type="text" class="form-control" id="campaign_days" placeholder="Google analytics tracking code goes here..">
                            </div>
                        </div>						

                        <div class="col-md-3 savewrapper">
                            <button ng-click="saveTrackerCode()" type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Save</button>
                        </div>

                    </form>

                </div><!-- Left Side wrapper ends -->

                <div class="col-md-4"><!-- Right side wrapper starts-->


                </div><!-- Right side wrapper ends -->

            </div>	            

        </section> 

        <div class="col-md-3 col-md-offset-9 mainsavebtn">

            <button ng-click="save()" type="button" class="btn btn-primary btn-lg btn-block savecontinuebutton">Save &amp; Continue
                <span>(Great!,You’re almost done)</span>
            </button>

        </div>

    </div>

</div>