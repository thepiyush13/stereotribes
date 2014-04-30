<?php
/* @var $this DefaultController */

//$this->breadcrumbs=array(
//	$this->module->id,
//);
?>

<h1 class="dash-header">Home</h1>
  
  <div class="home_dashboard">
	 
   <div class="row">

      <div class="col-md-4">
        <a href="<?php echo Yii::app()->createUrl("/dashboard/reporting") ?>">
          <button class="btn btn-xlarge">
            <i class="fa fa-bar-chart-o fa-5x" ></i><br/> 
            <h2>REPORTING</h2>
            <p>An overview of Stereotribes</p>        
          </button>
        </a>
      </div>
      
      <div class="col-md-4"> 
        <a href="<?php echo Yii::app()->createUrl("/dashboard/users") ?>">
          <button class="btn btn-xlarge">
            <i class="fa fa-group fa-5x" ></i><br/> 
            <h2>USERS</h2>
            <p>Our funders, creaters & lovers</p>        
          </button>
        </a>
      </div>

      <div class="col-md-4">
        <a href="<?php echo Yii::app()->createUrl("/dashboard/projects") ?>">
          <button class="btn btn-xlarge">
            <i class="fa fa-bookmark fa-5x" ></i><br/> 
            <h2>PROJECTS</h2>
            <p>All ‘Play’ campaign details</p>        
          </button>
        </a>
      </div>

      <div class="col-md-4">
        <a href="<?php echo Yii::app()->createUrl("/dashboard/categories") ?>">
          <button class="btn btn-xlarge">
            <i class="fa fa-bookmark fa-5x" ></i><br/> 
            <h2>CATEGORIES</h2>
            <p>Our categor engagement</p>        
          </button>
        </a>
      </div>

      <div class="col-md-4">
        <a href="<?php echo Yii::app()->createUrl("/dashboard/financial") ?>">
          <button class="btn btn-xlarge">
            <i class="fa fa-bars fa-5x" ></i><br/> 
            <h2>FINANCIAL</h2>
            <p>Stereotribes financial overview</p>        
          </button>
        </a>
      </div>

      <div class="col-md-4">
        <a href="<?php echo Yii::app()->createUrl("/dashboard/tribes") ?>">
          <button class="btn btn-xlarge">
            <i class="fa fa-sitemap fa-5x" ></i><br/> 
            <h2>TRIBES</h2>
            <p>Group hubs, and group comms</p>        
          </button>
        </a>
      </div>

<!-- <button href="#"  class="btn btn-xlarge" /><i class="fa fa-bookmark fa-5x" ></i><br/> 
                      <h2>SUPPORT 
</h2>
                      <p>Customer service
email platform
 </p>        
                    </button>
            </button>
                                 <button href="#"  class="btn btn-xlarge" /><i class="fa fa-bookmark fa-5x" ></i><br/> 
                      <h2>SEO
</h2>
                      <p>SEO, metatags,
analytics,
descriptions
 </p>        
                    </button>-->

      <div class="col-md-4">
        <a href="#">
          <button class="btn btn-xlarge">
            <i class="fa fa-cog fa-5x" ></i><br/> 
            <h2>SETTINGS</h2>
            <p>Admin settings</p>        
          </button>
        </a>
      </div>         
    
    </div>

</div>