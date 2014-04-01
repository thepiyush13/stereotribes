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

        <form class="form-one" action="action" ng-controller="CampaignCreateCtrl">  

            <section class="block-wrapper  col-md-12">

                <h3 class="article-head">CHOOSE YOUR MUSIC+ CATEGORY</h3>

                <div class="row">

                    <div class="col-md-9">
                        <div class="cat-wrap col-md-6" ng-repeat="c in config.categories"><span ng-click="selectCategory(c.id)" class="play-categories {{c.class}}">{{c.name}}</span></div>
<!--                    <div class="cat-wrap col-md-12"><span class="play-categories musicplus-red">Music+</span></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-arts" href="#">Arts</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-technology" href="#">Technology</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-research" href="#">Research</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-commercial" href="#">Commercial</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-imaginative" href="#">Imaginative</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-performance" href="#">Performance</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-film" href="#">Film</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-games" href="#">Games</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-publishing" href="#">Publishing</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-production" href="#">Production</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-community" href="#">Community</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-education" href="#">Education</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-therapy" href="#">Therapy</a></div>
                        <div class="cat-wrap col-md-6"><a class="play-categories color-fashion" href="#">Fashion</a></div>-->

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
                            <option ng-repeat="c in config.currencies">{{c.symbol}} {{c.code}}</option>
                        </select>  

                        <div class="form-group price-text">
                            <input ng-model="createCampaign.goal" type="number" class="form-control" id="price" placeholder="Price">
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

                        <select class="price-dropdown" ng-model="createCampaign.projectFor">
                            <option value="team">Team</option>
                            <option value="individual">Individual</option>
                        </select>         

                    </div>

                    <div class="col-md-3">

                        <p>The funds you raise have to be assigned to a person or to your group. Pick the entity one that suits you the most. Don’t worry If you get stuck, just ask for <a class="sterio-link" href="#">Stereotribes support.</a></p>

                        <button type="button" class="btn btn-default save-button" ng-click="save()">Save & Continue</button>

                    </div>

                </div>

            </section>
            {{projectFor}}

        </form><!-- HOOSE YOUR MUSIC+ CATEGORY Ends here -->

    </div>

</div>