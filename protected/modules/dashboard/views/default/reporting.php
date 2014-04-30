
<section class="site-min-height">
    <h1 class="dash-header">Reporting</h1>
    <!--FIRST ROW-->
    <div class="row">
                  <div class="col-lg-4">
                      <section class="panel">
                          <div class="panel-body">
                              <h1>£ <?php  echo $reportData['TOTAL_RAISED'] ;  ?></h1>
                              
                          </div>
                          <div><footer class="pie-foot">TOTAL RAISED</footer></div>
                      </section>
                  </div>
                  <div class="col-lg-4">
                      <section class="panel">
                          <div class="panel-body"><h1><?php  echo $reportData['SUCCESSFULLY_FUNDED_CAMPAIGNS'] ;  ?>
</h1>
                              </div>
                          <div><footer class="pie-foot">SUCCESSFULLY FUNDED CAMPAIGNS
</footer></div>
                      </section>
                  </div>
                  <div class="col-lg-4">
                      <section class="panel">
                          <div class="panel-body"><h1><?php  echo $reportData['CAMPAIGNS_LOVED'] ;  ?>
</h1>
                              </div>
                          <div><footer class="pie-foot">CAMPAIGNS LOVED
</footer></div>
                      </section>
                  </div>
              </div>
    
    <!--SECOND ROW-->
    <div class="row">
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body">
                              <h3><?php  echo $reportData['TOTAL_BACKERS'] ;  ?>
</h3>
                             
                          </div> <div><footer class="well weather-bg"><p>TOTAL BACKERS </p>
</footer></div>
                      </section>
                      
                  </div>
        
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['REPEAT_BACKERS'] ;  ?>
</h3>
                              </div><div><footer class="well weather-bg">REPEAT BACKERS 
</footer></div>
                      </section>
                  </div>
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['TOTAL_PLEDGES'] ;  ?> 
</h3>
                              </div><div><footer class="well weather-bg">TOTALPLEDGES 
</footer></div>
                      </section>
                  </div>
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body">
                              <h3>£ <?php  echo (int)$reportData['AVERAGE_PLEDGE_VALUE'] ;  ?></h3>
                              </div><div><footer class="well weather-bg">AVERAGE PLEDGE VALUE</footer></div>
                      </section>
                  </div>
              </div>
    
    <!--CHART ROW-->
   <div class="row">
                  <div class="col-lg-6">
                      <div class="row">
                          <div class="col-xs-6">
                              <section class="panel">
                                  <div class="panel-body">
                                      <div id='SUCCESS_FUND_RATE'></div>
                                  </div>
                              </section>
                          </div>
                          <div class="col-xs-6">
                              <section class="panel">
                                  <div class="panel-body"> <div id='FIXED_VS_FLEXIBLE'></div></div>
                              </section>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <section class="panel">
                          <div class="panel-body"><div class="row">
                  <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['TOTAL_LAUNCHED'] ;  ?>
</h3>
                              <div><footer class="h5">Total Launched 
</footer></div></div>
                      </section>
                  </div>
                  <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['UNSUCCESSFUL'] ;  ?>
</h3>
                              <div><footer class="h5">Unsuccessful 
</footer></div></div>
                      </section>
                  </div>
                  <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['DRAFT'] ;  ?>
</h3>
                              <div><footer class="h5">Draft 
</footer></div></div>
                      </section>
                  </div>
                  <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['FIXED'] ;  ?>
</h3>
                              <div><footer class="h5">Fixed 
</footer></div></div>
                      </section>
                  </div>
                  <div class="col-lg-4">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['FLEXIBLE'] ;  ?>
</h3>
                              <div><footer class="h5">Flexible
</footer></div></div>
                      </section>
                  </div>
                                  
                 
              </div>
                              
                              <div class="row">
                                  
                                  
                                   <div class="col-lg-4">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['NO_OF_MEMBERS'] ;  ?>
</h3>
                              <div><footer class="h5">No of Members
</footer></div></div>
                      </section>
                  </div>
                  <div class="col-lg-4">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['ACTIVE_MEMBERS'] ;  ?>
</h3>
                              <div><footer class="h5">Active Members
                              </footer></div><small>(last 6 months login)
</small></div>
                      </section>
                  </div>
                  
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body"><h3><?php  echo $reportData['NO_OF_ABANDONED_CART'] ;  ?></h3>
                              <div><footer class="h5">No of Abandoned cart
</footer></div></div>
                      </section>
                  </div>

              </div>
                          </div>
                      </section>
                  </div>
              </div> 
    
    <!--TABLE ROW-->
    <div class="row">
                  <div class="col-lg-4">
                      <section class="panel">
                          <div class="panel-body"><section class="panel">
                          <header class="panel-heading">
                              MOST FUNDED PROJECTS
                          </header>
                          <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['MOST_FUNDED_PROJECTS'],
                                             'itemsCssClass' => 'table table-striped table-bordered',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'PROJECT','type' => 'raw','value' => '($data["project"])' ),
                                            array('name' => 'FUNDED','type' => 'raw','value' => '($data["funded"])' ),
                                            ),
                                    ));
                             ?>
                      </section></div>
                      </section>
                  </div>
                  <div class="col-lg-4">
                      <section class="panel">
                          <div class="panel-body"><section class="panel">
                          <header class="panel-heading">
                              MOST FUNDED CATEGORIES
                          </header>
                         <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['MOST_FUNDED_CATEGORIES'],
                                             'itemsCssClass' => 'table table-striped table-bordered',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'CATEGORY','type' => 'raw','value' => '($data["category"])' ),
                                            array('name' => 'FUNDED','type' => 'raw','value' => '($data["funded"])' ),
                                            ),
                                    ));
                             ?>
                      </section></div>
                      </section>
                  </div>
                  <div class="col-lg-4">
                      <section class="panel">
                          <div class="panel-body"><section class="panel">
                          <header class="panel-heading">
                             MOST POPULAR REWARD TYPES
                          </header>
                         <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['MOST_POPULAR_REWARD_TYPES'],
                                             'itemsCssClass' => 'table table-striped table-bordered',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'REWARD TYPE','type' => 'raw','value' => '($data["reward_type"])' ),
                                            array('name' => 'FUNDED','type' => 'raw','value' => '($data["funded"])' ),
                                            ),
                                    ));
                             ?>
                      </section></div>
                      </section>
                  </div>
        
        
              </div>
    
    <!--SECOND TABLE ROW-->
    <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <div class="panel-body"><section class="panel">
                          <header class="panel-heading">
                            TOP PROJECT LOCATIONS
                          </header>
                         <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['TOP_PROJECT_LOCATIONS'],
                                             'itemsCssClass' => 'table table-striped table-bordered TOP_PROJECT_LOCATIONS',
                             'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'LOCATION','type' => 'raw','value' => '($data["city"])' ),
                                            array('name' => 'TOTAL PROJECTS','type' => 'raw','value' => '($data["locations"])' ),
                                            ),
                                    ));
                             ?>
                      </section></div>
                      </section>
                  </div>
                  <div class="col-lg-6">
                      <section class="panel">
                          <div class="panel-body"><section class="panel">
                          <header class="panel-heading">
                             TOP FUNDING LOCATION
                          </header>
                         <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['TOP_FUNDING_LOCATION'],
                                             'itemsCssClass' => 'table table-striped table-bordered TOP_FUNDING_LOCATION',
                             'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'LOCATION','type' => 'raw','value' => '($data["city"])' ),
                                            array('name' => 'TOTAL FUNDING','type' => 'raw','value' => '($data["funded"])' ),
                                            ),
                                    ));
                             ?>
                      </section></div>
                      </section>
                  </div>
              </div>
    <hr/>
    <!--END CODE-->
    
       <?php
       $js = '
 $(document).ready(function() {
 
$(".TOP_PROJECT_LOCATIONS").dataTable( {});
$(".TOP_FUNDING_LOCATION").dataTable( {});

//morris chart 
Morris.Donut({
  element: "SUCCESS_FUND_RATE",
  data: [    
  {label: "SUCCESS FUND RATE ", value: '.$reportData['SUCCESS_FUND_RATE'].'},
    {label: "NOT SUCCESS FUND RATE", value: '.(100-$reportData['SUCCESS_FUND_RATE']).'},
    
   
  ],
  colors: [
    "#0BA462",
    "#98EEC9",
    
  ],
}).select(0);

Morris.Donut({
  element: "FIXED_VS_FLEXIBLE",
  data: [    
  {label: "FIXED VS FLEXIBLE ", value: '.$reportData['FIXED_VS_FLEXIBLE'].'},
    {label: "TOTAL", value: '.(100-$reportData['FIXED_VS_FLEXIBLE']).'},
    
   
  ],
  colors: [
    "#0BA462",
    "#98EEC9",
    
  ],
}).select(0);



//end jquery dom ready
} );

 
';
    
Yii::app()->clientScript->registerScript('dashboard_projects', $js);

       
       ?>