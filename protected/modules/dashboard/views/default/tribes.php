
<a href="#" class='btn btn-primary export_tribes_table'>Export as CSV</a>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $arrayDataProvider,
    'itemsCssClass' => 'display table table-striped table-bordered table-advance table-hover dashboard_tribes_table',
    'summaryText'=>'' ,
   
	'columns' => array(
            array(
            'header'=>'#',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)'
        ),
                            array(
			'name' => 'Name',
			'type' => 'raw',
			'value' => '($data["email"])'
		),
		array(
			'name' => 'Email',
			'type' => 'raw',
			'value' => '($data["email"])'
		),
		array(
			'name' => 'Status',
			'type' => 'raw',
			'value' => '($data["status"])'
		)
            
	),
));



$js = '
 $(document).ready(function() {
       
        
            
$(".dashboard_tribes_table").dataTable( {});

//export to csv code
/* This must be a hyperlink*/
$(".export_tribes_table").on(\'click\', function (event) {
       exportTableToCSV.apply(this, [$(\'.dashboard_tribes_table\'), \'TribesList.csv\']);
   });

function exportTableToCSV($table, filename) {
       
       var $rows = $table.find(\'tr:has(td)\');
       var  $header =  $table.find(\'tr:has(th)\');                

           // Temporary delimiter characters unlikely to be typed by keyboard
           // This is to avoid accidentally splitting the actual contents
           tmpColDelim = String.fromCharCode(11), // vertical tab character
           tmpRowDelim = String.fromCharCode(0), // null character

           // actual delimiter characters for CSV format
           colDelim = \'","\',
           rowDelim = \'"\r\n"\',

           // Grab text from table into CSV formatted string
           csv = \'"\' + $header.map(function (i, head) {
               var $head = $(head),
                   $cols = $head.find(\'th\');

               return $cols.map(function (j, col) {
                   var $col = $(col),
                       text = $col.text();

                   return text.replace(\'"\', \'""\'); // escape double quotes

               }).get().join(tmpColDelim);

           }).get().join(tmpRowDelim)
               .split(tmpRowDelim).join(rowDelim)
               .split(tmpColDelim).join(colDelim) + \'"\' ;
       
       csv+=\'\r\n\';
       
       csv+= \'"\' + $rows.map(function (i, row) {
               var $row = $(row),
                   $cols = $row.find(\'td\');
                   
               return $cols.map(function (j, col) {
                   var $col = $(col);
                      var text;
                      if($($(col)).find("input:checkbox").length > 0)
                           text = $($(col)).find("input:checkbox").prop(\'checked\') ? \'Yes\' : \'No\';
                       else
                       {
                           text = $col.text();
                           if(text == "null")
                               text = "";
                       }
                       
                   return text.replace(\'"\', \'""\'); // escape double quotes

               }).get().join(tmpColDelim);

           }).get().join(tmpRowDelim)
               .split(tmpRowDelim).join(rowDelim)
               .split(tmpColDelim).join(colDelim) + \'"\';

           csvData = \'data:application/csv;charset=utf-8,\' + encodeURIComponent(csv);

       $(this)
           .attr({
           \'download\': filename,
               \'href\': csvData,
               \'target\': \'_blank\'
       });
}


} );

 
';
    
Yii::app()->clientScript->registerScript('dashboard_tribes', $js);

?>

<div id="dashboard_tribes" ></div>


