<style>
    .cat{
        font-weight: bolder;
        
    }
    .val{
        /*padding:2px;*/
        border: 1px solid gray;
       
    }
    tr{
         text-align: center;
    }
/*    .table>tbody>tr>th, .table>tbody>tr>td {
    border-top: none;
}*/
</style>


<section class="site-min-height">
<h1 class="dash-header">Categories</h1>
<div class="row">
                  <div class="col-lg-12">
                      <section class="">
                          <header class="panel-heading noborder">MUSIC+ Home MUSIC+ CATEGORIES ORDER FROM MOST TO LEAST FUNDED (TOTAL)</header>
                          <table class="table">
                             
                              <tbody>
                                  
                              <?php  foreach($reportData as $key=>$cat){  ?>
                              <!--UNIT START-->
                              <tr>
                                  <td class="cat-td">
                                    <p class="cat"><?php   echo $cat['name']   ?></p>
                                  </td>                                  
                              </tr> 

                              <tr class="cat-data">
                                  <?php  foreach($cat['data'] as $k=>$cat_data){ ?>
                                  <td>
                                    <p class="val"><?php  echo $cat_data[0]['value']   ?></p>
                                    <p class="text"><?php  echo  $cat_data[0]['field']    ?></p>
                                  </td>
                                  <?php  } ?>
                              </tr>
                              <!--UNIT END-->                          
                              <?php   } ?>
                             
                              </tbody>
                          </table>
                      </section>
                  </div>
              </div>