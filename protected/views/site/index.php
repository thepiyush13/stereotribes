<!-- ==================== Video Section ====================== -->

	 <?php  
    $theme_home_folder = Yii::app()->baseUrl;
    ?>
    <video id="bgvid" autoplay loop preload="none" poster="<?php echo $theme_home_folder; ?>img/video-poster.jpg" data-setup="{}">
	  <source src="<?php echo $theme_home_folder; ?>videos/st.webm" type="video/webm">
	  <source src="<?php echo $theme_home_folder; ?>videos/st.mp4" type="video/mp4">
      <source src="<?php echo $theme_home_folder; ?>videos/st.ogv" type="video/ogg">
      <source src="<?php echo $theme_home_folder; ?>videos/st.ogg" type="video/ogg">
      <source src="<?php echo $theme_home_folder; ?>videos/st.mov" type="video/mov">
	</video>

	<div class="main-wrapper">

		<!-- ==================== Secondary Navigation ====================== -->

	    <nav id="secondary-nav" class="secondary-nav" role="navigation">

	    	<div class="container">

	    		<div class="col-md-8 col-md-offset-2 text-center">

				    <ul id="sec-navigation" class="navigate">
					    <li id="all" class="active" data-filter=".all">All</li>
					    <li id="new" data-filter=".new">New</li>
					    <li id="featured" class="mobhide" data-filter=".featured">Featured</li>
					    <li id="popular" data-filter=".popular">Popular</li>
					    <li id="endingSoon" data-filter=".endingSoon">Ending Soon</li>
					    <li id="staffPicks" class="mobhide" data-filter=".staffPicks">Staff Picks</li>
				    </ul>

				</div>   

			</div>

		</nav>

		<!-- ==================== Site Contents Section ====================== -->

		<div class="freewall" id="main_grid_content">

		

		</div>
<!--                <div class='text-center'>
                    <input type="button" class="btn btn-large btn-default" id='load_more_blocks' value='Load More'/>
                    <input type="hidden" id='page_number' value='1'/>
                </div>-->
                
		
    <div class="container text-center">
			<button class="add-more" id='load_more_blocks' >Load More</button>
                         <input type="hidden" id='page_number' value='1'/>
		</div> 

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <i class="icon-heart"></i>
		        <h4 class="modal-title" id="myModalLabel">We are glad that you like this project.<br> Log in to save your new tribe.</h4>
		      </div>
		      <div class="modal-body">
		        <form class="form-horizontal" role="form">
		        <label for="inputEmail3" class="control-label">Already a part of our tribe? <strong>Login</strong> here</label>
				  <div class="form-group">				    
				    <div class="col-sm-12">
				      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-12">
				      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-8 col-sm-4 text-right">
				      <button type="submit" class="btn btn-default">Sign in</button>
				    </div>
				  </div>
				</form>

				<form class="form-horizontal" role="form">
				<label for="inputEmail3" class="control-label">New to Stereotribes? <strong>Signup</strong> here</label>
				  <div class="form-group">
				    <div class="col-sm-12">
				      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-12">
				      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-12">
				      <input type="password" class="form-control" id="inputPassword4" placeholder="Re Enter Password">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-8 col-sm-4 text-right">
				      <button type="submit" class="btn btn-default">Sign in</button>
				    </div>
				  </div>
				</form>
		      </div>
		    </div>
		  </div>
		</div>
	
	</div>	

	<!-- ==================== Footer Ends ====================== -->