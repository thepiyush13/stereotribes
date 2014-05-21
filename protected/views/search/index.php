<!-- ==================== Video Section ====================== -->

	 <?php  
    $theme_home_folder = Yii::app()->baseUrl;
    ?>
<div class='well well-sm'>
    <h1>Search Results : <h2><?php echo ucfirst($data['type']) ?> :<?php echo $data['keyword'] ?>  </h2></h1>
    
    
</div>
	<div class="main-wrapper">

		<!-- ==================== Secondary Navigation ====================== -->

	  

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
                         
                         <input type="hidden" id='keyword' value='<?php echo $data['keyword'] ?>'/>
                         <input type="hidden" id='type' value='<?php echo $data['type'] ?>'/>
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
        <script src="/js/search.js"></script>