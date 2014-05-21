<!--MODEL-->

<div class="modal fade"  id='pages-view-modal'  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">View Pages</h4>
      </div>
      <div class="modal-body">
        <div id="pages-view-modal-container">
	  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<!--END MODEL-->




<script>
function renderView(id)
{
 
 var data="id="+id;

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("/pages/manage/view"); ?>',
   data:data,
success:function(data){
                 $('#pages-view-modal-container').html(data); 
                 $('#pages-view-modal').modal('show');
              },
   error: function(data) { // if error occured
//           alert(JSON.stringify(data)); 
//         alert("Error occured.please try again");
    },

  dataType:'html'
  });

}
</script>