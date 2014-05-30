<?php
/* @var $this UpdatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Updates',
);

$this->menu=array(
	array('label'=>'Create Updates', 'url'=>array('create')),
	array('label'=>'Manage Updates', 'url'=>array('admin')),
);
?>

<h1>Updates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
