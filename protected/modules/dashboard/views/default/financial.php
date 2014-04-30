
<section class="site-min-height">
    <h1 class="dash-header">Financial</h1>
    <!--FIRST ROW-->
    <div class="row">
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h1 class="pane-header">£ <?php  echo $reportData['TOTAL_RAISED'] ;  ?></h1>
                              
                          </div>
                          <div><footer class="pie-foot">TOTAL RAISED</footer></div>
                      </section>
                  </div>
        <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h1 class="pane-header">£ <?php  echo $reportData['STEREOTRIBES_REVENUE'] ;  ?></h1>
                              
                          </div>
                          <div><footer class="pie-foot">STEREOTRIBES REVENUE</footer></div>
                      </section>
                  </div>
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center"><h1 class="pane-header"><?php  echo $reportData['LIVE_FUNDED'] ;  ?>
</h1>
                              </div>
                          <div><footer class="pie-foot">LIVE - FUNDED</footer></div>
                      </section>
                  </div>
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center"><h1 class="pane-header"><?php  echo (int)$reportData['AVG_CAMPAIGN_AMOUNT'] ;  ?></h1>
                              </div>
                          <div><footer class="pie-foot">AVG. CAMPAIGN AMOUNT</footer></div>
                      </section>
                  </div>
              </div>
    
    <!--SECOND ROW-->
    <div class="row block-two">
                  <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body text-center">
                             <h3 class="rep-head">£ <?php  echo $reportData['FIXED_RASIED'] ;  ?></h3>
                             <footer class="well well-sm">FIXED RASIED</footer>
                          </div>
                      </section>
                      
                  </div>
        
                  <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h3 class="rep-head">£ <?php  echo $reportData['FLEXIBLE_RAISED'] ;  ?></h3>
                              <footer class="well h6">FLEXIBLE RAISED</footer>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h3 class="rep-head">£ <?php  echo $reportData['SUCCESSFULLY_RAISED'] ;  ?></h3>
                              <footer class="well ">SUCCESSFULLY RAISED</footer>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h3 class="rep-head">£ <?php  echo (int)$reportData['UNSUCCESSFULLY_RAISED'] ;  ?></h3>
                              <footer class="well ">UNSUCCESSFULLY RAISED</footer>
                          </div>
                      </section>
                  </div>
              <div class="col-lg-3">
                      <section class="panel">
                          <div class="panel-body text-center">
                              <h3 class="rep-head"><?php  echo (int)$reportData['SUCCESS_RATE'] ;  ?>%</h3>
                              <footer class="well ">SUCCESS RATE</footer>
                          </div>
                      </section>
                  </div>
              </div>
    
    <!--CHART ROW-->
   <div class="row">
       
                <div class="col-lg-6">
                    
                    <div class="row">
                        <div class="col-lg-6">
                      <section class="panel">
                          <div class="panel-body">
                              
                              <div class=""><h3><?php  echo $reportData['MONEY_PROJECT'][0]['0-1000'] ;  ?></h3><p>LESS THAN £1000 
</p></div>
                               <div class=""><h3><?php  echo $reportData['MONEY_PROJECT'][0]['1000-10000'] ;  ?></h3><p>£1000-£10,000 
</p></div>
                               <div class=""><h3><?php  echo $reportData['MONEY_PROJECT'][0]['10000-20000'] ;  ?></h3><p>£10,000-£20,000
</p></div>
                                         
                              </div>
                          
                          </div>
                        <div class="col-lg-6">
                      <section class="panel">
                          <div class="panel-body">
                               <div class=""><h3><?php  echo $reportData['MONEY_PROJECT'][0]['20000-100000'] ;  ?></h3><p>£20,000-£100,000 
</p></div>
                               <div class=""><h3><?php  echo $reportData['MONEY_PROJECT'][0]['100000+'] ;  ?></h3><p>£100,000+ 
</p></div>
                               <div class=""><h3><?php  echo (int)$reportData['AVG_PLEDGE_AMOUNT'] ;  ?></h3><p>AVE. PLEDGE AMOUNT
</p></div>
                              
                          </div>
                      </section>
                  </div>
                    </div>
                    
                  
                  
                   </div>
       
             
       <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body">
                               <div class=""><h3><?php  echo $reportData['FEATURED_RAISED'] ;  ?></h3><p>FEATURED RAISED 
</p></div>
                               <div class=""><h3><?php  echo $reportData['FEATURED_CAMPAIGNS'] ;  ?></h3><p>FEATURED CAMPAIGNS 
</p></div>
                               <div class=""><h3><?php  echo $reportData['FEATURED_SUCCESS_RATE'] ;  ?>% MORE</h3><p>FEATURED SUCCESS RATE 
</p></div>
                              </div>
                      </section>
                  </div>
       <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body">
                              <div class=""><h3>2424<?php  echo $reportData['CAMPAIGNS_LOVED'] ;  ?></h3><p>VIDEO OPT IN 
</p></div>
                               <div class=""><h3>2424<?php  echo $reportData['CAMPAIGNS_LOVED'] ;  ?></h3><p>COMPLETED VIDEO 
PROJECTS  
</p></div>
                               <div class=""><h3>2424<?php  echo $reportData['CAMPAIGNS_LOVED'] ;  ?></h3><p>VIDEO SUPPORTED
RAISED
</p></div>
                              </div>
                      </section>
                  </div>
       <div class="col-lg-2">
                      <section class="panel">
                          <div class="panel-body">
                               <div class=""><h3>2424<?php  echo $reportData['CAMPAIGNS_LOVED'] ;  ?></h3><p>MARKETING OPT IN
</p></div>
                               <div class=""><h3>2524<?php  echo $reportData['CAMPAIGNS_LOVED'] ;  ?></h3><p>MARKETING
SUPPORTED RAISED
</p></div>
                               <div class=""><h3>2424<?php  echo $reportData['CAMPAIGNS_LOVED'] ;  ?></h3><p>Desc</p></div>
                              </div>
                      </section>
                  </div>
       
</div>     
              
    
    <!--TABLE ROW-->
    <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <div class="panel-body"><section class="panel">
                          <header class="panel-heading">
                              <div id="RAIED_VS_DATE"></div>
                          </header>
                          
                      </section></div>
                      </section>
                  </div>
                
        
        
              </div>
    
    <!--SECOND TABLE ROW-->
    <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <div class="panel-body">
                          <header class="panel-heading">
                            TOP STEREOTRIBES REVENUE
                          </header>
                         <?php  $this->widget('zii.widgets.grid.CGridView', array(
                                            'dataProvider' => $reportData['TOP_STEREOTRIBES_REVENUE'],
                                             'itemsCssClass' => 'table table-striped table-bordered TOP_STEREOTRIBES_REVENUE',
                                              'summaryText'=>'' ,
                                             'columns' => array(
                                            array( 'header'=>'#','value'=>' ($row+1)'         ),
                                            array('name' => 'PROJECT','type' => 'raw','value' => '($data["project"])' ),
                                            array('name' => 'CATEGORY','type' => 'raw','value' => '($data["category"])' ),
                                                 array('name' => 'LOCATION','type' => 'raw','value' => '($data["location"])' ),
                                                 array('name' => 'FUNDED','type' => 'raw','value' => '($data["funded"])' ),
                                            ),
                                    ));
                             ?>
                      </div>
                      </section>
                  </div>
                 
              </div>
    <hr/>
    <!--END CODE-->
    
       <?php
       $js = '
 $(document).ready(function() {
 
$(".TOP_STEREOTRIBES_REVENUE").dataTable( {});

Morris.Bar({
  element: "RAIED_VS_DATE",
  data:'.json_encode($reportData['RAIED_VS_DATE']).',
  xkey: "date",
  ykeys: ["raised"],
  labels: ["FUND RAIED VS DATE"]

});


//end jquery dom ready
} );

 
';
    
Yii::app()->clientScript->registerScript('dashboard_projects', $js);

       
       ?>