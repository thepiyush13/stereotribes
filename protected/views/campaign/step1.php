<script>
    var $campaignId = <?php echo (int) $_GET['id'] ?>
</script>
<style>
    .active:before {
        font-family: 'stereotribe';
        content: "\2713";
        position: absolute;
        /*color: #d6201f!important;*/
        color: #ffffff!important;
        top: 5px;
        left: 90%;
        margin-left: -18px;
        color: #fff;
        font-size: 34px;
    }
    .cat-wrap:hover {
        cursor: pointer;
    }

    .error {
        background-color: #f2dede; color: #9f0202; font-size: 16px;  margin-bottom: 15px; padding: 10px;
        display: none;
    }
    
    .step1-loader {
        background: url(/img/loader.gif) no-repeat ;
        display: inline-block;
        /*height: 35px;*/
        width: 50px;
        float: right;
        margin-top: 40px;
    }
</style>
<div class="container playcontainer" ng-app="app">

    <div class="row">

        <!-- steps come here -->
        <?php $this->widget('application.components.CampaignSteps'); ?>

        <section class="block-wrapper  col-md-12">

            <div class="top-title-wrap">

                <div class="col-md-6 text-left">
                    <h3 class="fund-main-title no-margin">GET AMPED UP...</h3>
                </div>

            </div>

            <p>Got a great idea for a music related campaign? Sure you do! Lets being drafting your campaign together. There are five steps to complete your project. <b><span class="red-highlight">TIP:</span> Click here for a checklist of things to prepare.</b></p>

        </section>

        <!-- HOOSE YOUR MUSIC+ CATEGORY form starts here -->

        <form class="form-one" action="action" ng-controller="Step1Ctrl">  

            <section class="block-wrapper  col-md-12">
                <div id="error" class="error">Error</div>
                     <h3 class="article-head">CHOOSE YOUR MUSIC+ CATEGORY</h3>

                    <div class="row">

                        <div class="col-md-9">
                            <div class="cat-wrap col-md-12"><span class="play-categories musicplus-red">Music+</span></div>
                            <div class="cat-wrap col-md-6" ng-repeat="c in config.categories"><span ng-click="selectCategory(c.id)" class="play-categories {{c.class}} {{ isSelected(c.id) }}">{{c.name}}</span></div>

                        </div>

                        <div class="col-md-3">

                            <p>Heya! We’re here to help you create your campaign. Remember all campaigns on Stereotribes are somehow related to music. What type of music project is yours? Select the cateogory that most suits your campaign.</p>
                            <p>Not sure if your project is suitable on Stereotribes? Take a 30 second pop quiz to find out.</p>

                            <button type="button" class="btn btn-default quiz-button">Suitability Quiz?</button>

                        </div>

                    </div>

            </section>

            <section class="block-wrapper  col-md-12">

                <h3 class="article-head">HOW MUCH DO YOU WANT TO RAISE?</h3>

                <div class="row">

                    <div class="col-md-9">

                        <select class="price-dropdown" ng-model="createCampaign.currency">
                            <option ng-repeat="c in config.currencies" value="{{c.id}}">{{c.symbol}} {{c.code}}</option>
                        </select>  

                        <div class="form-group price-text">
                            <input ng-model="createCampaign.goal" type="text" class="form-control" id="price" placeholder="Price">
                        </div>

                    </div>

                    <div class="col-md-3">

                        <p>You’ll need a paypal account to receieve the money you raise, but don’t worry your contributors can pay in many different ways. You can change the fundraising target at any time before you go live.</p>

                    </div>

                </div>

            </section>

            <section class="block-wrapper  col-md-12">

                <h3 class="article-head">WHO IS THIS PROJECT FOR?</h3>

                <div class="row">

                    <div class="col-md-9">

                        <select class="project-offer" ng-model="createCampaign.projectFor">
                            <option value="team">Team</option>
                            <option value="individual">Individual</option>
                        </select>         

                    </div>

                    <div class="col-md-3">

                        <p>The funds you raise have to be assigned to a person or to your group. Pick the entity one that suits you the most. Don’t worry If you get stuck, just ask for <a class="sterio-link" href="#">Stereotribes support.</a></p>

                    </div>
                    <div class="col-md-4 col-md-offset-8">
                        
                        <button style="float: right;" type="button" class="btn btn-default save-button" ng-click="save()">Save & Continue</button>
                        <span class="step1-loader" style="display: none; height: 35px;"></span>
                    </div>

                </div>

            </section>
            {{projectFor}}

        </form><!-- HOOSE YOUR MUSIC+ CATEGORY Ends here -->

    </div>

</div>