<?php
/* @var $this DefaultController */

//$this->breadcrumbs=array(
//	$this->module->id,
//);
?>
<style>
    /* Blue Flat Button
==================================================*/
.btn-xlarge{
  position: relative;
  vertical-align: center;
  margin: 10px;
  /*width: 100%;*/
  height: 100x;
  padding: 28px 28px;
  font-size: 22px;
  color: white;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
  background: #050525;
  border: 0;
  border-bottom: 3px solid #9FE8EF;
  cursor: pointer;
  -webkit-box-shadow: inset 0 -3px #9FE8EF;
  box-shadow: inset 0 -3px #9FE8EF;
}
.btn-xlarge:active {
  top: 2px;
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.btn-xlarge:hover {
  background: #45E1E8;
}
.home_dashboard.p{
    word-break: true;
}
</style>
<h1 class="dash-header">Home</h1>
  
  <div class="home_dashboard">
	 
   <div class="row">

      <a class="col-md-4" href="<?php echo Yii::app()->createUrl("/dashboard/reporting") ?>">
        <button href="<?php echo Yii::app()->createUrl("/dashboard/reporting") ?>" class="btn">
          <i class="fa fa-bar-chart-o fa-5x" ></i><br/> 
          <h2>REPORTING</h2>
          <p>An overview of Stereotribes</p>        
        </button>
      </a>
        
      <a class="col-md-4" href="<?php echo Yii::app()->createUrl("/dashboard/users") ?>">
        <button href="<?php echo Yii::app()->createUrl("/dashboard/users") ?>"  class="btn">
          <i class="fa fa-group fa-5x" ></i><br/> 
          <h2>USERS</h2>
          <p>Our funders, creaters & lovers</p>        
        </button>
      </a>
       
      <a class="col-md-4" href="<?php echo Yii::app()->createUrl("/dashboard/projects") ?>">
        <button href="<?php echo Yii::app()->createUrl("/dashboard/projects") ?>" class="btn">
          <i class="fa fa-bookmark fa-5x" ></i><br/> 
          <h2>PROJECTS</h2>
          <p>All ‘Play’ campaign details</p>        
        </button>
      </a>
      
      <a class="col-md-4" href="<?php echo Yii::app()->createUrl("/dashboard/categories") ?>">
        <button href="<?php echo Yii::app()->createUrl("/dashboard/categories") ?>" class="btn">
          <i class="fa fa-bookmark fa-5x" ></i><br/> 
          <h2>CATEGORIES</h2>
          <p>Our categor engagement</p>        
        </button>
      </a>
      
      <a class="col-md-4" href="<?php echo Yii::app()->createUrl("/dashboard/financial") ?>">
        <button href="<?php echo Yii::app()->createUrl("/dashboard/financial") ?>" class="btn">
          <i class="fa fa-bars fa-5x" ></i><br/> 
          <h2>FINANCIAL</h2>
          <p>Stereotribes financial overview</p>        
        </button>
      </a>
      
      <a class="col-md-4" href="<?php echo Yii::app()->createUrl("/dashboard/tribes") ?>">
        <button href="<?php echo Yii::app()->createUrl("/dashboard/tribes") ?>" class="btn">
          <i class="fa fa-sitemap fa-5x" ></i><br/> 
          <h2>TRIBES</h2>
          <p>Group hubs, and group comms</p>        
        </button>
      </a>
<!--                                 <button href="#"  class="btn" /><i class="fa fa-bookmark fa-5x" ></i><br/> 
                      <h2>SUPPORT 
</h2>
                      <p>Customer service
email platform
 </p>        
                    </button>
            </button>
                                 <button href="#"  class="btn" /><i class="fa fa-bookmark fa-5x" ></i><br/> 
                      <h2>SEO
</h2>
                      <p>SEO, metatags,
analytics,
descriptions
 </p>        
                    </button>-->
      <a class="col-md-4" href="#">
        <button href="#" class="btn">
          <i class="fa fa-cog fa-5x" ></i><br/> 
          <h2>SETTINGS</h2>
          <p>Admin settings</p>        
        </button>
      </a>
              
    </div>
</div>