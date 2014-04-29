<!--NEW MODEL-->

<div id='newsletter-update-modal' class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Update newsletter #<?php echo $model->id; ?></h4>
      </div>
      <div class="modal-body">
        <div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'newsletter-update-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'method'=>'post',
        'action'=>array("/newsletter/manage/update"),
	'type'=>'horizontal',
	'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ update(); } " /* Do ajax call when user presses enter key */
                            ),               
	
)); ?>
     	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
        		
   <div class="control-group">		
			<div class="span4">
			
			<?php echo $form->hiddenField($model,'id',array()); ?>
			
	               				  <div class="row">
					  <?php echo $form->labelEx($model,'subject'); ?>
					  <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>250)); ?>
					  <?php echo $form->error($model,'subject'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'html_body'); ?>
                                                              <?php echo $form->textArea($model,'html_body',array('rows'=>6, 'cols'=>50,
                                                                  'id'=>'update_html_body')); ?>
                                                            <?php
                                                              
//                                                              $this->widget('ext.tinymce.TinyMce', array(
//    'model' => $model,
//    'attribute' => 'html_body',    
//    'htmlOptions' => array(
//        'rows' => 6,
//        'cols' => 60,
//        'id'=>'update_html_body'
//    ),
//));
                                                              
                                                              ?>
                                                              <?php      
//                                                              $this->widget('application.extensions.cleditor.ECLEditor', array(
//                                                                                'model'=>$model,
//                                                                              'name'=>get_class($model).'[html_body]',
//                                                                                                   'id'=>'html_body1',
//                                              
//                                                                                'options'=>array(
//                                                                                    'width'=>'600',
//                                                                                    'height'=>250,
//                                                                                    'useCSS'=>true,
//                                                                                ),
//                                               'value'=>$model->html_body
//                                                                      )); ?>
					  
					  <?php echo $form->error($model,'html_body'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'text_body'); ?>
					  <?php echo $form->textArea($model,'text_body',array('rows'=>6, 'cols'=>50)); ?>
					  <?php echo $form->error($model,'text_body'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'misc'); ?>
					  <?php echo $form->textField($model,'misc',array('size'=>20,'maxlength'=>20)); ?>
					  <?php echo $form->error($model,'misc'); ?>
				  </div>

			  				  <div class="row">
					  <?php echo $form->labelEx($model,'status'); ?>
					  <?php echo $form->dropDownList($model,'status', array('0'=>'DRAFT','1'=>'PUBLISHED')); ?>
					  <?php echo $form->error($model,'status'); ?>
				  </div>

			  				

			  
                        </div>   
  </div>

  </div><!--end modal body-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php		
		 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'id'=>'sub2',
			'type'=>'primary',
                        'icon'=>'ok white', 
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			'htmlOptions'=>array('onclick'=>'update();'),
		));
		
		?>
      </div>
    </div>
  </div>
</div>
<?php $this->endWidget(); ?>
<!--END NEW MODEL-->


