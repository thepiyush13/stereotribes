

<?php
/* @var $this DefaultController */

//$this->breadcrumbs=array(
//	$this->module->id,
//);
?>

<section class="site-min-height">

<h1 class="dash-header">Users</h1>
    <!--FIRST ROW-->
    
    <div class="row">
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h1 class="pane-header"><?php  echo $reportData['TOTAL_MEMBERS'] ;  ?></h1>
                              
                          </div>
                          <div><footer class="pie-foot">TOTAL MEMBERS</footer></div>
                      </section>
                  </div>
        <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h1 class="pane-header"><?php  echo $reportData['ACTIVE_USERS'] ;  ?></h1>
                          </div>
                          <div><footer class="pie-foot">ACTIVE USERS
                                  </footer></div>
                      </section>
                  </div>
        <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h1 class="pane-header"><?php  echo $reportData['PROJECT_CREATORS'] ;  ?></h1>
      
                          </div>
                          <div><footer class="pie-foot">PROJECT CREATORS</footer></div>
                      </section>
                  </div>
        <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h1 class="pane-header"><?php  echo $reportData['FUNDERS'] ;  ?></h1>
      
                          </div>
                          <div><footer class="pie-foot">FUNDERS</footer></div>
                      </section>
                  </div>
        
     </div>
    
    <!--SECOND ROW-->
    <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="fa fa-heart"></i>
                          </div>
                          <div class="value">
                              <h2 class="count"><?php  echo $reportData['USERS_THAT_LOVE_PROJECTS'] ;  ?></h2>
                             
                          </div>
                           <p class="well well-sm">USERS 
THAT LOVE 
PROJECTS 
</p>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol red">
                              <i class="fa fa-asterisk"></i>
                          </div>
                          <div class="value">
                              <h2 class=" count2"><?php  echo $reportData['GHOST_ACCOUNTS'] ;  ?></h2>
                              
                          </div>
                          <p class="well well-sm">GHOST 
ACCOUNTS 
</p>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol yellow">
                              <i class="fa fa-female"></i>
                          </div>
                          <div class="value">
                              <h2 class=" count3"><?php  echo $reportData['FEMALE_USERS'] ;  ?></h2>
                              
                          </div>
                          <p class="well well-sm">FEMALE 
USERS 
</p>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class="fa fa-male"></i>
                          </div>
                          <div class="value">
                              <h2 class=" count4"><?php  echo $reportData['MALE_USERS'] ;  ?></h2>
                             
                          </div>
                           <p class="well well-sm">MALE
USERS
</p>
                      </section>
                  </div>
              </div>
    <!--THIRD ROW-->
    <div class="row">
                 
                  <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>USER AGE BAND
</h1>
                                  
                              </div>
                             
                          </div>
                         <div> <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['AGE_BAND'],
                                             'itemsCssClass' => 'table table-striped table-bordered',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'AGE','type' => 'raw','value' => '($data["ageband"])' ),
                                            array('name' => 'USER NO','type' => 'raw','value' => '($data["count"])' ),
                                            ),
                                    ));
                             ?></div>
                      </section>
                      <!--work progress end-->
                  </div>
        
         <div class="col-lg-4">
                      <!--user info table start-->
                      <section class="panel">
                          <div class="panel-body">
                              <div class="task-progress">
                                  <h1>USER ACTIVITY
</h1>        
                              </div>
                              
                          </div>
                         <div> <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['USER_ACTIVITY'],
                                             'itemsCssClass' => 'table table-striped table-bordered',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'REWARD TYPE','type' => 'raw','value' => '($data["Activityband"])' ),
                                            array('name' => 'FUNDED','type' => 'raw','value' => '($data["count"])' ),
                                            ),
                                    ));
                             ?></div>
                      </section>
                      <!--user info table end-->
                       <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <div class="panel-body"><h3>   <?php  
                          if(isset($reportData['2_LAUNCHED_PROJECTS']) && $reportData['2_LAUNCHED_PROJECTS']!='') 
                             echo  $reportData['2_LAUNCHED_PROJECTS'];
                          else {
                              echo '0';
                             }  ;
                                  ?></h3><p>NO. OF USERS 
WITH 2 OR MORE 
LAUNCHED 
PROJECTS 
</p></div>
                      </section>
                  </div>
                  <div class="col-lg-6">
                      <section class="panel">
                          <div class="panel-body"><h3>
                              <?php  
                          if(isset($reportData['2_SUCCESS_PROJECTS']) && $reportData['2_SUCCESS_PROJECTS']!='') 
                             echo  $reportData['2_SUCCESS_PROJECTS'];
                          else {
                              echo '0';
                             }  ;
                                  ?>
                              </h3><p>NO. OF USERS
WITH 2 OR MORE
SUCCESSFUL FIXED
PROJECTS
</p></div>
                      </section>
                  </div>
              </div>
        
              </div>
                  </div>
       
    
    <!--FOURTH ROW-->
     <div class="row">
                 
                  <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>TOP 5 USERS WITH THE MOST SUCCESSFUL NO. OF PROJECTS
</h1>
                              </div>
                              
                          </div>
                          <div> <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['TOP_5_PROJECT_USERS'],
                                             'itemsCssClass' => 'table table-striped table-bordered',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'NAME TYPE','type' => 'raw','value' => '($data["name"])' ),
                                            array('name' => 'EMAIL','type' => 'raw','value' => '($data["email"])' ),
                                                 array('name' => 'PROJECT NO','type' => 'raw','value' => '($data["count"])' ),
                                            ),
                                    ));
                             ?></div>
                      </section>
                      <!--work progress end-->
                  </div>
        
         <div class="col-lg-4">
                      <!--user info table start-->
                      <section class="panel">
                          <div class="panel-body">
                              
                              <div class="task-progress">
                                  <h1>MOST ACTIVE USERS (MOST LOG INS)
</h1>
                                 
                              </div>
                          </div>
                     <div> <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['MOST_ACTIVE_USERS'],
                                             'itemsCssClass' => 'table table-striped table-bordered table-responsive',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'NAME','type' => 'raw','value' => '($data["name"])' ),
                                            
                         array('name' => 'LAST LOGIN','type' => 'raw','value' => 'Yii::app()->dateFormatter->format("d MMM y hh:mm a",strtotime($data["last_login"]))' ),
                                            ),
                                    ));
                             ?></div>
                      </section>
                      <!--user info table end-->
                      
        
              </div>
                  </div>
    
    
    <!--FIFTH ROW-->
     <div class="row">
                 
                  <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>TOP 5 USERS WHO FUNDED THE MOST
</h1>
                                  
                              </div>
                            
                          </div>
                         <div> <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['TOP_5_FUNDED_USERS'],
                                             'itemsCssClass' => 'table table-striped table-bordered',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                             array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'NAME','type' => 'raw','value' => '($data["name"])' ),
                                            array('name' => 'FUNDED PROJECTS','type' => 'raw','value' => '($data["projects"])' ),
                                                 array('name' => 'FUNDED £','type' => 'raw','value' => '($data["amount"])' ),
                                            ),
                                    ));
                             ?></div>
                      </section>
                      <!--work progress end-->
                  </div>
        
         <div class="col-lg-4">
                      <!--user info table start-->
                      <section class="panel">
                           <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>FUNDERS VS CREATORS VS LOVERS

</h1>
                                  
                              </div>
                            
                          </div>
                          <div class="custom-bar-chart">
                          <ul class="y-axis">
                             
                          </ul>
                          <div class="bar col-lg-4" style="width:25%;">
                              <div class="title">FUNDERS</div>
                              <div class="value tooltips col-lg-12" data-original-title="<?php  echo $reportData['FUNDERS_PERCENT']  ?>%" data-toggle="tooltip" data-placement="top" style="height: <?php  echo $reportData['FUNDERS_PERCENT']  ?>%;width:100%;background: #FF6C60;">
                              <div class="tooltip fade top in" style="">
                                  <div class="tooltip-arrow"></div>
                                  <div class="tooltip-inner"><?php  echo $reportData['FUNDERS']  ?></div>
                              </div>
                              </div>
                              
                          </div>
                          <div class="bar  col-lg-4" style="width:25%;">
                              <div class="title">CREATORS</div>
                              <div class="value tooltips col-lg-12" data-original-title="<?php  echo $reportData['CREATORS_PERCENT']  ?>%" data-toggle="tooltip" data-placement="top" style="height: <?php  echo $reportData['CREATORS_PERCENT']  ?>%;background: #FF6C60;">
                              <div class="tooltip fade top in" style="">
                                  <div class="tooltip-arrow"></div>
                                  <div class="tooltip-inner"><?php  echo $reportData['CREATORS']  ?></div>
                              </div>
                              </div>
                          </div>
                          <div class="bar  col-lg-4" style="width:25%;">
                              <div class="title">LOVERS</div>
                              <div class="value tooltips col-lg-12" data-original-title="<?php  echo $reportData['LOVERS_PERCENT']  ?>%" data-toggle="tooltip" data-placement="top" style="height: <?php  echo $reportData['LOVERS_PERCENT']  ?>%;background: #FF6C60;">
                              <div class="tooltip fade top in" style="">
                                  <div class="tooltip-arrow"></div>
                                  <div class="tooltip-inner"><?php  echo $reportData['LOVERS']  ?></div>
                              </div>
                              </div>
                          </div>
                          
                      </div>
                      </section>
                      <!--user info table end-->
                      
        
              </div>
                  </div
    
    <!--SIXTH ROW-->
    <div class="row">
                 
                  <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>NO. OF USERS BY LOCATION (FROM HIGHEST TO LOWEST):
</h1>
                      
                              </div>
                            
                          </div>
                          <div> <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['USERS_BY_LOCATION'],
                                             'itemsCssClass' => 'table table-striped table-bordered USERS_BY_LOCATION',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'NO OF USERS','type' => 'raw','value' => '($data["count"])' ),
                                            array('name' => 'CITY','type' => 'raw','value' => '($data["location"])' ),
                                            ),
                                    ));
                             ?></div>
                      </section>
                      <!--work progress end-->
                  </div>
        
         <div class="col-lg-4">
                      <!--user info table start-->
                      <section class="panel">
                              
                              <div class="panel-body">
                                 <div id="USER_LOCATIONS"></div>
                              </div>
                          </section>
                      <!--user info table end-->
                      
        
              </div>
    </div>
    
    <!--SEVETH ROW-->
    
    
    <!--EIGHTH ROW-->
    
    <hr/>
    <!--END CODE-->
    
       <?php
//       echo json_encode($reportData['USERS_BY_LOCATION']->getData());
       $js = '
 $(document).ready(function() {
 
$(".USERS_BY_LOCATION").dataTable( {});
Morris.Bar({
  element: "USER_LOCATIONS",
  data:'.json_encode($reportData['USERS_BY_LOCATION']->getData()).',
  xkey: "location",
  ykeys: ["count"],
  labels: ["Series A"]

});

//end jquery dom ready
} );

 
';
    
Yii::app()->clientScript->registerScript('dashboard_projects', $js);

       
       ?>