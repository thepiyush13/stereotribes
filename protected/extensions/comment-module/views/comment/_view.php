<?php
    Yii::app()->clientScript->registerCss('ext-comment', "");
?>
<div class="ext-comment" id="ext-comment-<?php echo $data->id; ?>">
    <div class="comment-head">
        <span class="ext-comment-head">
            <span class="ext-comment-name"><?php echo CHtml::encode($data->username); ?></span>
            wrote on
            <span class="ext-comment-date">
                <?php 
                echo Yii::app()->format->formatDateTime(
                    is_numeric($data->createDate) ? $data->createDate : strtotime($data->createDate)
                ); 
                ?>
            </span>
        </span>
        <span class="ext-comment-options">
            <?php if (!Yii::app()->user->isGuest && (Yii::app()->user->id == $data->userId)) {
                echo CHtml::ajaxLink('delete', array('/comment/comment/delete', 'id'=>$data->id), array(
                    'success'=>'function(){ $("#ext-comment-'.$data->id.'").remove(); }',
                    'type'=>'POST',
                ), array(
                    'id'=>'delete-comment-'.$data->id,
                    'confirm'=>'Are you sure you want to delete this item?',
                ));
                echo " | ";
                echo CHtml::ajaxLink('edit', array('/comment/comment/update', 'id'=>$data->id), array(
                    'replace'=>'#ext-comment-'.$data->id,
                    'type'=>'GET',
                ), array(
                    'id'=>'ext-comment-edit-'.$data->id,
                ));
            }
            /* adds edit link to post if is not admin's post so they can still edit it */
                              elseif ( true /*Yii::app()->getModule('user')->isAdmin()*/) {
                echo CHtml::ajaxLink('edit', array('/comment/comment/update', 'id'=>$data->id), array(
                    'replace'=>'#ext-comment-'.$data->id,
                    'type'=>'GET',
                ), array(
                    'id'=>'ext-comment-edit-'.$data->id,
                ));
            }?>
        </span>
    </div>
    <div class="commentspacer">
        <div class="comment-img">
            <?php $this->widget('comment.extensions.gravatar.yii-gravatar.YiiGravatar', array(
                          /*'email'=>$data->email,*/
                          'size'=>40,
                         
                          'secure'=>false,
                          'rating'=>'r',
                          'emailHashed'=>false,
                          'htmlOptions'=>array(
                          'alt'=>CHtml::encode($data->username),
                          'title'=>CHtml::encode($data->username),
                              'src'=>'http://www.gravatar.com/avatar/00000000000000000000000000000000'
                          )
                          )); ?>
        </div>
 
 
        <p><?php echo nl2br(CHtml::encode($data->message)); ?></p>
 
    </div>
</div>

<style id="ext-comment">
    
    /*comment extension*/
 
div.ext-comment {
background: #f7f7f7;
width: 100%;
margin: 15px auto;
height: auto;
border: 1px solid #e9e9e9;
overflow: hidden;
}
div.commentspacer {
padding:
10px;
}
div.ext-comment p {
margin: 0px 0px 0px 100px;
min-height: 77px;
height: auto;
background: #fff;
padding: 8px;   
}
div.ext-comment img {
float: left;
width: 80px;
height: 80px;
}
span.ext-comment-name {
font-weight: bold;
}
 
div.comment-head {
font-weight: bold;
text-transform: capitalize;
padding: 5px;
}
span.ext-comment-options {
float: right;
color: #aaa;
}
 
div.comment-img {
float: left;
width: 80px;
height: 80px;
margin: auto;
padding: 5px;
border: 1px solid #e0e0e0;
background: #fff;
}
.comment-head {
border-bottom: 1px solid #e9e9e9;
font-weight: bold;
text-transform: capitalize;
padding: 8px;
color: #6a6a6a;
}
div.textfieldholder {
margin: 0px 0px 0px 100px;
min-height: 70px;
height: auto;
display: block;
padding: 0px;
}
 
.commenttextfield {
min-height: 77px;
height: auto;
background: #fff;
padding: 8px;
width: 98%;
margin: 0px;
}
.commenttextfield:focus {
box-shadow: 0 0 5px rgba(81, 203, 238, 1);
border: 1px solid rgba(81, 203, 238, 1);
}
.commentbutton {
float: right;
margin-top: 0px;
margin-right: 13px;
padding: 0px 10px 10px 10px;
}
#ext-comment .button, input[type="submit"] { 
color: #ffffff;
background-color: hsl(200, 0%, 15%) !important;
background-repeat: repeat-x  !important;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#b5b5b5", endColorstr="#262626") !important;;
background-image: -khtml-gradient(linear, left top, left bottom, from(#b5b5b5), to(#262626)) !important;
background-image: -moz-linear-gradient(top, #b5b5b5, #262626) !important;
background-image: -ms-linear-gradient(top, #b5b5b5, #262626) !important;
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #b5b5b5), color-stop(100%, #262626)) !important;
background-image: -webkit-linear-gradient(top, #b5b5b5, #262626) !important;
background-image: -o-linear-gradient(top, #b5b5b5, #262626) !important;
background-image: linear-gradient(#b5b5b5, #262626) !important;
border-color: #262626 #262626 hsl(200, 0%, 1%) !important;
color: #fff !important; text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.92) !important;
-webkit-font-smoothing: antialiased !important;
min-height: 0px !important;
min-width: 0px !important;
-moz-border-radius: 0px !important;
-webkit-border-radius: 0px!important;
-khtml-border-radius: 0px!important;
border-radius: 0px!important;
margin: 0px!important;
padding: 3px!important;
}
#ext-comment .button, input[type="submit"]:hover { 
opacity:0.7;
}
 
#comments a:link {
font: #fff;
color: #ffffff !important;
}
#comments a:visited {
text-decoration: none;
}
#comments a:hover {
text-decoration: none;
}
    
</style>