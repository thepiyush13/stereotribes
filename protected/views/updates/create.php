<?php
/* @var $this UpdatesController */
/* @var $model Updates */

$this->breadcrumbs=array(
	'Updates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Updates', 'url'=>array('index')),
	array('label'=>'Manage Updates', 'url'=>array('admin')),
);
?>

<h1>Create Updates</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>