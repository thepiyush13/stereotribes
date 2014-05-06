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
	        		<a class="dash-menu-links  dash-active" href="<?php  echo $data['links']['comments']; ?>"><?php  echo $data['comments']; ?><span>Comments</span></a>
	        	</div>

	        	<div class="col-md-3">
		        	<a class="dash-menu-links " href="<?php  echo $data['links']['loved']; ?>"><?php  echo $data['loved']; ?><span>Loved</span></a>
		        </div>

	        </section> 

	    </div>

	
	        <section class="dash-comments-wrapper">
	        	 <?php foreach($data['project_comments'] as $key=>$comment) { ?>
	        	<div class="col-md-6">

	        		<div class="dash-comments-block">

	        			<div class="dash-comment-inner">

                                            <a href="#" class="dash-content-heading"><?php  echo substr($comment['message'], 0, 100); ?></a>

		        			<p><?php  echo $comment['message']; ?></p>
		        			
		        			<h4 class="comment-author-wrap"><span class="comment-author"><?php  echo $data['user_details'][0]['name']; ?></span> commented on</h4>
		        			<h4 class="comment-project-name"><?php  echo $comment['title']; ?></h4>
		        			<span class="comment-date"><label>Date:  </label> <?php 
                                                echo Yii::app()->dateFormatter->format("dd MMM yyyy", $comment['createDate']); ?></span>

	        			</div>
<?php if($data['user_autorized']){ ?>
	        			<a href='<?php  echo $this->createUrl("delcomment?id={$comment['commentId']}") ?>' class="comment-delete"><i class="icon-remove"></i>Delete Comment</a>
                         <?php  } ?>

	        		</div>



	        	</div>
                         <?php  } ?>
	        	

	        </section>   