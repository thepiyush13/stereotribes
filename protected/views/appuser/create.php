<?php $error = $model->getErrors(); ?>
<div class="container">
    <div class="col-sm-5">
        <form class="form-horizontal" role="form" class="form-signin" action="/appUser/create" method="POST">
            <h2 class="form-signin-heading">Register Your self ! </h2>
            <div class="form-group">
                <label for="Name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                    <span class="login-error"><?php if (isset($error['name'])) echo $error['name'][0]; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="Email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" placeholder="Email" name="email">
                    <span class="login-error"><?php if (isset($error['email'])) echo $error['email'][0]; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="Password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    <span class="login-error"><?php if (isset($error['password'])) echo $error['password'][0]; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="Confirm Password" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password">
                     <span class="login-error"><?php if (isset($error['confirm_password'])) echo $error['confirm_password'][0]; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Location</label>
                <div class="col-sm-10">
                    <select class="form-control" name="location">
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
                    <button type="submit" class="btn btn-default">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</div>
