<?php
/* @var $this AppUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'App Users',
);

$this->menu=array(
	array('label'=>'Create AppUser', 'url'=>array('create')),
	array('label'=>'Manage AppUser', 'url'=>array('admin')),
);
?>

<h1>App Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
