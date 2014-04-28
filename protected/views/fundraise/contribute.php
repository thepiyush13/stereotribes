 
<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/js/custom/fundraise.js', CClientScript::POS_END);
?>

<div class="container fund-step-container">
    <div class="row">

        <section class="main-hero-section">

            <img src="/img/fund-banner.jpg" class="img-responsive" />
            

            <h1 class="main-hero-heading">CAMDEN ELECTROARTS MUSIC FESTIVAL</h1>

        </section>

        <nav class="fund-navigation">
            <span class="fund-links-title">CHOOSE YOUR<br> REWARD BELOW...</span>
            <a href="#" class="fund-links links-support">Support</a>
            <a href="#" class="fund-links links-pay">Pay</a>
            <a href="#" class="fund-links links-love">Love</a>
            <span class="icon-heart links-heart"></span>
        </nav>

        <section class="col-md-12 fund-block-wrapper">
            <h3 class="fund-contribution" >Your Contribution: <span class="red-highlight" id="fundContribution"></span></h3>
            <h3 class="fund-reward" >Your Reward: <span class="red-highlight" id="selectedRewardName"></span></h3>

        </section>

        <section class="col-md-12 fund-block-wrapper">
            
            
        <?php foreach ($campaign->rewards as $reward) { ?>

            <div class="fund-block-inner color-dark"><!--  Fund block starts-->
                <div class="reward-currency">£<?php echo $reward->fundAmount; ?></div>
                <div class="reward-block">
                    <div class="reward-type"><?php echo $reward->name; ?></div>
                    <div class="reward-amount"><?php echo $reward->available; ?></div>
                </div>
                <p><?php echo $reward->description;?></p>
                <div class="reward-estimation">
                    <label>Estimation Delivery:</label>
                    <span><?php echo date('F Y',  strtotime($reward->estimatedDelivery)) ;?></span>
                </div>

                <div class="reward-icon">                        
                    <i class="icon-reward icon-education"></i>
                    <i class="icon-reward icon-friendly"></i>
                    <i class="icon-reward icon-recognition"></i>
                    <i class="icon-reward icon-swag"></i>
                    <i class="icon-reward icon-digital"></i>
                    <i class="icon-reward icon-experiences"></i>
                    <i class="icon-reward icon-vip"></i>
                    <i class="icon-reward icon-special"></i>
                </div>
                 <a href="#" class="paybtn" data-toggle="modal" data-target="#fundstep2">Pay</a>
                 
                <?php if($reward->available == 0) { ?>
                <div class="fund-complete-block">
                     <div class="fund-complete-title">Fully Amped</div>
                </div>
                <?php } ?>
                 
                <input type="hidden" class="rewardId" value="<?php echo $reward->id ?>"/>
                <input type="hidden" class="rewardAmount" value="<?php echo $reward->fundAmount ?>"/>
                <input type="hidden" class="currency" value="<?php echo $campaign->currency ?>"/>
                
            </div><!--  Fund block ends-->
            <?php  } ?>
            
            <input type="hidden" id="projectId" value="<?php echo $campaign->id?>" />

    </div>
    
    
        <div class="modal fade" id="fundstep2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <span class="fundstep2-heading"></span>
              </div>
              <div class="modal-body">
                <form class="" role="form"> 
                  <div class="form-group fundstep2-formgroup">                  
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="firstname" placeholder="First Name">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="lastname" placeholder="Last Name">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="adressline1" placeholder="Address Line 1">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="adressline2" placeholder="Address Line 2">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="country" placeholder="Country">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="city" placeholder="City">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="postalcode" placeholder="Postal Code">
                    </div>
                    <div class="col-sm-6">
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12 checkfix">
                        <label>
                          <input type="checkbox">Thanks, I’d love the Stereotribes Monthly VIP Newsletter
                        </label>
                    </div>
                 </div>

<!--                 <a href="#" class="nextbtn" id="contribute-step1" data-dismiss="modal" data-toggle="modal" data-target="#fundstep3">Next</a>-->
                 
                 <a href="#" class="nextbtn" id="contribute-step1"  data-toggle="modal" data-target="#fundstep3">Next</a>

                </form>
              </div>
            </div>
          </div>
        </div>