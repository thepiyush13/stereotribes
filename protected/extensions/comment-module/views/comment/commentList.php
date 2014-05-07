<?php
 
/** @var CArrayDataProvider $comments */
$comments = $model->getCommentDataProvider();
$comments->pagination->pageSize = 5; //sets number of comments to display per page
 $this->renderPartial('comment.views.comment._form', array(
    'comment'=>$model->commentInstance,
   
));
?>
<div><br/></div>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$comments,
    'itemView'=>'comment.views.comment._view',
        'template'=>'{items}{pager}<br/><br/>', 
));
 
