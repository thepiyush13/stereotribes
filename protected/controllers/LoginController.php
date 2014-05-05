<?php

class LoginController extends Controller {

    public $layoutPath = 'views.layouts';
    public $layout = 'login';
    public $logoutUrl;

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        
        $model = new LoginForm;
        // collect user input data
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST;
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                
                $roles = Yii::app()->user->getState('roles');
                if($roles['normal'] == "normal"){
                    $this->redirect('/');
                }
                $modules = array('admin');
                foreach ($modules as $module) {
                    if ($roles[$module]['role']) {
                        $this->redirect('/' . $module);
                        exit;
                    }
                }
                $this->redirect('/');
            }
        }
        // display the login form
        if (Yii::app()->user->isGuest) {
            $this->render('index', array('model' => $model));
        } else {
            $this->redirect('/');
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        
        $model = new LoginForm;
        
        // collect user input data
        if (Yii::app()->request->isPostRequest) {

            $model->attributes = $_POST;
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Login using facebook account
     */
    public function actionFacebook($email="",$id="") {
        
        $userModel = new AppUser();
        $facebook = new Facebook(
                array(
                    'appId' => Yii::app()->params->FB['APPID'],
                    'secret' => Yii::app()->params->FB['SECRET'],//"44aa19757944ba566e1f01c7d8bbca71",
                    'state' => 'testcode',
                ));
        
        // Get User ID
        $user = $facebook->getUser();
        if ($user) {
            try {
                $user_profile = $facebook->api('/me');
//                echo '<pre>', print_r($user_profile); exit;
                if (!$userModel->ifUserExists($user_profile['email'])) {
                    
                    $userModel->add($user_profile);
                }

                $model = new LoginForm();
                $model->username = $user_profile['email'];
                if ($model->loginByFacebook()) {
                    if(isset($_GET['app_data']) && $_GET['app_data'] == "test")
                    {
                        $this->redirect('/AppUser/Profile');
                    }
                    else if(isset ($_GET['app_data']) && $_GET['app_data'] == "id")
                    {
                        echo "hey inside id";
                        die($user_profile['id']);
                    }
                    else
                        $this->redirect('/');
                }
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }
        if(!empty($email))
            $app_data = "test";
        else if(!empty ($id))
            $app_data = "id";
        else
            $app_data = "";
        
            $params = array(
                'scope' => 'email, read_stream, friends_likes, user_interests, user_likes',
                'redirect_uri' => 'http://'.$_SERVER['HTTP_HOST'].'/login/facebook?app_data='.$app_data,
            );

        // Login or logout url will be needed depending on current user state.
        if ($user) {
            $this->logoutUrl = $facebook->getLogoutUrl();
        } else {
            $statusUrl = $facebook->getLoginStatusUrl();
            $loginUrl = $facebook->getLoginUrl($params);
            $this->redirect($loginUrl);
        }
    }

    /**
     * Login Using Twitter account
     */
    public function actionTwitter() {
        
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        $this->fbLogout();
        if(Yii::app()->user) {
            $this->actionSystemLogout();
        }
        
    }
    
    public function actionSystemLogout() {
        Yii::app()->user->logout();
        $this->redirect('/');
    }
    
    public function fbLogout() {
        $facebook = new Facebook(
            array(
                'appId' => "197512947123436",
                'secret' => "44aa19757944ba566e1f01c7d8bbca71",
            ));
        
        if($facebook->getUser()) {
            //$facebook->destroySession();
            //echo $facebook->getLogoutUrl();
            $this->redirect($facebook->getLogoutUrl(array('next' => 'http://stereotribes.jumpcatch.com/login/systemLogout/')));
        }
    }

}

