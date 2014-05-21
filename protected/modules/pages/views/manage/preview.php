
<link href="http://ivaynberg.github.io/select2/select2-3.4.6/select2.css?ts=2014-04-05T09%3A05%3A31-07%3A00" rel="stylesheet"/>
<script type="text/javascript" src="http://ivaynberg.github.io/select2/select2-3.4.6/select2.js?ts=2014-04-05T09%3A05%3A31-07%3A00"></script>


<h1>Send Pagess</h1>
<hr />
<?php Yii::app()->bootstrap->register(); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
?>
<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('label' => 'Back to List', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'active' => false, 'linkOptions' => array()),
        array('label' => 'Send', 'icon' => 'icon-envelope', 'url' => '#', 'active' => true, 'linkOptions' => array()),
    ),
));
$this->endWidget();
?>



<div class="row-fluid text-center">
    <div class="span12"> 
        <div class="row-fluid detail-view text-center"><h2>1. Preview Email</h2>
            <div class="row text-center well"><?php
echo $model->html_body;
?></div>
        </div>
    </div>
    




</div>

