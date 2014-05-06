<?php // print_r($data) ?>
<div class="row dash-head-wrap">

        	<div class="col-md-10 dash-author-wrap">
        		<div class="author-thumb">
        			<img src="/img/dp.jpg" class="img-responsive" />
        		</div>
        		<h2 class="dash-heading"><?php  echo $data['user_details'][0]['name']; ?> Dashboard</h2>
        	</div> 

        	<div class="col-md-2">
        		<h3 class="dash-edit"><a href="<?php  echo $data['links']['edit']; ?>" class="text-right"><i class="icon-edit"></i> Edit Profile</a></h3>
        	</div>      	

        </div>

       <div class="row">

        	<section class="dash-menubar">

	        	<div class="col-md-3">
	        		<a class="dash-menu-links" href="<?php  echo $data['links']['backed']; ?>"><?php  echo $data['backed']; ?><span>Backed</span></a>
	        	</div>

	        	<div class="col-md-3">
	        		<a class="dash-menu-links" href="<?php  echo $data['links']['created']; ?>"><?php  echo $data['created']; ?><span>Created</span></a> 
	        	</div>

	        	<div class="col-md-3">
	        		<a class="dash-menu-links" href="<?php  echo $data['links']['comments']; ?>"><?php  echo $data['comments']; ?><span>Comments</span></a>
	        	</div>

	        	<div class="col-md-3">
		        	<a class="dash-menu-links   dash-active" href="<?php  echo $data['links']['loved']; ?>"><?php  echo $data['loved']; ?><span>Loved</span></a>
		        </div>

	        </section> 

	    </div>

	        <section class="dash-loved-wrapper">

	        	<div class="project-love"></div>
	        	
	        	<div class="col-md-12">
	        		<div class="form-group">
					    <input type="text" class="form-control loved-search" id="search-criteria" placeholder="Search Loved Projects..."><input type="button" id="search" class="btn btn-primary" value="search"/><input type="button" id="reset" value="reset" class="btn btn-default"/>
					</div>
	        	</div>

	        	<div class="dash-loved-inner">
	        		  <?php foreach($data['loved_projects'] as $key=>$project) { ?>
	        		<div class="col-md-4 searchable"><!-- Loved Block -->

	        			<div class="dash-loved">
	        				
	        				<h1 class="loved-heading">I love this Tribe...</h1>

	        				<div class="brick medium col-md-10 col-md-offset-1">

						    	<div class="brickinner loved-border">
							    	<img src="/img/<?php  echo $project['image_url']; ?>" alt="" class="img-responsive">
									<div class="fund-block-normal fund-block-normal-fix">
										<div class="fund-normal-count-block">
											<div class="normal-count" style="background-color: #<?php  echo $data['category_color'][$project['category']]; ?>;">
												<span class="fund-count"><?php  echo $project['percent_funded']; ?>%</span>
												Funded
											</div>
											<div class="fund-notation notationfix"></div>							
										</div>
								    	<div class="fund-normal-title-block fund-normal-fix">    		
                                                                            <a href="/campaign/<?php  echo $project['id']; ?>" id="fundlive-title" class="fund-normal-title normaltitle"><?php  echo substr($project['title'],0,20); ?></a>
											<div class="fund-normal-location-block">							
												<i class="icon-location"></i>
												<span class="fund-normal-location"><?php  echo $project['city']; ?></span>
											</div>
								    	</div>
								    </div>
							    </div>						    

						    </div>

						    <div class="clearfix"></div>

	        				<div class="love-social">	
<!--		        				<a href="#" class="icons-reply"></a>
		        				<a href="#" class="icons-message"></a>        					
	        					<a href="#" class="icons-heart"></a>-->
	        				</div>

	        			</div>	        			

	        		</div><!-- Loved Block End -->
                                  <?php  }  ?>



	        	</div>

	        	<div class="col-md-12">
		        	<ul class="pagination pagination-sm move-right">
					  <li><a href="#">«</a></li>
					  <li><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
					  <li><a href="#">4</a></li>
					  <li><a href="#">5</a></li>
					  <li><a href="#">»</a></li>
					</ul>
				</div>

	        </section>     	
<!--<script src="/js/jquery.sieve.js"></script>-->
        <?php
        $js = <<< EOD
  $(document).ready(function() {
         $('#search').click(function(){
    $('.searchable').hide();
    var txt = $('#search-criteria').val();
    $('.searchable').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
           $(this).show();
       }
    });
});
                
                 $('#reset').click(function(){
    $('.searchable').hide();
    var txt = '';
    $('.searchable').each(function(){
       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
           $(this).show();
       }
    });
});
                
                
        });
EOD;
    
Yii::app()->clientScript->registerScript('id', $js);
        
        ?>