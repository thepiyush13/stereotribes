<script>
    var $campaignId = <?php echo (int) $_GET['id'] ?>
</script>
<div class="container playcontainer" ng-app="app">

    <div class="row" id="step3" ng-controller="step3Ctrl">

        <!-- steps come here -->
        <?php $this->widget('application.components.CampaignSteps'); ?>

        <section class="block-wrapper  col-md-12">

            <div class="top-title-wrap">

                <div class="col-md-6 text-left">
                    <h3 class="fund-main-title no-margin">STUFF FUNDERS LOVE</h3>
                </div>

            </div>

            <p>Funders want to get to know your tribe and explore what your about. The more links you share the more likely you’ll be funded. The best part is, potential funders will become your future fans. Stereotribes is your fan pimp! ;)</p>

        </section>

        <section class="block-wrapper  col-md-12">

            <!-- we are feeling linky starts here -->     

            <h3 class="article-head-collapse">WE’RE FEELING LINKY <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-12">

                    <div class="row">

                        <form class="form-flipbox" action="action">

                            <div class="col-md-8">

                                <div class="title-wrapper">

                                    <h4 class="article-inner-title">Links to your websites and main pages </h4>

                                    <p>Place the url of your main website about you or your group</p>

                                    <div class="form-group global-textbox">
                                        <input ng-model="mainLink" type="text" maxlength="50" class="form-control charcount" id="title-input">
                                    </div>

                                </div>

                                <div class="social-pages-wrapper row">

                                    <div ng-repeat="(index, link) in links.list" class="socialLinkWrap col-md-6">

                                        <div class="form-group global-textbox">
                                            <label ng-hide="link.editing" ng-click="editLink(link);">{{link.title}}</label  >
                                            <input ng-show="link.editing" ng-model="link.title" ng-blur="doneLinkEditing(link)" ng-focus="link == editedLinkItem">
                                            <input ng-model="link.url" type="text" class="form-control">
                                            <a ng-click="removeLink(index)" ng-show="link.type=='custom'">Delete</a>
                                        </div>

                                    </div>


                                </div>
                                <p></p>
                                <div class="row">
                                    <div class="col-md-3">
                                        <button ng-click="addLink()" type="button" class="btn btn-default">+ add Link</button>
                                    </div>
                                </div>

                                <div class="col-md-2 savewrapper">
                                    <button ng-click="saveLinks()"type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Save</button>
                                </div>

                            </div>			                     

                        </form>

                    </div>	                       

                </div>

            </div>                 

        </section><!-- Design your flip box  form Ends here -->

        <section class="block-wrapper col-md-12"><!-- For The money stuff form Starts here -->

            <h3 class="article-head-collapse">MEDIA LINKS <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-8"><!-- Left side wrapper starts -->

                    <p>Show your images, videos, music and files in your campaign. People love 
                        watching this stuff and amplifies your chances being funded.</p>  

                    <form class="form-medialinks" action="action">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs medialinks-tabs">
                            <li class="active"><a class="icons-video" href="#video" data-toggle="tab" ng-click="selectedMedia('video')">Add Video</a></li>
                            <li><a class="icons-cam" href="#images" data-toggle="tab" ng-click="selectedMedia('image')">Add images</a></li>
                            <li><a class="icons-music" href="#music" data-toggle="tab" ng-click="selectedMedia('music')">Add Music</a></li>
                            <li><a class="icons-pdf" href="#pdf" data-toggle="tab" ng-click="selectedMedia('pdf')">Add PDF</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-media tab-content">

                            <div class="tab-pane active" id="video">

                                <div class="" ng-repeat="(index, video) in mediaLinks.video">

                                    <div class="global-textbox" ng-hide="video.editing">
                                        <div class="col-md-10" >									
                                            <div class="form-group global-textbox">
                                                <label>{{video.title || "Enter title..."}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2" >									
                                            <div class="form-group global-textbox">
                                                <a  ng-click="editMedia('video', index)">Open</a> | <a ng-click="removeMediaLink('video', index)">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="global-textbox" ng-show="video.editing">
                                        <div class="col-md-2 col-md-offset-10" >									
                                            <div class="form-group global-textbox">
                                                <a  ng-click="doneEditMedia('video', index)">Close</a> | <a ng-click="removeMediaLink('video', index)">Delete</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6" >									
                                            <div class="form-group global-textbox">
                                                <label for="playercode">Video player code</label>
                                                <input ng-model="video.codeUrl" type="text" class="form-control" id="facebook">
                                            </div>
                                        </div>

                                        <div class="col-md-6">									
                                            <div class="form-group global-textbox">
                                                <label for="title">Title</label>
                                                <input ng-model="video.title" type="text" class="form-control" id="facebook">
                                            </div>
                                        </div>

                                        <div class="col-md-12">									
                                            <div class="form-group global-textarea">
                                                <label for="description">Description</label>
                                                <textarea ng-model="video.description" type="text" maxlength="500" class="form-control" id="description" autocomplete="off"></textarea>
                                                <div class="inputchar-countwrap"><span class="inputcount">0</span>/500</div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr style="border: 0; border-bottom: 2px dashed #ccc; margin: 20px;">

                                </div>

                                <div class="col-md-3">
                                    <button ng-click="addMediaLink('video')" type="button" class="btn btn-default">+ add Link</button>
                                </div>

                            </div>




                            <div class="tab-pane" id="images">

                                <div class="" ng-repeat="(index, image) in mediaLinks.image">
                                    <div class="global-textbox" ng-hide="image.editing">
                                        <div class="col-md-10" >									
                                            <div class="form-group global-textbox">
                                                <label>{{image.title || "Enter title..."}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2" >									
                                            <div class="form-group global-textbox">
                                                <a  ng-click="editMedia('image', index)">Open</a> | <a ng-click="removeMediaLink('image', index)">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="global-textbox" ng-show="image.editing">
                                        <div class="col-md-2 col-md-offset-10" >									
                                            <div class="form-group global-textbox">
                                                <a  ng-click="doneEditMedia('image', index)">Close</a> | <a ng-click="removeMediaLink('image', index)">Delete</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">									
                                            <div class="form-group global-textbox">
                                                <label for="playercode">Upload Image</label>	
                                                <uploader m="mediaLinks.image[index]"></uploader>
                                            </div>
                                        </div>

                                        <div class="col-md-6">									
                                            <div class="form-group global-textbox">
                                                <label for="title">Title</label>
                                                <input ng-model="image.title" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-12">									
                                            <div class="form-group global-textarea">
                                                <label for="description">Description</label>
                                                <textarea ng-model="image.description" type="text" maxlength="500" class="form-control" id="description" autocomplete="off"></textarea>
                                                <div class="inputchar-countwrap"><span class="inputcount">0</span>/500</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="border: 0; border-bottom: 2px dashed #ccc; margin: 20px;">

                                </div>
                                <div class="col-md-3">
                                    <button ng-click="addMediaLink('image')" type="button" class="btn btn-default">+ add Link</button>
                                </div>

                            </div>

                            <div class="tab-pane" id="music">

                                <div class="" ng-repeat="(index, music) in mediaLinks.audio">
                                    <div class="global-textbox" ng-hide="music.editing">
                                        <div class="col-md-10" >									
                                            <div class="form-group global-textbox">
                                                <label>{{music.title || "Enter title..."}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2" >									
                                            <div class="form-group global-textbox">
                                                <a  ng-click="editMedia('audio', index)">Open</a> | <a ng-click="removeMediaLink('audio', index)">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="global-textbox" ng-show="music.editing">
                                        <div class="col-md-2 col-md-offset-10" >									
                                            <div class="form-group global-textbox">
                                                <a  ng-click="doneEditMedia('audio', index)">Close</a> | <a ng-click="removeMediaLink('audio', index)">Delete</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">									
                                            <div class="form-group global-textbox">
                                                <label for="playercode">Player code</label>
                                                <input ng-model="music.codeUrl" type="text" class="form-control" id="facebook">
                                            </div>
                                        </div>

                                        <div class="col-md-6">									
                                            <div class="form-group global-textbox">
                                                <label for="title">Title</label>
                                                <input ng-model="music.title" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-12">									
                                            <div class="form-group global-textarea">
                                                <label for="description">Description</label>
                                                <textarea ng-model="description" type="text" maxlength="500" class="form-control" id="description" autocomplete="off"></textarea>
                                                <div class="inputchar-countwrap"><span class="inputcount">0</span>/500</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="border: 0; border-bottom: 2px dashed #ccc; margin: 20px;">
                                </div>

                                <div class="col-md-3">
                                    <button ng-click="addMediaLink('audio')" type="button" class="btn btn-default">+ add Link</button>
                                </div>

                            </div>

                            <div class="tab-pane" id="pdf">

                                <div class="" ng-repeat="(index, pdf) in mediaLinks.pdf">
                                    <div class="global-textbox" ng-hide="pdf.editing">
                                        <div class="col-md-10" >									
                                            <div class="form-group global-textbox">
                                                <label>{{pdf.title || "Enter title..."}}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2" >									
                                            <div class="form-group global-textbox">
                                                <a  ng-click="editMedia('pdf', index)">Open</a> | <a ng-click="removeMediaLink('pdf', index)">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="global-textbox" ng-show="pdf.editing">
                                        <div class="col-md-2 col-md-offset-10" >									
                                            <div class="form-group global-textbox">
                                                <a  ng-click="doneEditMedia('pdf', index)">Close</a> | <a ng-click="removeMediaLink('pdf', index)">Delete</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">									
                                            <div class="form-group global-textbox">
                                                <label>Upload Image</label>	
                                                <span class="btn btn-default btn-file">
                                                    + Add Image <input type="file">
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">									
                                            <div class="form-group global-textbox">
                                                <label>Title</label>
                                                <input ng-model="pdf.title" type="text" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-12">									
                                            <div class="form-group global-textarea">
                                                <label for="description">Description</label>
                                                <textarea ng-model="pdf.description" type="text" maxlength="500" class="form-control" id="description" autocomplete="off"></textarea>
                                                <div class="inputchar-countwrap"><span class="inputcount">0</span>/500</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="border: 0; border-bottom: 2px dashed #ccc; margin: 20px;">

                                </div>
                                <div class="col-md-3">
                                    <button ng-click="addMediaLink('pdf')" type="button" class="btn btn-default">+ add Link</button>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-2 savewrapper">
                            <button ng-click="saveMediaLinks()" type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Save</button>
                        </div>

                    </form>

                </div><!-- Left Side wrapper ends -->

                <div class="col-md-4"><!-- Right side wrapper starts-->
                    <h4>Videos</h4>
                    <style>
                        li {list-style: none;}
                    </style>
                    <div>
                        <div ng-repeat="(index, video) in masterMediaLinks.video">
                            &lt;icon&gt; {{video.title}} 
                        </div>
                    </div>
                    <h4>Images</h4>
                    <div>
                        <div ng-repeat="(index, image) in masterMediaLinks.image">
                            <span style="display: inline-block; height: 100px; width: 100px; background-image: url('{{image.codeUrl}}'); background-repeat: no-repeat; background-position:  50% 0%; background-size: contain;"></span><span style="display: inline-block; vertical-align: top; margin-left: 10px; width: 50%;"> {{image.title}}</span>
                        </div>
                    </div>
                    <h4>Music</h4>
                    <div>
                        <div ng-repeat="(index, music) in masterMediaLinks.audio">
                            &lt;icon&gt; {{music.title}}
                        </div>
                    </div>
                    <h4>Pdf</h4>
                    <div>
                        <div ng-repeat="(index, pdf) in masterMediaLinks.pdf">
                            &lt;icon&gt; {{pdf.title}}
                        </div>
                    </div>

                </div><!-- Right side wrapper ends -->

            </div>	            

        </section>


        <section class="block-wrapper col-md-12"><!-- For The money stuff form Starts here -->

            <h3 class="article-head-collapse">THANK YOU FOR FUNDING VIDEO <span class="collapse-sign col-close"></span></h3>

            <div class="row collapse-container">

                <div class="col-md-8"><!-- Left side wrapper starts -->

                    <p>Stereotribes has pioneered the ‘Thank you video’. When a funder donates to your
                        campaign, they are sent to a page with a personal your ‘thank you’. The video 
                        should be short and playful. Perhaps, your group all wave and say thank you. 
                        Be creative and have fun!</p>  


                        <div class="funding-video">
                            <div class="checkbox">
                                <label>
                                    <input ng-model="fundThankyou.thankyouMediaType" type="radio" name="thankyouMediaType" value="video"> Add ‘thank you’ video (Youtube/Vimeo Link)
                                </label>
                            </div>
                            <div class="form-group global-textbox">
                                <input type="text" class="form-control" ng-model="fundThankyou.thankyouVideoUrl" ng-disabled="fundThankyou.videoOrImage =='image'" ng-focus="fundThankyou.hasFocus=true" ng-blur="getThankyouYoutubeVideoId(fundThankyou.thankyouVideoUrl)">
                            </div>
                        </div>

                        <div class="funding-image">
                            <div class="checkbox">
                                <label>
                                    <input ng-model="fundThankyou.thankyouMediaType" name="thankyouMediaType" type="radio" id="radio_campaign_payment_date" value="image"> Add image
                                </label>
                            </div>
                            <div class="form-group global-textbox">
                                <form method="POST" action="/campaign/upload" id="fundThankyouUploadForm" name="fundThankyouUploadForm" target="fundThankyouUploadIframe" enctype="multipart/form-data">
                                    <span class="btn btn-default btn-file" ng-disabled="fundThankyou.videoOrImage =='video'">
                                        + Add Image <input type="file" id="fundThankyouImage" name="fundThankyouImage" multiple="multiple" />
                                    </span>
                                    <span class="file-info">PNG, JPG or GIF 960x640 pixels</span>
                                    <input type="hidden" name="canpaignId" value="<?php echo $_GET['id'] ?>" />
                                    <input type="hidden" name="method" value ="campaign.fundThankyouUploadImage" />

                                    <div class="ajax-loader"></div>
                                </form>
                                <iframe  onload ="Campaign.fundThankyouIframeLoad()" name="fundThankyouUploadIframe" id="fundThankyouUploadIframe" scrolling="yes" style="display: none;"></iframe>
                            </div>
                        </div>							

                        <div class="col-md-2 savewrapper">
                            <button ng-click="saveThankyouVideo()" type="button" class="btn btn-primary btn-lg btn-block amplifybutton">Save</button>
                        </div>


                </div><!-- Left Side wrapper ends -->

                <div class="col-md-4"><!-- Right side wrapper starts-->
                    <iframe ng-hide="fundThankyou.thankyouMediaType=='image'" class="pitchvideo" src="{{fundThankyou.newThankyouVideoUrl}}" frameborder="0" allowfullscreen=""></iframe>
                    <div class="pitchimage" ng-hide="fundThankyou.thankyouMediaType=='video'">asdf
                        <img id="thankyouPicUrl" src="{{fundThankyou.thankyouImageUrl}}" class="img-responsive">
                    </div>

                </div><!-- Right side wrapper ends -->

            </div>	            

        </section> 

        <div class="col-md-3 col-md-offset-9 mainsavebtn">

            <button type="button" class="btn btn-primary btn-lg btn-block savecontinuebutton">Save &amp; Continue
                <span>(Great!,You’re almost done)</span>
            </button>

        </div>

    </div>

</div>