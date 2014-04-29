
<div class="container">
    <div class="col-sm-5">
        <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="info">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
        <?php endif; ?>
        <form class="form-horizontal" role="form" class="form-signin" action="/AppUser/profile" method="POST" enctype='multipart/form-data'>
            <h2 class="form-signin-heading">Update Profile</h2>
            <div class="form-group">
                <label for="Name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php if (isset($model['name'])) echo $model['name']?>">
                    <span class="login-error"><?php if (isset($error['name'])) echo $error['name'][0]; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="Email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php if (isset($model['email'])) echo $model['email']?>">
                    <span class="login-error"><?php if (isset($error['email'])) echo $error['email'][0]; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="Email" class="col-sm-2 control-label">Profile Picture</label>
                <div class="col-sm-10">
                    <input type="file" name="profile_pic"/>
                    <span class="login-error"><?php if (isset($error['profile_pic'])) echo $error['profile_pic'][0]; ?></span>
                </div>
                <div>
                    <?php 
                        if(isset($model['profile_pic']))
                            echo '<img width="200" height="150" class="col-sm-4" src="/uploads/profile/'.$model['profile_pic'].'" alt="" />';
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-10">
                    <select class="form-control" name="location">
                        <option selected=""><?php if (isset($model['location'])) echo $model['location']?></option>
                        <option>India</option>
                        <option>China</option>
                        <option>Japan</option>
                        <option>Russia</option>
                    </select>
                     <span class="login-error"><?php if (isset($error['location'])) echo $error['location'][0]; ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            </div>
        </form>
        <?php
        if(!$model->isFbUser(Yii::app()->user->name))
        {
        ?>
       <div class="form-group">
                <label for="Email" class="col-sm-2 control-label">Link Your Account</label>
                <div class="col-sm-10">
                    <a href="/login/facebook?id=<?php echo Yii::app()->user->id; ?>" class="btn btn-link"> Facebook </a>
                </div>
      </div>
        <?php } ?>
    </div>
</div>