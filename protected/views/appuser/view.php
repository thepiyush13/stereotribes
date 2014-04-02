<?php
/* @var $this AppUserController */
/* @var $model AppUser */

$this->breadcrumbs=array(
	'App Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List AppUser', 'url'=>array('index')),
	array('label'=>'Create AppUser', 'url'=>array('create')),
	array('label'=>'Update AppUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AppUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppUser', 'url'=>array('admin')),
);
?>

<h1>View AppUser #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'email',
		'password',
		'location',
		'fbid',
	),
)); ?>
