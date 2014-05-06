


<!-- Place inside the <head> of your HTML -->
<script type="text/javascript" src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>

<!--<script  type="text/javascript" src="<?php // echo Yii::app()->request->baseUrl; ?>/adassets/newsletter-assets/js/tinymce.js"></script>-->
<!--<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>-->

 <!--<textarea rows="6" cols="50" name="Newsletter[text_body]" id="Newsletter_text_body"></textarea>-->
<!--<div class="row">
    <h1>Editor</h1>
    <form method="post">
    <textarea></textarea>
</form>
</div>-->

<?php
$this->breadcrumbs=array(
	'Newsletters',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('newsletter-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<h1 class="dash-header">Newsletters</h1>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<hr />
<?php Yii::app()->bootstrap->register(); ?>
<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Create', 'icon'=>'icon-plus', 'url'=>'javascript:void(0);','linkOptions'=>array('onclick'=>'renderCreateForm()')),
                array('label'=>'List', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
		array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
		array('label'=>'Export to PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>false),
		array('label'=>'Export to Excel', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>false),
	),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
<?php
$this->renderPartial('_search',array(
	'model'=>$model,
)); 

?>
</div><!-- search-form -->
<div><br/></div>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'newsletter-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
		'id',
		'subject',
            array(
                'name'=>'html_body',
                'value'=>'strlen($data->html_body) > 100 ? substr($data->html_body, 0, 100)."..." : $data->html_body',
             
            ),
		
		'text_body',
		'misc',
		'status',
		/*
		'updated',
		'created',
		*/
               array(
		     
		      'type'=>'raw',
                   'name'=>'actions',
		       'value'=>'"
		      <a href=\'javascript:void(0);\' onclick=\'renderView(".$data->id.")\'   class=\'btn btn-small view news-icon\'  ><i class=\'icon-eye-open\'></i></a>
		      <a href=\'javascript:void(0);\' onclick=\'renderUpdateForm(".$data->id.")\'   class=\'btn btn-small view news-icon\'  ><i class=\'icon-pencil\'></i></a>
		      <a href=\'javascript:void(0);\' onclick=\'delete_record(".$data->id.")\'   class=\'btn btn-small view news-icon\'  ><i class=\'icon-trash\'></i></a>
                       <a href=\"'.Yii::app()->createUrl("/newsletter/manage/send").'/id/$data->id\"  class=\'btn btn-small view news-icon\'  ><i class=\'icon-envelope\'></i></a>
		     "',
		      'htmlOptions'=>array('style'=>'width:200px;')  
		     ),
        
	),
)); 


 $this->renderPartial("_ajax_update");
 $this->renderPartial("_ajax_create_form",array("model"=>$model));
 $this->renderPartial("_ajax_view");

 ?>

 <!--<script  type='text/javascript' src='<?php // echo Yii::app()->request->baseUrl; ?>/adassets/newsletter-assets/js/tinymce.js'></script>-->
<script type="text/javascript"> 
    
    
  $(document).ready(function(){

        $('#newsletter-create-modal').on('shown', function() {
                     start_tinymce('create_html_body');   
                  });
                  
                  
                
           
    }); 
    function elFinderBrowser (field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: '<?php echo Yii::app()->getBaseUrl(true). '/elfinder/elfinder.html'  ?>',//'elfinder/elfinder.html',// use an absolute path!
    title: 'elFinder 2.0',
    width: 900,  
    height: 450,
    resizable: 'yes'
  }, {
    setUrl: function (url) {
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
}
     function start_tinymce(element_id){
        
        if (typeof(tinyMCE) != "undefined") {
  if (tinyMCE.activeEditor == null || tinyMCE.activeEditor.isHidden() != false) {
    tinyMCE.editors=[]; // remove any existing references
  }
}
            $(document).off('focusin.modal');
         tinymce.init({
    selector: "textarea#"+element_id,
    theme: "modern",
    width: 500,
    height: 300,
    file_browser_callback : elFinderBrowser,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
    }      
function delete_record(id)
{
 
  if(!confirm("Are you sure you want delete this?"))
   return;
   
 //  $('#ajaxtest-view-modal').modal('hide');
 
 var data="id="+id;
 

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("/newsletter/manage/delete"); ?>',
   data:data,
success:function(data){
                 if(data=="true")
                  {
                     $('#newsletter-view-modal').modal('hide');
                     $.fn.yiiGridView.update('newsletter-grid', {
                     
                         });
                 
                  } 
                 else
                   alert("deletion failed");
              },
   error: function(data) { // if error occured
           alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
       //  alert(data);
    },

  dataType:'html'
  });

}
</script>

<style type="text/css" media="print">
body {visibility:hidden;}
.printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
function printDiv()
{

//window.print();

}
</script>
 

<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/adassets/newsletter-assets/js/tinymce.js');
//  $cs->registerCssFile($baseUrl.'/css/yourcss.css');
?>