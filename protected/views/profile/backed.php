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
	        		<a class="dash-menu-links dash-active" href="<?php  echo $data['links']['backed']; ?>"><?php  echo $data['backed']; ?><span>Backed</span></a>
	        	</div>

	        	<div class="col-md-3">
	        		<a class="dash-menu-links" href="<?php  echo $data['links']['created']; ?>"><?php  echo $data['created']; ?><span>Created</span></a> 
	        	</div>

	        	<div class="col-md-3">
	        		<a class="dash-menu-links" href="<?php  echo $data['links']['comments']; ?>"><?php  echo $data['comments']; ?><span>Comments</span></a>
	        	</div>

	        	<div class="col-md-3">
		        	<a class="dash-menu-links" href="<?php  echo $data['links']['loved']; ?>"><?php  echo $data['loved']; ?><span>Loved</span></a>
		        </div>

	        </section> 

	    </div>

	        <section class="dash-content-wrapper">

	        	<ul class="dash-list">
                            <?php foreach($data['backed_projects'] as $key=>$project) { ?>
	        		<li> <!-- List block Start -->
	        			<div class="dash-thumbnail">
	        				<img src="/img/<?php  echo $project['image_url']; ?>" class="img-responsive" />
	        			</div>
	        			<div class="dash-content">
	        				<a href="/campaign/<?php  echo $project['id']; ?>" class="dash-content-heading"><?php  echo $project['title']; ?></a>
	        				<p><?php  echo $project['short_summary']; ?></p>
	        			</div>
	        			<div class="dash-buttonwrap">
                                            <?php  
                                           if($data['user_autorized']){
                                            if($project['visible']==1){ ?>
                                                <a href='<?php  echo $this->createUrl("hide?id={$project['order_id']}&status=0") ?>' class="dash-public hide-public">Hide from public view</a>
                                            <?php }
                                            else{ ?>
                                                <a href='<?php  echo $this->createUrl("hide?id={$project['order_id']}&status=1") ?>' class="dash-public hide-public">Unhide from public view</a>
                                           <?php  }   }?>
                            
		        			<div class="fund-normal-count-block" style="background-color: #<?php  echo $data['category_color'][$project['category']]; ?>;">
								<div class="normal-count">
									<span class="fund-count"><?php  echo $project['percent_funded']; ?>%</span>
									Funded
								</div>
								<div class="fund-notation notationfix" style="width: <?php  echo $project['percent_funded']; ?>%; background-color: rgb(135, 5, 91);"></div>							
							</div>
							<div class="col-md-12 savewrapper">
								<a href="/campaign/<?php  echo $project['id']; ?>" ><button type="button" class="btn btn-primary btn-lg btn-block amplifybutton">
									<span class="amp-text">Amplify<br> Project</span>
									<span class="amp-icon"></span>
								</button> </a>
							</div>
	        			</div>
	        		</li> <!-- List block Ends -->

                            <?php  } ?>
	        	</ul>

<!--		        <ul class="pagination pagination-sm">
				  <li><a href="#">&laquo;</a></li>
				  <li><a href="#">1</a></li>
				  <li><a href="#">2</a></li>
				  <li><a href="#">3</a></li>
				  <li><a href="#">4</a></li>
				  <li><a href="#">5</a></li>
				  <li><a href="#">&raquo;</a></li>
				</ul>	        	-->

	    	</section>


<?PHP  
$js = <<< EOD
  $(document).ready(function() {
          //js code here 
        $('.hide-public').click(function(){
        var url = $(this).attr('href');
             $.get( url, function( data ) {
                      if(data){
        $(this).addClass('hide');
                          }
        else{
        $(this).addClass('show');
            }
});
   });
        
       
        });
EOD;
    
Yii::app()->clientScript->registerScript('id', $js);
?>
