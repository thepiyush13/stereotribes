<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/js/custom/utils.js', CClientScript::POS_END);
$cs->registerScriptFile('/js/custom/fundraise.js', CClientScript::POS_END);
?>
<div class="container fund-step-container">
    <div class="row">
        
        <section class="main-hero-section">
            <?php if($fundingInfo['thankyou_image_url']) { ?>
            <img src="<?php echo $fundingInfo['thankyou_image_url']; ?>" class="img-responsive" />
            <?php } else if( $fundingInfo['thankyou_video_url']){ ?>
            <iframe class="thankyou-video" src="<?php echo $fundingInfo['thankyou_video_url']; ?>" frameborder="0" allowfullscreen></iframe>
            <?php } ?>
        </section>
        <section class="col-md-12 fund-block-wrapper">
            <h1 class="thanks-heading">A MASSIVE THANKS! YOU HELPED RAISE: <span class="red-highlight">£<?php echo $totalFund; ?></span></h1>
        </section>

        <nav class="fund-navigation">
            <span class="fund-links-title fund-links-fix">HELP US SHARE<br> THE CAMPAIGN!</span>
            <a href="#" class="fund-links links-support">Support</a>
            <a href="#" class="fund-links links-pay">Pay</a>
            <a href="#" class="fund-links links-love">Love</a>
            <span class="icon-heart links-heart"></span>
        </nav>            

            <?php 
                $url = 'http://stereotribes.jumpcatch.com/campaign/'.$fundingInfo['project_id'];
                $title = $fundingInfo['name'];
                $desc = $fundingInfo['short_summary'];
                $fbShareUrl = SocialLinks::get_fb_share_link($url, $title, $desc);

                $tweetUrl = SocialLinks::get_twt_share_link($desc);
                $gplusShare = SocialLinks::get_gplus_share_link($url, $desc);
                $mailTo = SocialLinks::get_mail_to_link('admin@stereotribes.com', $title, $desc);
                
            ?>
        <section class="col-md-12 fund-block-wrapper fund-block-fix">
            
            <div class="col-md-6 thanksblock separatorline separatorbottom">
                <h1 class="thanksblock-heading red-highlight">SHARE YOUR PASSION!</h1>
                <h3 class="thanks-subheading">Amplify the campaign by<br> sharing it everyway possible!</h3>
                <div class="thanksocial-wrapper">
                    <a class="thanksocial thanks-message" href="<?php echo $mailTo; ?>"></a>
                    <a class="thanksocial thanks-link" href="<?php echo $url; ?>"></a>
                </div>
                <div class="thanksocial-wrapper">
                    
                    <a class="thanksocial thanks-fb" href="<?php echo $fbShareUrl; ?>"></a>
                    <a class="thanksocial thanks-twitter" href="<?php echo $tweetUrl; ?>"></a>
                    <a class="thanksocial thanks-gplus" href="<?php echo $gplusShare; ?>"></a>
                </div>
            </div>

            <div class="col-md-6 thanksblock separatorbottom">
                <h1 class="thanksblock-heading">PAYMENT SUMMARY</h1>
                <ul class="payment-summary-list">
                    <li>You contributed: <span class="payment-values">£<?php echo $fundingInfo['amount']; ?></span></li>
                    <li>Payment method: <span class="payment-values">Paypal</span></li>
                    <li>Your reward: <span class="payment-values"><?php echo $fundingInfo['name']; ?></span></li>
                    <li>Am I Visibility? <span class="payment-values">Yes</span> <span class="hideme">(Hide me)</span></li> 
                </ul>
                <a href="#" class="make-contribution">Make another contribution to<br>
                    this campaign?</a>
            </div>

            <div class="col-md-6 thanksblock separatorline">
                <h1 class="thanksblock-heading">JOIN STEREOTRIBES</h1>
                <h3 class="thanks-subheading">Calling all music lovers...<br>
                    our tribe is waiting for you!</h3>
                <a class="fundjoin-img" href="#"><img src="/img/fund4.jpg" class="img-responsive" /></a>
                <a class="fund-join-link" href="#">Rock ‘n’ Roll</a>
            </div>

            <div class="col-md-6 thanksblock">
                <h1 class="thanksblock-heading">START CHATTING</h1>
                <h3 class="thanks-subheading">The campaign team would<br>
                    love to hear from you!</h3>
                <div class="form-group global-textarea">
                    <textarea type="text" maxlength="180" id="chatText" class="form-control charcount" id="title-input" autocomplete="off"></textarea>
                    <div class="chatbtn-wrp">
                        <div class="inputchatting-countwrap"><span class="inputcount">0</span> of 500</div>
                        <button class="chatsendbutton" id="chatsendbutton">Send</button>
                        
                    </div>
                </div>
            </div>
        </section>


        <section class="col-md-12 fund-block-wrapper">
            <?php foreach($relatedProjects as $project) { ?>
            <div class="col-md-6 related-fund-block">
                <div class="brick brickhover medium mediumpreview">
                    <div class="brickinner">
                        <div class="brickimgwrap">
                            <img data-src="holder.js/100%x100%/text: /#c2c1c1:#fff" src="" alt="" class="img-responsive" />
                        </div>
                        
                         <?php 
                            $total = 0;
                            $backers = array();
                            foreach($project['funds'] as $fund) {
                                $total += $fund['amount'];
                                $backers[]=$fund['userId'];
                            }
                            $percenage = Utils::percentage($total, $project['goal'], 1);
                         ?>
                        
                        <div class="fund-block-normal fund-block-normal-fix">
                            <div class="fund-normal-count-block">
                                <div class="normal-count">
                                    <span class="fund-count"><?php echo $percenage; ?>%</span>
                                    Funded
                                </div>
                                <div class="fund-notation notationfix"></div>                           
                            </div>

                            <div class="fund-normal-title-block fund-normal-fix fund-height">
                                <a href="#" id="fundlive-title" class="fund-normal-title normaltitle"><?php echo $project['title']; ?></a>
                                <div class="fund-normal-location-block">
                                    <i class="icon-location"></i>
                                    <span class="fund-normal-location"><?php echo $project['country']," ",$project['state'];?> UK</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mask" style="display: block;">

                        <a href="/campaign/<?php echo $project['id']?>/contribute/share">
                            <span class="link-spanner"></span>
                        </a>
                        <div class="maskheaderwrap">
                            <h4 class="maskheader">Production</h4>
                            <span class="bordercut"></span>
                            <?php $liked = ($project['liked']) ? 'liked' : "";?>
                            <a href="javascript:;" class="icon-heart likeMe <?php echo $liked; ?>"  data-id="<?php echo $project['id']; ?>"></a>
                        </div>

                        <div class="fund-normal-title-block">
                            <a href="#" class="fund-normal-title normaltitle"><?php echo $project['title']; ?></a>
                            <div class="fund-normal-location-block">
                                <i class="icon-location"></i>
                                <span class="fund-normal-location"><?php echo $project['country']," ", $project['city']?> </span><br>
                                <span class="fund-normal-author">by <?php echo $project['fullname']?></span>
                            </div>
                        </div>          

                        <p><?php echo $project['short_summary']?></p>  
                        <div class="fund-normal-count-block">
                            <div class="normal-count">
                               
                               
                                <span class="fund-count"><?php echo $percenage; ?>%</span>
                                Funded
                            </div>
                            <div class="fund-notation notationfix"></div>                           
                        </div>

                        <ul class="campain-info-wrap">
                            <li>
                                <?php 
                                $diff = Utils::getDateInterval(date('Y-m-d'), $project['end_date']);
                                ?>
                                <div><?php echo $diff->d ?></div>
                                <div>Days left</div>
                            </li>
                            <li>
                                <div><?php echo count(array_unique($backers)); ?></div>
                                <div>Backers</div>
                            </li>

                            <li>
                                <div>£<?php echo $project['goal']; ?></div>
                                <div>Pledge</div>
                            </li>
                            <li>
                                <a href="#">Fund<br> Now</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <?php } ?>

        </section> 

        <section class="col-md-12 fund-block-wrapper">

            <a href="#" class="thanks-heading">BACKSTAGE: READ OUR BLOG, IT’S FULL OF INSPIRATIONAL STORIES</a>

            <div class="blog-wrapper">
                <img src="/img/blog-bg.jpg" class="img-responsive">
            </div>

        </section>           

    </div>

</div>

<style>
    
.thankyou-video {
    width:100%;
    height:715px;
}

.liked {
    color: #d6201f !important;
}
</style>






