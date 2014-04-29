<?php
echo '<pre>';
//print_r($data);
echo '</pre>';
?>
<div class="pagecontainer container">

    <div class="row">

        <section class="block-top col-md-12">

            <div class="top-title-wrap">

                <div class="col-md-6 text-left">
                    <h3 class="fund-main-title"><?php echo $data['title'] ?></h3>
                </div>

                <div class="col-md-6 text-right">
                    <span class="featured-notation"></span>
                </div>

            </div>
            <p><?php echo $data['shortSummary'] ?></p>

        </section>

        <section class="block-one col-md-8">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                <li><a href="#updates" data-toggle="tab">Updates/<span>5</span></a></li>
                <li><a href="#comments" data-toggle="tab">Comments/<span>39</span></a></li>
                <li><a href="#gallery" data-toggle="tab">Gallery/<span>16</span></a></li>
                <li><a href="#media" data-toggle="tab">Media</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane fade in active" id="home">

                    <div class="videowrapper">

                        <iframe src="<?php echo $data['videoUrl'] ?>" frameborder="0" allowfullscreen></iframe>

                    </div>

                    <section class="block-three">

                        <div class="row">
                            
                            
                            

                            <div class="inner-block-one col-md-12">

                                <h3 class="article-head">[[Our Passion Story]]</h3>

                                <div class="article-content">

                                    <p><?php echo $data['pitchStory'] ?></p>

<!--                                    <img src="/img/camp.jpg" class="img-responsive" />-->

                                </div>
                            </div>

                            <!--                            <div class="inner-block-two col-md-12">-->

                            <!--                                <h3 class="article-head">[[HOW WE WILL USE YOUR FUNDS...]]</h3>
                            
                                                            <div class="article-content">
                            
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus mattis elementum iaculis. Suspendisse vestibulum ullamcorper auctor. Quisque nec ipsum fringilla, convallis libero vel, viverra ipsum. Quisque pulvinar ornare consectetur. Mauris ut libero sollicitudin, tincidunt lectus non, aliquet felis. Sed eget lacus vitae sapien eleifend euismod vel ac eros. Sed quis lacinia enim. Pellentesque vel diam facilisis, bibendum libero id, cursus lectus. Nulla facilisi. Vestibulum eu leo lacinia, condimentum sem id, lobortis metus. Donec dignissim ante non sagittis dapibus. Praesent convallis arcu ut venenatis cursus.</p>
                            
                                                                <ul class="articlelist">					
                                                                    <li>Suspendisse vestibulum ullamcorper auctor. </li>
                                                                    <li>Vestibulum eu leo lacinia, condimentum sem is</li>
                                                                    <li>Mauris ut libero sollicitudin, tincidunt</li>
                                                                </ul>
                            
                                                                <img src="/img/camp2.jpg" class="img-responsive" />
                            
                                                            </div> -->
                            <!--                            </div>-->

                            <div class="inner-block-three col-md-12">

                                <h3 class="article-head">OUR TRIBE...</h3>

                                <div class="article-content">

                                    <?php
                                    $strTribe = '';
                                    if(is_array($data['tribes']))
                                    foreach ($data['tribes'] as $tribe) {
                                        if ($tribe->id) {
                                            $strTribe .=<<<EOD
                                    
                                                <div class="tribeswrap col-xs-4 col-sm-4 col-md-3 text-center">
                                                    <div class="tribeimgwrap">
                                                        <img src="/img/tribes.png" class="img-circle img-responsive" />
                                                    </div>
                                                    <h4>{$tribe->name}</h4>
                                                    <h5>Event Manager</h5>
                                                    <h5>{$tribe->location}&nbsp;</h5>
                                                    <a href="#" class="linkedinprofile"></a>

                                                </div>
EOD;
                                        }
                                    }
                                    echo $strTribe;
                                    ?>



                                    <div class="clearfix"></div>

                                </div>

                            </div>

                            <div class="inner-block-four col-md-12">

                                <h3 class="article-head">OUR REFERENCE...</h3>

                                <div class="article-content">

                                    <div class="quotewrap">
                                        <h4 class="quote-author">JOHN BULL</h4>
                                        <h5 class="quote-designation">Director of glastonbury festival</h5>
                                        <blockquote>
                                            <p>Travers is a powerhouse of ideas and delivers results everytime. I confidently recommend his Stereotribes campaign and look forward to a worthy competitor on the festival circuit!</p>
                                        </blockquote>
                                    </div>

                                    <div class="quotewrap">
                                        <h4 class="quote-author">JOHN BULL</h4>
                                        <h5 class="quote-designation">Director of glastonbury festival</h5>
                                        <blockquote>
                                            <p>Travers is a powerhouse of ideas and delivers results everytime. I confidently recommend his Stereotribes campaign and look forward to a worthy competitor on the festival circuit!</p>
                                        </blockquote>
                                    </div>

                                </div>

                            </div>



                            <div class="inner-block-five col-md-12">

                                <h3 class="article-head">FIND OUR PROJECT ON...</h3>

                                <div class="article-content">
                                    
                                    <ul class="social-find">
                                    <?php {
                                        $linksStr = '';
                                        if(is_array($data['links']))
                                        foreach($data['links'] as $link) {
                                            if($link->type != 'custom') {
                                                $linksStr .= '<li><a href="'.$link->url.'" class="social-icons '.$link->type.'"></a></li>';
                                            }
                                        }
                                        echo $linksStr;

                                    }?>
                                        
                                    </ul>

                                    <ul class="social-links">
                                        <li>MAIN WEBSITE LINK:</li>
                                        <li><?php echo $data['mainLink']?></li>

                                        <li>OTHER LINKS:</li>
                                        <?php {
                                        $linksStr = '';
                                        if(is_array($data['links']))
                                        foreach($data['links'] as $link) {
                                            if($link->type == 'custom') {
                                                $linksStr .= '<li><a href="'.$link->url.'">'.$link->title.'</li>';
                                            }
                                        }
                                        echo $linksStr;

                                    }?>
                                    </ul>

                                </div>

                            </div>

                            <div class="inner-block-six col-md-12">

                                <h3 class="article-head">OUR RISKS &amp; CHALLENGES...</h3>

                                <div class="article-content">

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus mattis elementum iaculis. Suspendisse vestibulum ullamcorper auctor. Quisque nec ipsum fringilla, convallis libero vel, viverra ipsum. Quisque pulvinar ornare consectetur. Mauris ut libero sollicitudin, tincidunt lectus non, aliquet felis.</p>

                                </div>

                            </div>

                            <div class="inner-block-seven col-md-12">

                                <div class="article-content">

                                    <div class="col-md-6 amplifyblock">
                                        <button type="button" class="btn btn-primary btn-lg btn-block amplifybutton">
                                            <span class="amp-text">Amplify<br> Project</span>
                                            <span class="amp-icon"></span>
                                        </button>
                                    </div>

                                    <div class="col-md-6">
                                        <p>FUND THIS PROJECT AND WIN <br> 2 VIP TICKETS TO BESTIVAL 2014*</p>
                                    </div>

                                </div>

                            </div>

                            <div class="inner-block-eight col-md-12">

                                <h3 class="article-head">Project Tags</h3>

                                <!--                                <div class="article-content">
                                
                                                                        <div class="tags-wrap col-md-4">
                                                                                <i class="icon-tag"></i>
                                                                                <span class="tagstext">Hip Hop</span>
                                                                        </div>
                                
                                                                        <div class="tags-wrap col-md-4">
                                                                                <i class="icon-tag"></i>
                                                                                <span class="tagstext">Festival</span>
                                                                        </div>
                                
                                                                        <div class="tags-wrap col-md-4">
                                                                                <i class="icon-tag"></i>
                                                                                <span class="tagstext">Event</span>
                                                                        </div>
                                
                                                                        <div class="tags-wrap col-md-4">
                                                                                <i class="icon-tag"></i>
                                                                                <span class="tagstext">Hip Hop</span>
                                                                        </div>
                                
                                                                        <div class="tags-wrap col-md-4">
                                                                                <i class="icon-tag"></i>
                                                                                <span class="tagstext">Festival</span>
                                                                        </div>
                                
                                                                        <div class="tags-wrap col-md-4">
                                                                                <i class="icon-tag"></i>
                                                                                <span class="tagstext">Event</span>
                                                                        </div>
                                
                                                                        <div class="tags-wrap col-md-4">
                                                                                <i class="icon-tag"></i>
                                                                                <span class="tagstext">Hip Hop</span>
                                                                        </div>
                                
                                                                        <div class="tags-wrap col-md-4">
                                                                                <i class="icon-tag"></i>
                                                                                <span class="tagstext">Festival</span>
                                                                        </div>
                                
                                                                        <div class="tags-wrap col-md-4">
                                                                                <i class="icon-tag"></i>
                                                                                <span class="tagstext">Event</span>
                                                                        </div>
                                
                                                                </div>-->

                                <ul class="tags">
                                    <li><a href="#">Hip Hop</a></li>            
                                    <li><a href="#">Festival</a></li>
                                    <li><a href="#">Event</a></li>
                                    <li><a href="#">Hip Hop</a></li>            
                                    <li><a href="#">Festival</a></li>
                                    <li><a href="#">Event</a></li>
                                </ul>

                            </div>

                            <div class="inner-block-nine col-md-12">

                                <h3 class="article-head">Report this project to Stereotribes to investigate</h3>

                                <div class="article-content">

                                    <div class="col-md-4">

                                        <button type="button" class="btn btn-primary btn-lg btn-block">Report</button>

                                    </div>


                                    <div class="col-md-8">

                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus mattis elementum iaculis. Suspendisse vestibulum ullamcorper auctor. </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>

                </div>

                <div class="tab-pane fade" id="updates">

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#allupdates" data-toggle="tab">All Updates</a></li>
                        <li><a href="#campupdates" data-toggle="tab">Campaign Announcements Only</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="allupdates">

                            <div class="announcement">
                                <img src="/img/dp.jpg" width="60" height="60">
                                <div class="activity-name">

                                    <a href="#">John Danza</a> <span>contributed</span>
                                    <span>4 hours ago</span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>

                                </div>
                            </div>

                            <div class="announcement">
                                <img src="/img/dp.jpg" width="60" height="60">
                                <div class="activity-name">

                                    <a href="#">John Danza</a> <span>contributed</span>
                                    <span>4 hours ago</span>
                                    <img src="/img/camp.jpg" class="img-responsive" />
                                </div>
                            </div>

                            <div class="announcement">
                                <img src="/img/dp.jpg" width="60" height="60">
                                <div class="activity-name">

                                    <a href="#">John Danza</a> <span>contributed</span>
                                    <span>4 hours ago</span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                </div>
                            </div>

                            <div class="announcement">
                                <img src="/img/dp.jpg" width="60" height="60">
                                <div class="activity-name">

                                    <a href="#">John Danza</a> <span>contributed</span>
                                    <span>4 hours ago</span>

                                </div>
                            </div>

                            <div class="announcement">
                                <img src="/img/dp.jpg" width="60" height="60">
                                <div class="activity-name">

                                    <a href="#">John Danza</a> <span>contributed</span>
                                    <span>4 hours ago</span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="campupdates">

                            <div class="announcement">
                                <img src="/img/dp.jpg" width="60" height="60">
                                <div class="activity-name">

                                    <a href="#">John Danza</a> <span>contributed</span>
                                    <span>4 hours ago</span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                </div>
                            </div>

                            <div class="announcement">
                                <img src="/img/dp.jpg" width="60" height="60">
                                <div class="activity-name">

                                    <a href="#">John Danza</a> <span>contributed</span>
                                    <span>4 hours ago</span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <img src="/img/camp.jpg" class="img-responsive" />
                                </div>
                            </div>

                            <div class="announcement">
                                <img src="/img/dp.jpg" width="60" height="60">
                                <div class="activity-name">

                                    <a href="#">John Danza</a> <span>contributed</span>
                                    <span>4 hours ago</span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                    <img src="/img/camp.jpg" class="img-responsive" />
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="tab-pane fade" id="comments">

                </div>

                <div class="tab-pane fade" id="gallery">

                </div>

                <div class="tab-pane fade" id="media">

                </div>

            </div>

        </section>

        <section class="block-two col-md-4">

            <!-- fund block -->
            <div class="block-two-one" style="display: <?php echo $_GET['display'] ?>">

                <div class="fundraised-count-block">

                    <div class="fundraised-count-wrap">
                        Raised:
                        <span class="fund-count">£<?php echo $data['raised']?></span>
                    </div>

                    <div class="fundraised-notation" style="width: <?php echo Utils::percentage($data['raised'], $data['goal'], 0)?>%;"></div>		

                </div>

                <div class="fund-percent" style=""><?php echo Utils::percentage($data['raised'], $data['goal'], 2)?>% Funded</div>
<!--                <div class="fund-percent">30% Funded</div>-->

                <div class="fund-info-block-wrapper">

                    <div class="fund-info-block col-md-4">
                        <i class="icon-record"></i>
                        <div class="info1">Days Left</div>
                        <div class="info2">36</div>
                    </div>

                    <div class="fund-info-block col-md-4">
                        <i class="icon-user"></i>
                        <div class="info1">Backers</div>
                        <div class="info2"><?php echo $data['backers']?></div>
                    </div>

                    <div class="fund-info-block col-md-4">
                        <i class="icon-bullseye"></i>
                        <div class="info1">Goal</div>
                        <div class="info2">£<?php echo $data['goal']?></div>
                    </div>

                    <div class="fund-info-block col-md-4">
                        <i class="icon-location"></i>
                        <div class="info1">Location</div>
                        <div class="info2"><?php echo $data['city'] .', '. $data['country'] ?></div>
                    </div>

                    <div class="fund-info-block col-md-4">
                        <i class="icon-tag"></i>
                        <div class="info1">Category</div>
                        <div class="info2"><?php echo $data['category']?></div>
                    </div>

                    <div class="fund-info-block col-md-4">
                        <i class="icon-unlock-alt"></i>
                        <div class="info1">Funding Type*</div>
                        <div class="info2"><?php echo $data['fundingType']?></div>
                    </div>

                </div>

                <div class="amplifyblock">

                    <button type="button" class="btn btn-primary btn-lg btn-block amplifybutton">
                        <span class="amp-text">Amplify<br> Project</span>
                        <span class="amp-icon"></span>
                    </button>

                    <p>FUND THIS PROJECT AND WIN <br> 2 VIP TICKETS TO BESTIVAL 2014*</p>

                </div>

                <div class="clearfix"></div>

            </div>
            
            <!-- fund block ends -->

            <div class="block-two-two">

                <button type="button" class="btn btn-primary btn-lg">
                    <i class="icon-share"></i>
                    <span>Sharing is caring :)</span>
                </button>
                <button type="button" class="btn btn-primary btn-lg">
                    <i class="icon-heart"></i>
                    <span>Report</span>
                </button>

            </div>

            <div class="block-two-inner color-dark">

                <h3>CHOOSE YOUR REWARD</h3>
                <h5><em>FOR YOUR CONTRIBUTION...</em></h5>

            </div>
            
            <?php 
            /**
             * rewards 
             */
            
            if(is_array($data['rewards'])) {
                foreach($data['rewards'] as $r) {
                    $rewardTypes = '';
                    $estimatedDelivery = $r->estimatedDelivery;
                    if(is_array($rewardTypes)) {
                        $rewardTypes = implode(', ', $r->rewardTypes);
                    }
                    $strReward .=<<<EOD
                    
                    <div class="block-two-inner color-red">
                        <div class="reward-block">
                            <div class="reward-currency text-left">£{$r->fundAmount}</div>
                            <div class="reward-amount text-right">{$r->available} Left</div>
                        </div>

                        <div class="reward-type">{$r->name}</div>

                        <p>{$r->description}</p>

                        <div class="reward-estimation">

                            <label>Estimation Delivery:</label>
                            <span>{$estimatedDelivery}</span>

                        </div>

                        <div class="reward-icons-block">

                            <label>Reward icons:</label>

                            <div class="reward-icon">

                                <i class="icon-record"></i>
                                <i class="icon-record"></i>
                                <i class="icon-record"></i>

                            </div>

                        </div>

                    </div>
EOD;
                }
            }
            ?>
            
            
            <!-- rewards -->
            <?php echo $strReward; ?>
            

            <div class="block-two-desc">

                <label>Campaigners note:</label> 
                <span>We cannot guarantee the reward is delivered as stated, however, we are committed to ensure we deliver on time and to your satisfaction.</span>

            </div>

        </section>			

    </div>

</div>