 <div class="row">

            <div class="col-md-6"><!-- Left Block -->

            	<div class="row">

            	 <div class="col-md-12 profile-blocks">

            	 	<div class="project-image-wrapper">
            	 		
            	 		<img src="/img/gaga.jpg" class="img-responsive" />

                        <div class="edit-profile-image">
                            <a class="edit-profile-link" href="#">Edit<br> Profile image</a>
                        </div>

            	 	</div>

            	 	<div class="project-container">

            	 		<h2 class="project-title project-tedit">Lady Gaga</h2>

            			<a href="#" class="edit-desc">Edit Description</a>

        				<div class="project-location-block">								
    						<i class="icon-location"></i>
    						<span class="project-location">London UK</span>    						
    					</div>

    					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>

            	 	</div>

            	</div>            	

               </div>

            </div><!-- Left Block Ends -->

            <div class="col-md-6"><!--Right block -->

            	<div class="row">

            	 <div class="col-md-12 profile-blocks">

            	 	<div class="edit-dashboard-wrapper">

            	 		<div class="dash-head-wrap">

    			        	<div class="col-md-9">
    			        		<h2 class="dash-heading color-black">Edit Profile</h2>
    			        	</div> 

    			        	<div class="col-md-3">
    			        		<button type="button" class="btn btn-primary btn-lg btn-block savebutton profilesave">Save</button>
    			        	</div>      	

    		        	</div>
            	 		
                        <form class="" role="form">                             

                            <div class="profileLinkWrap col-md-4">
                                <div class="form-group global-textbox">
                                    <label for="dob">Location</label>
                                    <input type="text" class="form-control" id="location">
                                </div>
                            </div>

                            <div class="profileLinkWrap col-md-4">
                                <label for="dob">Date of Birth</label>
                                <div class="form-group global-textbox">
                                    <input name="dateodbirth" id="date-picker" class="date-pick form-control"/>
                                </div>
                            </div>

                            <div class="profileLinkWrap col-md-4">
                                <div class="form-group global-textbox">
                                    <label for="gender">Gender</label>
                                    <select class="gender-dropdown">
                                        <option value="0">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                            
                                <h4 class="article-inner-title">Links to your websites and main pages </h4>

                                <p>Place the url of your main website about you or your group</p>

                                <div class="form-group global-textbox">
                                    <input type="text" maxlength="50" class="form-control charcount" id="title-input">
                                </div>

                            </div>
                                
                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="facebook">Facebook page</label>
                                    <input type="text" class="form-control" id="facebook">
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="soundcloud">Soundcloud page</label>
                                    <input type="text" class="form-control" id="soundcloud">
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                                                            
                                <div class="form-group global-textbox">
                                    <label for="twitter">Twitter page</label>
                                    <input type="text" class="form-control" id="twitter">
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="bandcamp">Bandcamp page</label>
                                    <input type="text" class="form-control" id="bandcamp">
                                </div>

                            </div>  

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="youtube">Youtube page</label>
                                    <input type="text" class="form-control" id="youtube">
                                </div>

                            </div>                                      

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="myspace">Myspace page</label>
                                    <input type="text" class="form-control" id="myspace">
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="vimeo">Vimeo page</label>
                                    <input type="text" class="form-control" id="vimeo">
                                </div>

                            </div>  

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="linkedin">Linkedin page</label>
                                    <input type="text" class="form-control" id="linkedin">
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-12">

                                <h4 class="article-inner-title article-inner-fix">Change Password</h4>

                                <p>Password needs to be atleast 8 characters long</p>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="linkedin">New password</label>
                                    <input type="text" class="form-control" id="linkedin">
                                </div>

                                <div class="form-group global-textbox">
                                    <label for="linkedin">Confirm password</label>
                                    <input type="text" class="form-control" id="linkedin">
                                </div>

                            </div>

                        </form>
    	        	 	

            	 	</div>

            	 </div> 

            </div>   	

        </div><!-- Right Block Ends -->

    </div>


<script type="text/javascript" src="/js/date.js"></script>
    <script type="text/javascript" src="/js/jquery.datePicker.js"></script>
    
    
    
    <?php 
    
    $js = <<< EOD
   $(document).ready(function() {
        $('.date-pick').datePicker().val(new Date().asString()).trigger('change');
         
        });
EOD;
    
Yii::app()->clientScript->registerScript('id', $js);
    ?>