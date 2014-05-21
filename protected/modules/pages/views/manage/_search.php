<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'search-pages-form',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));  ?>


	<?php // echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'subject',array('class'=>'span3','maxlength'=>250)); ?>

	<?php // echo $form->textAreaRow($model,'html_body',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php // echo $form->textAreaRow($model,'url',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php // echo $form->textFieldRow($model,'layout',array('class'=>'span5','maxlength'=>20)); ?>

	<?php // echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>
  <?php echo $form->dropDownList($model,'status', array('0'=>'DRAFT','1'=>'PUBLISHED'),array('class'=>'span3')); ?>

	<?php // echo $form->textFieldRow($model,'updated',array('class'=>'span5')); ?>

	<?php // echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Search')); ?>
               <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
	</div>

<?php $this->endWidget(); ?>


<?php $cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap/jquery-ui.css');
?>	
   <script>
	$(".btnreset").click(function(){
		$(":input","#search-pages-form").each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase(); // normalize case
		if (type == "text" || type == "password" || tag == "textarea") this.value = "";
		else if (type == "checkbox" || type == "radio") this.checked = false;
		else if (tag == "select") this.selectedIndex = "";
	  });
	});
   </script>

