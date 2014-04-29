
<a href="#" class='btn btn-primary export_project_table'>Export as CSV</a>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $arrayDataProvider,
    'itemsCssClass' => 'display table table-striped table-bordered table-advance table-hover dashboard_projects_table',
    'summaryText'=>'' ,
   
	'columns' => array(
            array(
            'header'=>'#',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)'
        ),
                            array(
			'name' => 'ID',
			'type' => 'raw',
			'value' => '($data["id"])'
		),
		array(
			'name' => 'Title',
			'type' => 'raw',
			'value' => '($data["title"])'
		),
		array(
			'name' => 'Category',
			'type' => 'raw',
			'value' => '($data["category"])'
		),array(
			'name' => 'Featured',
			'type' => 'boolean',
			'value' => '($data["featured"])'
		),
		array(
			'name' => 'Launch Date',
			'type' => 'date',
			'value' => '($data["project_live_date"])'
		),array(
			'name' => 'End Date',
			'type' => 'date',
			'value' => '($data["end_date"])'
		),
		array(
			'name' => 'Duration',
			'type' => 'raw',
			'value' => '($data["days_run"])'
		),
		array(
			'name' => 'Backers',
			'type' => 'raw',
			'value' => '($data["backers"])'
		),
		array(
			'name' => 'Fixed or Flexible',
			'type' => 'raw',
			'value' => '($data["funding_type"])'
		),array(
			'name' => 'Target',
			'type' => 'raw',
			'value' => '($data["goal"])'
		),
		array(
			'name' => 'Raised',
			'type' => 'raw',
			'value' => '($data["raised"])'
		),array(
			'name' => 'Loved',
			'type' => 'raw',
			'value' => '($data["loved"])'
		),
		array(
			'name' => 'Summery',
			'type' => 'raw',
			'value' =>'substr($data["short_summary"], 0, 55)'
		),
		array(
			'name' => 'Location',
			'type' => 'raw',
			'value' => '($data["city"])."-".$data["country"]'
		),array(
			'name' => 'No of reward levels',
			'type' => 'raw',
			'value' => '($data["reward_level"])'
		),
		array(
			'name' => 'Status',
			'type' => 'raw',
			'value' => '($data["project_status"])'
		),
            
	),
));



$js = '
 $(document).ready(function() {
       
        
            
$(".dashboard_projects_table").dataTable( {});

//export to csv code
/* This must be a hyperlink*/
$(".export_project_table").on(\'click\', function (event) {
       exportTableToCSV.apply(this, [$(\'.dashboard_projects_table\'), \'ProjectsList.csv\']);
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
    
Yii::app()->clientScript->registerScript('dashboard_projects', $js);

?>

<div id="dashboard_projects" ></div>


