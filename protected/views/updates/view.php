<?php
/* @var $this UpdatesController */
/* @var $model Updates */

$this->breadcrumbs=array(
	'Updates'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Updates', 'url'=>array('index')),
	array('label'=>'Create Updates', 'url'=>array('create')),
	array('label'=>'Update Updates', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Updates', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Updates', 'url'=>array('admin')),
);
?>

<h1>View Updates #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'message',
		'projectId',
		'userId',
		'createDate',
	),
)); ?>
