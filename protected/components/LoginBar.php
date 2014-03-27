<?php

class LoginBar extends CWidget {

    public function run() {
        if (Yii::app()->user->isGuest === false) {
            $user = Yii::app()->user;
            $profilePic = Utils::getProfilePic($user->id);
            $loginBar = <<< EOD
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img height="20"  src="$profilePic">
                        <span class="username">{$user->name}</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li><a href="/admin/users/profile/id/{$user->id}"><i class=" icon-suitcase"></i>Profile</a></li>
                        <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                        <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>
                        <li><a href="/login/logout"><i class="icon-key"></i> Log Out</a></li>
                    </ul>
                </li>
EOD;
            echo $loginBar;
        } else {
            $loginBar = <<< EOD
              <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <i class="fa fa-lock"></i>
                      </a>
                      <ul class="dropdown-menu extended login">
                          <div class="log-arrow-up"></div>
                          <li>
                            <form class=" form-signin-home form-signin" action="/login" method="POST">
                                <div class="login-wrap">
                                    <input type="text" class="form-control" placeholder="User ID" autofocus name="username">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    <label class="checkbox">
                                        <input type="checkbox" value="remember-me"> Remember me
                                    
                                        <span class="pull-right">
                                            <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                                        </span>
                                    </label>
                                    <button class="btn btn-sm btn-login btn-block" type="submit">Sign in</button>
                                    <div class="login-social-link">
                                        <a href="/login/facebook" class="facebook">
                                            <i class="fa fa-facebook"></i>
                                            Login with Facebook
                                        </a>
                                    </div>

                                </div>
                            </form>
                          </li> 
                      </ul>
                  </li>
                  <!-- user login dropdown end -->
              </ul>
          </div>


EOD;
            echo $loginBar;
        }
    }

}
