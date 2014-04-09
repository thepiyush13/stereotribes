<script>
    var $campaignId = <?php echo (int) $_GET['id'] ?>
</script>
<div class="container playcontainer" ng-app="app">

    <div class="row" ng-controller="step5Ctrl">

        <!-- steps come here -->
        <?php $this->widget('application.components.CampaignSteps'); ?>

        <section class="block-wrapper  col-md-12">

            <div class="top-title-wrap">

                <div class="col-md-6 text-left">
                    <h3 class="fund-main-title no-margin">AMPLIFY YOUR PASSION </h3>
                </div>

            </div>

            <p>Time for your project to go live</p>

        </section>

        <section class="block-wrapper  col-md-12">

            <!-- we are feeling linky starts here -->     

            <h3 class="article-head-collapse">HOW YOU GET FUNDED <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-8">

                    <p>The more information you provide, the quicker we can get you your funds!</p>

                    <form class="form-campaignfeedback form-horizontal" action="action">

                        <div class="getfund-wrapper">

                            <div class="form-group global-textbox">
                                <label for="inputEmail3" class="col-sm-4 control-label">Payment Type<sub class="important">*</sub></label>
                                <div class="col-sm-8">
                                    <div class="checkbox">
                                        <label>
                                            <input ng-model="paymentType" name="paymentType" type="checkbox"> Enable Payments by Credit Card
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input ng-model="rememberMe" name="rememberMe" type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group global-textbox">
                                <label for="inputPassword3" class="col-sm-4 control-label">Promotion Method</label>
                                <div class="col-sm-8 control-content">
                                    <input ng-model="promotionMethod" name="promotionMethod" type="text" class="form-control" id="">
                                </div>
                            </div>
                            <div class="form-group global-textbox">
                                <label class="col-sm-4 control-label">Take-away estimates</label>
                                <div class="col-sm-8 control-content">
                                    <p>If you reach your goal, expect to receive:</p>
                                    <p>Goal - Fees = Take-away</p>
                                    <p><span class="color-green goal">{{goal}}</span> - Fees = <span class="color-green takeaway">{{takeAway}}</span></p>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-3 savewrapper">
                            <button ng-click="saveFund()" type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Save</button>
                        </div>	

                    </form>

                </div>		                     

            </div>                 

        </section><!-- Design your flip box  form Ends here -->

        


        <section class="block-wrapper col-md-12"><!-- For The money stuff form Starts here -->

            <h3 class="article-head-collapse">WHATS LEFT TO DO? <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-8"><!-- Left side wrapper starts -->

                    <p>Missed a few sections? Create and print out this checklist on whats left to do.
                        Click the “Your to do list’ button below</p>  

                    <form class="form-todolist" action="action">

                        <div class="col-md-3 savewrapper">
                            <button type="button" class="btn btn-primary btn-lg btn-block amplifybutton">YOUR TO DO LIST</button>
                        </div>

                    </form>

                </div><!-- Left Side wrapper ends -->

            </div>	            

        </section>

        <section class="block-wrapper col-md-12"><!-- For Live Starts here -->

            <h3 class="article-head-collapse">GO LIVE AND GET FUNDED <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-8"><!-- Left side wrapper starts -->

                    <p>Phew! Congrats on getting through this, now its time to go live. Press the GO LIVE
                        button below.</p>  

                    <div class="col-md-5 mainsavebtn">
                        <button ng-click="goLive()" type="button" class="btn btn-primary btn-lg btn-block savecontinuebutton">Go Live
                            <span>Good Luck!</span>
                        </button>
                    </div>

                </div><!-- Left Side wrapper ends -->

            </div>	            

        </section> 

    </div>

</div>