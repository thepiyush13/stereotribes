
<link href="http://ivaynberg.github.io/select2/select2-3.4.6/select2.css?ts=2014-04-05T09%3A05%3A31-07%3A00" rel="stylesheet"/>
<script type="text/javascript" src="http://ivaynberg.github.io/select2/select2-3.4.6/select2.js?ts=2014-04-05T09%3A05%3A31-07%3A00"></script>


<h1>Send Newsletters</h1>
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
    <div class="span6"> 
        <div class="row-fluid detail-view text-center"><h2>1. Preview Email</h2>
            <div class="row text-center well"><?php
echo $model->html_body;
?></div>
        </div>
    </div>
    <div class="span6"><h2>2. Send Email</h2>
        <!--START FORM-->
        <div class="row text-center well">
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'newsletter-create-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'method' => 'post',
    'action' => array("/newsletter/manage/send/id/".$_GET['id'] ),
    'type' => 'horizontal',
    
        ));
?>


        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>

        <div class="control-group">		
            <div class="span12">

                <div class="row">
<?php
//            echo $form->ListBox($modelUser,'name',array('id'=>'Select Users'), array('multiple' => 'multiple'));
$htmlOptions = array('empty' => 'Select users...', 'id' => 'selected', 'multiple' => 'multiple', 'style' => 'width:50%');
$data = CHtml::listData(User::model()->findAll(), 'id', 'name');
echo CHtml::activeDropDownList(User::model(), 'id', $data, $htmlOptions);
?>
                </div>
                 <div class="row"><br/>
<?php echo CHtml::submitButton('Send', array('class' => 'btn btn-primary btn-large', 'style' => 'width: 120px; border-radius: 10px;')); ?>
                </div>

            </div>

        </div><!--end modal body-->




<?php $this->endWidget(); ?>        
        </div>
        <!--END FORM-->
        <br/><div class="row text-center"></div>
        <div class="span12">


        </div>

    </div> 




</div>
<div><br/></div>





<script>
    $(document).ready(function() {
        $("#selected").select2({
            placeholder: "Click to Select Users...",
        });
    });
</script>
