<?php $error = $model->getErrors(); ?>
<div class="container">

    <form class="form-signin" action="/login" method="POST">
        <h2 class="form-signin-heading">READFIEND<!--img src="/img/site/logo.png"--></h2>
        <div class="login-wrap">
            <span class="login-error"><?php if (isset($error['password'])) echo $error['password'][0]; ?></span>
            <input type="text" class="form-control" placeholder="User ID" autofocus name="username">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>

            <div class="registration">
                Don't have an account yet?
                <a class="" href="#">
                    Create an account
                </a>
            </div>

        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot Password ?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter your e-mail address below to reset your password.</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        <button class="btn btn-success" type="button">Submit</button>
                    </div>
                </div>
            </div>



        </div>
        <!-- modal -->

    </form>

</div>