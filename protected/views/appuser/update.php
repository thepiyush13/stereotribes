<?php
/* @var $this AppUserController */
/* @var $model AppUser */

$this->breadcrumbs=array(
	'App Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AppUser', 'url'=>array('index')),
	array('label'=>'Create AppUser', 'url'=>array('create')),
	array('label'=>'View AppUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AppUser', 'url'=>array('admin')),
);
?>

<h1>Update AppUser <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>