<?php
/* @var $this UpdatesController */
/* @var $model Updates */

$this->breadcrumbs=array(
	'Updates'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Updates', 'url'=>array('index')),
	array('label'=>'Create Updates', 'url'=>array('create')),
	array('label'=>'View Updates', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Updates', 'url'=>array('admin')),
);
?>

<h1>Update Updates <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>