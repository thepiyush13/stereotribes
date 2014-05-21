<!--NEW MODEL-->
<div id='pages-create-modal'  class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create pages</h4>
      </div>
      <div class="modal-body">
        <div class="form">

   <?php
   
         $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pages-create-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'method'=>'post',
        'action'=>array("/pages/manage/create"),
	'type'=>'horizontal',
	'htmlOptions'=>array(
	                        'onsubmit'=>"return false;",/* Disable normal form submit */
                            ),
          'clientOptions'=>array(
                    'validateOnType'=>false,
                    'validateOnSubmit'=>true,
                    'afterValidate'=>'js:function(form, data, hasError) {
                                     if (!hasError)
                                        {    
                                          create();
                                        }
                                     }'
                                    

            ),                  
  
)); ?>
     	<small>Fields with <span class="required">*</span> are required.</small>

	<?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
        		
   <div class="control-group">		
			<div class="span4">
			
							  <div class="row">
					  <?php echo $form->labelEx($model,'subject'); ?>
					  <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>250)); ?>
					  <?php echo $form->error($model,'subject'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'html_body'); ?>
                                                              <?php echo $form->textArea($model,'html_body',array('rows'=>6, 'cols'=>550,'id'=>'create_html_body')); ?>
                                                              <?php // $this->widget('application.extensions.tinymce.ETinyMce', array('name'=>'html_body')); ?>
                                                              <?php
                                                              
//                                                              $this->widget('ext.tinymce.TinyMce', array(
//    'model' => $model,
//    'attribute' => 'html_body',
//     'fileManager' => array(
//        'class' => 'ext.elFinder.TinyMceElFinder',
//        'connectorRoute'=>'/pages/elfinder/connector',
//    ),
//    'htmlOptions' => array(
//        'rows' => 6,
//        'cols' => 160,
//        'id'=>'html_body_create',
//        'field_name'=>'html_body_create'
//    ),
//));
                                                              
                                                              ?>
                                                              <?php  
                                                              
                                                              
                                                              
//                                                                                               $this->widget('application.extensions.cleditor.ECLEditor', array(
//                                                                                'model'=>$model,
//                                                                              'name'=>get_class($model).'[html_body]',
//                                                                                                   'id'=>'html_body',
//                                                                                'options'=>array(
//                                                                                    'width'=>'600',
//                                                                                    'height'=>250,
//                                                                                    'useCSS'=>true,
//                                                                                ),
//
//                                                                            ));
                                                                ?>
					  <?php // echo $form->textArea($model,'html_body',array('rows'=>6, 'cols'=>50)); ?>
					  <?php echo $form->error($model,'html_body'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'url'); ?>
					  <?php echo $form->textField($model,'url',array('rows'=>6, 'cols'=>50)); ?>
					  <?php echo $form->error($model,'url'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'layout'); ?>
					  <?php echo $form->dropDownList($model,'layout', array('A'=>'Layout A','B'=>'Layout B','C'=>'Layout C','D'=>'Layout D')); ?>
					  <?php echo $form->error($model,'layout'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'status'); ?>
					  <?php // echo $form->textField($model,'status'); ?>
                                                              <?php echo $form->dropDownList($model,'status', array('0'=>'DRAFT','1'=>'PUBLISHED')); ?>
					  <?php echo $form->error($model,'status'); ?>
				  </div>

			  				  
                             

			  
                        </div>   
  </div>

  </div><!--end modal body-->
      </div>
      <div class="modal-footer">
<!--        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
        <div class="form-actions">

		<?php
		
		 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'icon'=>'ok white', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			)
			
		);
		
		?>
              <?php
 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
                        'icon'=>'remove',  
			'label'=>'Reset',
		)); ?>
	</div> 
      </div>
    </div>
  </div>
</div>


<!--END NEW MODEL-->



    <div id='pages-create-modal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Create pages</h3>
    </div>
    
    <div class="modal-body">
    
    
  
  <div class="modal-footer">
	
   </div><!--end modal footer-->	
</fieldset>

<?php
 $this->endWidget(); ?>

</div>

</div><!--end modal-->

<script type="text/javascript">
function create()
 {
 tinyMCE.triggerSave();
   var data=$("#pages-create-form").serialize();
     


  jQuery.ajax({
   type: 'POST',
    url: '<?php
 echo Yii::app()->createAbsoluteUrl("/pages/manage/create"); ?>',
   data:data,
success:function(data){
                //alert("succes:"+data); 
                if(data!="false")
                 {
                  $('#pages-create-modal').modal('hide');
                  renderView(data);
                    $.fn.yiiGridView.update('pages-grid', {
                     
                         });
                   
                 }
                 
              },
   error: function(data) { // if error occured
         alert("Error occured.please try again");
         alert(data);
    },

  dataType:'html'
  });

}

function renderCreateForm()
{
  $('#pages-create-form').each (function(){
  this.reset();
   });

  
  $('#pages-view-modal').modal('hide');
  
  $('#pages-create-modal').modal({
   show:true,
   
  });
  
}

</script>
