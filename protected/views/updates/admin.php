<?php
/* @var $this UpdatesController */
/* @var $model Updates */

$this->breadcrumbs=array(
	'Updates'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Updates', 'url'=>array('index')),
array('label'=>'Create Updates', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$('#updates-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Updates</h1>


<?php echo CHtml::link('Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'updates-grid',
'dataProvider'=>$model->search(),
'columns'=>array(
		'id',
		'title',
		'message',
		'projectId',
		'userId',
		'createDate',
array(
'class'=>'CButtonColumn',
),
),
)); ?>
