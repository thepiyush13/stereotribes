<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
     'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
<div class="row">
<?php echo $form->errorSummary($model); ?>



	
    


            <div class="col-md-6"><!-- Left Block -->

            	<div class="row">

            	 <div class="col-md-12 profile-blocks">

            	 	<div class="project-image-wrapper">
            	 		
            	 		<!--<img src="/img/gaga.jpg" class="img-responsive" />-->
                                <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/profile/'.$model->profile_image,"profile_image",array("class"=>'img-responsive')); ?> 

                        <div class="edit-profile-image">
                            <a class="edit-profile-link" href="#" onclick="document.getElementById('upload_profile_image').click(); return false">Edit<br> Profile image</a>
                            <?php  echo $form->fileField($model, 'profile_image',array('id'=>'upload_profile_image','class'=>'hide'));
echo $form->error($model, 'image'); ?>
                        </div>

            	 	</div>

            	 	<div class="project-container">

            	 		<h2 class="project-title project-tedit">Lady Gaga</h2>

            			<!--<a href="#" class="edit-desc">Edit Description</a>-->

        				<div class="project-location-block">								
    						<i class="icon-location"></i>
    						<span class="project-location"><?php  echo $model->location ?></span>    						
    					</div>

    					<p>
                                            <?php echo $form->textArea($model,'description',array('rows'=>16, 'cols'=>85)); ?>
		<?php echo $form->error($model,'description'); ?>
                                        </p>

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
    			        		<!--<button type="button" class="btn btn-primary btn-lg btn-block savebutton profilesave">Save</button>-->
                                                <input type="submit" class="btn btn-primary btn-lg btn-block savebutton profilesave" value='save'>
    			        	</div>      	

    		        	</div>
            	 		
                        <div class="" role="form">                             

                            <div class="profileLinkWrap col-md-4">
                                <div class="form-group global-textbox">
                                    <label for="dob">Location</label>
                                    <?php echo $form->textField($model,'location'); ?>
		<?php echo $form->error($model,'location'); ?>
                                    <!--<input type="text" class="form-control" id="location">-->
                                </div>
                            </div>

                            <div class="profileLinkWrap col-md-4">
                                <label for="dob">Date of Birth</label>
                                <div class="form-group global-textbox">
                                    <?php echo $form->dateField($model,'dob',array('type'=>'date')); ?>
		<?php echo $form->error($model,'dob'); ?>
                                    <!--<input name="dateodbirth" id="date-picker" class="date-pick form-control"/>-->
                                </div>
                            </div>

                            <div class="profileLinkWrap col-md-4">
                                <div class="form-group global-textbox">
                                    <?php // echo $form->textField($model,'gender'); ?>
                                    <?php 
echo $form->dropDownList(
                    $model,
                    'gender', 
                    array('Male'=>'Male','Female'=>'Female')); 
?>
		<?php echo $form->error($model,'gender'); ?>
<!--                                    <label for="gender">Gender</label>
                                    <select class="gender-dropdown">
                                        <option value="0">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>-->
                                </div>
                            </div>

                            <div class="col-md-12">
                                            
                                <h4 class="article-inner-title">Links to your websites and main pages </h4>

                                <p>Place the url of your main website about you or your group</p>

                                <div class="form-group global-textbox">
<!--                                    <input type="text" maxlength="50" class="form-control charcount" id="title-input">-->
                                     <?php echo $form->textField($model,'main_url',array('maxlength'=>"50" ,'class'=>"form-control charcount")); ?>
		<?php echo $form->error($model,'main_url'); ?>
                                </div>

                            </div>
                                
                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="facebook">Facebook page</label>
                                     <?php echo $form->textField($model,'facebook_link',array('maxlength'=>"50" ,'class'=>"form-control charcount")); ?>
		<?php echo $form->error($model,'facebook_link'); ?>
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="soundcloud">Soundcloud page</label>
                                    <?php echo $form->textField($model,'soundcloud_link',array('maxlength'=>"50" ,'class'=>"form-control charcount")); ?>
		<?php echo $form->error($model,'soundcloud_link'); ?>
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                                                            
                                <div class="form-group global-textbox">
                                    <label for="twitter">Twitter page</label>
                                      <?php echo $form->textField($model,'twitter_link',array('maxlength'=>"50" ,'class'=>"form-control charcount")); ?>
		<?php echo $form->error($model,'twitter_link'); ?>
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="bandcamp">Bandcamp page</label>
                                     <?php echo $form->textField($model,'bandcamp_link',array('maxlength'=>"50" ,'class'=>"form-control charcount")); ?>
		<?php echo $form->error($model,'bandcamp_link'); ?>
                                </div>

                            </div>  

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="youtube">Youtube page</label>
                                    <?php echo $form->textField($model,'youtube_link',array('maxlength'=>"50" ,'class'=>"form-control charcount")); ?>
		<?php echo $form->error($model,'youtube_link'); ?>
                                </div>

                            </div>                                      

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="myspace">Myspace page</label>
                                    <?php echo $form->textField($model,'myspace_link',array('maxlength'=>"50" ,'class'=>"form-control charcount")); ?>
		<?php echo $form->error($model,'myspace_link'); ?>
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="vimeo">Vimeo page</label>
                                   <?php echo $form->textField($model,'vimeo_link',array('maxlength'=>"50" ,'class'=>"form-control charcount")); ?>
		<?php echo $form->error($model,'vimeo_link'); ?>
                                </div>

                            </div>  

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="linkedin">Linkedin page</label>
                                   <?php echo $form->textField($model,'linkedin_link',array('maxlength'=>"50" ,'class'=>"form-control charcount")); ?>
		<?php echo $form->error($model,'linkedin_link'); ?>
                                </div>

                            </div>

                            <div class="profileLinkWrap col-md-12">

                                <h4 class="article-inner-title article-inner-fix">Change Password</h4>

                                <p>Password needs to be atleast 8 characters long</p>

                            </div>

                            <div class="profileLinkWrap col-md-6">
                                
                                <div class="form-group global-textbox">
                                    <label for="linkedin">New password</label>
                                    <?php echo $form->passwordField($model,'password',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'password'); ?>
                                    <!--<input type="text" class="form-control" id="linkedin">-->
                                </div>

                                <div class="form-group global-textbox">
                                    <label for="linkedin">Confirm password</label>
                                    <?php echo $form->passwordField($model,'repeat_password',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'password'); ?>
                                    <!--<input type="text" class="form-control" id="linkedin">-->
                                </div>

                            </div>
<!--<input type="submit" class="btn btn-primary btn-lg btn-block savebutton profilesave" value='save'>-->
                            <?php // echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                        </div>
    	        	 	

            	 	</div>

            	 </div> 

            </div>   	
<?php $this->endWidget(); ?>
        </div><!-- Right Block Ends -->

    </div>


<script type="text/javascript" src="/js/date.js"></script>
    <script type="text/javascript" src="/js/jquery.datePicker.js"></script>
    
    
    
    <?php 
    
    $js = <<< EOD
   $(document).ready(function() {
        $('.date-pick').datePicker().val(new Date().asString()).trigger('change');
         $('.edit-profile-link').click(function(){
             $('#Mainuser_profile_image').click();
               })
        });
EOD;
    
Yii::app()->clientScript->registerScript('id', $js);
    ?>