<div id="pages-update-modal-container" >

</div>

<script type="text/javascript">
function update()
 {
  
  tinyMCE.triggerSave();
   var data=$("#pages-update-form").serialize();

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("/pages/manage/update"); ?>',
   data:data,
success:function(data){
                if(data!="false")
                 {
                  $('#pages-update-modal').modal('hide');
                  renderView(data);
                  $.fn.yiiGridView.update('pages-grid', {
                     
                         });
                 }
                 
              },
   error: function(data) { // if error occured
          alert(JSON.stringify(data)); 

    },

  dataType:'html'
  });

}

function renderUpdateForm(id)
{
 
   $('#pages-view-modal').modal('hide');
 var data="id="+id;

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("/pages/manage/update"); ?>',
   data:data,
success:function(data){
                 // alert("succes:"+data); 
                 $('#pages-update-modal-container').html(data); 
                 $('#pages-update-modal').modal('show');
                  $('#pages-update-modal').bind('shown', function() {                       
                      start_tinymce('update_html_body');
                  });
                 
              },
   error: function(data) { // if error occured
           alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
    },

  dataType:'html'
  });

}
</script>
