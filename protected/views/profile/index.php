<?php // print_r($data) ?>
<div class="row">

            <div class="col-md-6"><!-- Left Block -->

            	<div class="row">

            	 <div class="col-md-12 profile-blocks">

            	 	<div class="project-image-wrapper">
            	 		
            	 		<img src="<?php  echo Yii::app()->request->baseUrl.'/uploads/profile/'.$data['user_details'][0]['profile_image'] ?>" class="img-responsive" />
                                  <?php // echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/profile/'.$model->profile_image,"profile_image",array("class"=>'img-responsive')); ?> 

            	 	</div>

            	 	<div class="project-container">

            	 		<h2 class="project-title"><?php  echo $data['user_details'][0]['name']; ?></h2>

    	 				<div class="project-social">	
<!--            				<a href="#" class="icons-reply"></a>
            				<a href="#" class="icons-message"></a>        					
        					<a href="#" class="icons-heart"></a>-->
        				</div>

        				<div class="project-location-block">								
    						<i class="icon-location"></i>
    						<span class="project-location"><?php  echo $data['user_details'][0]['location']; ?></span>
    						<a href="#" class="project-website"><?php  echo $data['user_details'][0]['name']; ?></a>
    					</div>

    					<p><?php  echo $data['user_details'][0]['description']; ?></p>

            	 	</div>

            	</div>

            	<div class="col-md-12 profile-blocks">
            	 	<?php foreach($data['user_projects'] as $key=>$project) { ?>
            	 	<div class="brick medium">

    			    	<div class="brickinner">

    				    	<img src="/img/gaga.jpg" alt="" class="img-responsive">

    						<div class="fund-block-normal fund-block-normal-fix">

    							<div class="fund-normal-count-block" style="background-color: #<?php  echo $data['category_color'][$project['category']]; ?>;">

    								<div class="normal-count" >
                                                                <span class="fund-count"><?php  echo $project['percent_funded']; ?>%</span>
    									Funded
    								</div>

    								<div class="fund-notation notationfix"></div>							
    							</div>

    					    	<div class="fund-normal-title-block fund-normal-fix">
    					    		
    								<a href="/campaign/<?php  echo $project['id']?>" id="fundlive-title" class="fund-normal-title normaltitle"><?php  echo $project['title']; ?></a>

    								<div class="fund-normal-location-block">
    									
    									<i class="icon-location"></i>
    									<span class="fund-normal-location"><?php  echo $project['city']; ?></span>

    								</div>

    					    	</div>

    					    </div>

    				    </div>				    

    			    </div>
                    <?php  } ?>

            	 </div>

               </div>

            </div><!-- Left Block Ends -->

            <div class="col-md-6"><!--Right block -->

            	<div class="row">

            	 <div class="col-md-12 profile-blocks">

            	 	<div class="project-dashboard-wrapper">

            	 		<div class="dash-head-wrap">

    			        	<div class="col-md-7">
    			        		<h2 class="dash-heading">Dashboard</h2>
    			        	</div> 

    			        	<div class="col-md-5">
    			        		<h3 class="dash-edit"><a href="<?php  echo $data['links']['edit']; ?>" class="text-right"><i class="icon-edit"></i> Edit Profile</a></h3>
    			        	</div>      	

    		        	</div>
            	 		
    	        	 	<div class="col-md-6 project-dash">
    		        		<a class="user-info-links" href="<?php  echo $data['links']['backed']; ?>"><?php  echo (int)$data['backed']; ?><span>Backed</span></a> 
    		        	</div>

    		        	<div class="col-md-6 project-dash">
    	        			<a class="user-info-links" href="<?php  echo $data['links']['created']; ?>"><?php  echo (int)$data['created']; ?><span>Created</span></a> 
    	        		</div>

    	        		<div class="col-md-6 project-dash">
    	        			<a class="user-info-links" href="<?php  echo $data['links']['comments']; ?>"><?php  echo (int)$data['comments']; ?><span>Comments</span></a> 
    	        		</div>
    	        		<div class="col-md-6 project-dash">
    	        			<a class="user-info-links" href="<?php  echo $data['links']['loved']; ?>"><?php  echo (int)$data['loved']; ?><span>Loved</span></a> 
    	        		</div>

            	 	</div>

            	 </div>

                    <!--start media block-->
                    <div class="col-md-12 profile-blocks">

                    <div class="project-add-media">

                        <div class="dash-head-wrap">

                            <div class="col-md-7">
                                <h2 class="dash-heading color-black">Add Media</h2>
                            </div>         

                        </div>

                        <ul class="upload-media-wrap">

                            <li>
                                <a class="icons-cam up-cam" href="#" data-dismiss="modal" data-toggle="modal" data-target="#addimage">Image</a>
                            </li>

                            <li>
                                <a class="icons-video up-video" href="#" data-dismiss="modal" data-toggle="modal" data-target="#addvideo">Video</a>
                            </li>

                            <li>
                                <a class="icons-music up-music" href="#" data-dismiss="modal" data-toggle="modal" data-target="#addaudio">Audio</a>
                            </li>

                        </ul>

                    </div>

                </div>
                    <!--end media block-->
                    <?php  $media  =  json_decode($data['user_details'][0]['media'],true); ?>
            	 <div class="col-md-12 profile-blocks">

            	 	<div class="project-image-wrapper">
            	 		
            	 		<img src="<?php  echo $media['IMAGE']; ?>" class="img-responsive " />

            	 	</div>

<!--            	 	<div class="project-profile">

            	 		<label>"Here is a photo of me at a festival"</label>

            	 	</div>-->

            	 </div>  

            	 

            	<div class="col-md-12 profile-blocks">

            	 	<div class="project-image-wrapper">
            	 		
            	 		<?php  echo $media['VIDEO']; ?>

            	 	</div>

<!--            	 	<div class="project-profile">

            	 		<label>"Here is a photo of me at a festival"</label>

            	 	</div>-->

            	 </div> 

            	 <div class="col-md-12 profile-blocks">

            	 	<div class="project-image-wrapper">
            	 		
            	 		<?php  echo $media['AUDIO']; ?>

            	 	</div>

<!--            	 	<div class="project-profile">

            	 		<label>"Here is a photo of me at a festival"</label>

            	 	</div>-->

            	 </div>

            </div>   	

        </div><!-- Right Block Ends -->

    </div>


<!-- Add Image Modal -->
<?php

$user_id = Yii::app()->user->getId();
?>

    <div class="modal fade" id="addimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h1 class="upload-head">Add Image</h1>
          </div>
          <div class="modal-body">
            <form class="" action="/profile/media/id/<?php echo $user_id ?>"  method="POST" > 
              <div class="form-group fundstep2-formgroup">                
                <input  class="form-control charcount col-md-12" name="file_image"  type="text" value=""  placeholder='Image link here....'>
              </div>
                <div><br/><br/><br/></div>
              <input type="submit"  class="nextbtn" value='Save'/>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Video Modal -->

    <div class="modal fade" id="addvideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h1 class="upload-head">Add Video</h1>
          </div>
          <div class="modal-body">
            <form class="" action="/profile/media/id/<?php echo $user_id ?>"  method="POST"> 
              <div class="form-group fundstep2-formgroup">                
                
                <textarea class="form-control charcount col-md-12" name="file_video"  placeholder='Video embed code here....'></textarea>
              </div>
                <div><br/><br/><br/></div>
              <input type="submit"  class="nextbtn" value='Save'/>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Audio Modal -->

    <div class="modal fade" id="addaudio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h1 class="upload-head">Add Audio</h1>
          </div>
          <div class="modal-body">
            <form class="" action="/profile/media/id/<?php echo $user_id ?>" method="POST"> 
              <div class="form-group fundstep2-formgroup">                
                
                <textarea class="form-control charcount col-md-12" name="file_audio"  placeholder='Audio embed code here....' ></textarea>
              </div>
                <div><br/><br/><br/></div>
              <input type="submit"  class="nextbtn" value='Save'/>
            </form>
          </div>
        </div>
      </div>
    </div>
<style>
    .col-md-12 iframe{
        width: 100%;
        
    }
 </style>