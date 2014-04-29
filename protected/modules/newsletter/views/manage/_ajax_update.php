<div id="newsletter-update-modal-container" >

</div>

<script type="text/javascript">
function update()
 {
  
  tinyMCE.triggerSave();
   var data=$("#newsletter-update-form").serialize();

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("/newsletter/manage/update"); ?>',
   data:data,
success:function(data){
                if(data!="false")
                 {
                  $('#newsletter-update-modal').modal('hide');
                  renderView(data);
                  $.fn.yiiGridView.update('newsletter-grid', {
                     
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
 
   $('#newsletter-view-modal').modal('hide');
 var data="id="+id;

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("/newsletter/manage/update"); ?>',
   data:data,
success:function(data){
                 // alert("succes:"+data); 
                 $('#newsletter-update-modal-container').html(data); 
                 $('#newsletter-update-modal').modal('show');
                  $('#newsletter-update-modal').bind('shown', function() {                       
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
