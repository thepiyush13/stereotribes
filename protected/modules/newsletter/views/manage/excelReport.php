<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      subject		</th>
 		<th width="80px">
		      html_body		</th>
 		<th width="80px">
		      text_body		</th>
 		<th width="80px">
		      misc		</th>
 		<th width="80px">
		      status		</th>
 		<th width="80px">
		      updated		</th>
 		<th width="80px">
		      created		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->subject; ?>
		</td>
       		<td>
			<?php echo $row->html_body; ?>
		</td>
       		<td>
			<?php echo $row->text_body; ?>
		</td>
       		<td>
			<?php echo $row->misc; ?>
		</td>
       		<td>
			<?php echo $row->status; ?>
		</td>
       		<td>
			<?php echo $row->updated; ?>
		</td>
       		<td>
			<?php echo $row->created; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
