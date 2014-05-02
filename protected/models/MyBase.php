<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class MyBase{
    
    
        
        public function get_featured_block($data){
             $theme_home_folder = Yii::app()->baseUrl;
             $img_base_path = $theme_home_folder.'img/';
                     $desc = substr($data['desc'],0,300).'...';
            $template  = " <div class='brick brickhover large featured all' data-percent='{$data['percent']}%' data-color='#{$data['color']}'>
		    	<div class='brickinner'>
			    	<img src='{$img_base_path}{$data['img']}' alt='' class='img-responsive' />
			    	<div class='fund-block-featured featuredfund'>
			    		
						<div class='fund-featured-count-block'>
							<div class='featured-count'>
								<span class='fund-count'>{$data['percent']}%</span>
								Funded
							</div>
							<div class='fund-notation'></div>							
						</div>
				    	<div class='fund-featured-title-block'>
				    		
							<a href='{$data['url']}' class='fund-featured-title featuredtitle'>{$data['title']}</a>
							<div class='fund-featured-location-block'>
								
								<i class='icon-location'></i>
								<span class='fund-featured-location'>{$data['location']}</span>
							</div>
				    	</div>
				    </div>
			    </div>
			    <div class='mask'>
			    	<a href='#'>
				        <span class='link-spanner'></span>
				    </a>
			   		<div class='maskheaderwrap'>
			   			<h4 class='maskheader'>{$data['category']}</h4>
			   			<span class='bordercut'></span>
			   			<a href='#' class='icon-heart' data-toggle='modal' data-target='#myModal'></a>
			   		</div>
					
	                <div class='fund-featured-title-block'>
			    		
						<span class='fund-featured-title featuredtitle'>{$data['title']}</span>
						<div class='fund-featured-location-block'>							
							<i class='icon-location'></i>
							<span class='fund-featured-location'>{$data['location']}</span><br>
							<span class='fund-featured-author'>by {$data['author']}</span>
						</div>
			    	</div>			
					<p>$desc.</p>  
					<div class='fund-featured-count-block'>
						<div class='featured-count'>
							<span class='fund-count'>{$data['percent']}%</span>
							Funded
						</div>
						<div class='fund-notation notationfix'></div>
					</div>
					<ul class='campain-info-wrap'>
						<li>
							<div>{$data['days']}</div>
							<div>Days left</div>
						</li>
						<li>
							<div>{$data['backers']}</div>
							<div>Backers</div>
						</li>
						<li>
							<div>&pound;{$data['pledge']}</div>
							<div>Pledge</div>
						</li>
						<li>
							<a href='{$data['url']}'>Fund<br> Now</a>
						</li>
					</ul>
	            </div>
		    </div>";
                                                        
                return $template;
                                                        
                                                        
        }
        
        
        public function get_promo_block($data){
              $theme_home_folder = Yii::app()->baseUrl;
             $img_base_path = $theme_home_folder.'img/';
              $desc = substr($data['desc'],0,200).'...';
            $template  = "  <div class='brick promohover large-sm all blogs' data-percent='{$data['percent']}%' data-color='#{$data['color']}'>

		    	<div class='brickinner'>

			    	<img src='{$img_base_path}{$data['img']}' alt=''  class='img-responsive' />

			    	<div class='fund-block-promo'>

			    		<div class='fund-promo-logo-block'>
							<img src='{$img_base_path}{$data['img']}' class='img-responsive'/>
						</div>

				    	<div class='fund-promo-title-block'>				    		
							<h4 class='fund-promo-title'>{$data['title']}</h4>
							<p class='fund-promo-description'>$desc.<a href='{$data['url']}' class='viewnow'>View Now</a></p>
				    	</div>

				    </div>

			    </div>		  	

		    </div>
                                                        ";
                                                        
                return $template;
                                                        
                                                        
        }
        
        
        public function get_normal_block($data){
             $theme_home_folder = Yii::app()->baseUrl;
             $img_base_path = $theme_home_folder.'img/';
             $desc = substr($data['desc'],0,150);
            $template  = "  <div class='brick brickhover medium new all' data-percent='49%' data-color='#{$data['color']}'>
				
				<div class='brickinner'>
		    	<img src='{$img_base_path}{$data['img']}' alt=''  class='img-responsive' />
		    	<div class='fund-block-normal'>
					<div class='fund-normal-count-block'>
						<div class='normal-count'>
							<span class='fund-count'>{$data['percent']}%</span>
							Funded
						</div>
						<div class='fund-notation notationfix'></div>
					</div>
			    	<div class='fund-normal-title-block'>
			    		
						<a href={$data['url']} class='fund-normal-title normaltitle'>{$data['title']}</a>
						<div class='fund-normal-location-block'>
							
							<i class='icon-location'></i>
							<span class='fund-normal-location'>{$data['location']}</span>
						</div>
			    	</div>
			    </div>
			   </div>
			   <div class='mask'>
			   		<a href='#'>
				        <span class='link-spanner'></span>
				    </a>
			   		<div class='maskheaderwrap'>
			   			<h4 class='maskheader'>{$data['category']}</h4>
			   			<span class='bordercut'></span>
			   			<a href='#' class='icon-heart' data-toggle='modal' data-target='#myModal'></a>
			   		</div>
	                <div class='fund-normal-title-block'>
			    		
						<a href='#' class='fund-normal-title normaltitle'>{$data['title']}</a>
						<div class='fund-normal-location-block'>
							
							<i class='icon-location'></i>
							<span class='fund-normal-location'>{$data['location']}</span><br>
							<span class='fund-normal-author'>by {$data['author']}</span>
						</div>
			    	</div>			
					<p>$desc.</p>  
					<div class='fund-normal-count-block'>
						<div class='normal-count'>
							<span class='fund-count'>{$data['percent']}%</span>
							Funded
						</div>
						<div class='fund-notation notationfix'></div>
					</div>
					<ul class='campain-info-wrap'>
						<li>
							<div>{$data['days']}</div>
							<div>Days left</div>
						</li>
						<li>
							<div>{$data['backers']}</div>
							<div>Backers</div>
						</li>
						<li>
							<div>&pound;{$data['pledge']}</div>
							<div>Pledge</div>
						</li>
						<li>
							<a href='{$data['url']}'>Fund<br> Now</a>
						</li>
					</ul>
 
	            </div></div>";
                                                        
                return $template;
                                                        
                                                        
        }
}
?>
