<?php

class ProfileController extends Controller {

    public $layout = 'profile';

    public function actionBacked() {

        $data = $result = array();
        //user id passed or not 
        $user_id = isset($_GET['id']) ? $_GET['id'] : Yii::app()->user->getId();
        $data['user_id'] = $user_id;
        $data = $this->get_header($user_id);
        $data['user_details'] = Yii::app()->db->createCommand('SELECT * from user where id=' . $user_id)->queryAll();

        
        //user created project list
        $data['user_autorized'] = $this->autorized_user($user_id);
        $sub_query = $data['user_autorized']  ? '  1 ' : ' y.visible=1';
        $data['backed_projects'] = Yii::app()->db->createCommand(' select x.*,y.id as order_id,y.visible from project as x join user_fund_project as y on x.id= y.project_id and y.user_id = ' . $user_id . ' and ' . $sub_query . ' group by x.id')->queryAll();
        
        //generate links
        $data['links'] = $this->create_links($user_id);
        //generate category color codes
        $data['category_color'] = $this->category_color();
        //pass to view 
        //render
        $this->render('backed', array(
            'data' => $data,
        ));
    }

    public function actionComments() {

        $data = $result = array();
        //user id passed or not 
        $user_id = isset($_GET['id']) ? $_GET['id'] : Yii::app()->user->getId();
        $data['user_id'] = $user_id;
        //get the data 
        $data = $this->get_header($user_id);

        $data['user_details'] = Yii::app()->db->createCommand('SELECT * from user where id=' . $user_id)->queryAll();
        $data['user_autorized'] = $this->autorized_user($user_id);

        //user created project list
//              $data['comments'] = Yii::app()->db->createCommand(' select * from comments where user_id = '.$user_id)->queryAll();
        $data['project_comments'] = Yii::app()->db->createCommand(' select commentId,title as project_title,message,createDate from posts_comments_nm as x  join project as y on x.postId = y.id join comments as z on z.id=x.commentId where z.userId= ' . $user_id . ' group by commentId')->queryAll();
        //generate links
        $data['links'] = $this->create_links($user_id);
        //generate category color codes
        $data['category_color'] = $this->category_color();
        //pass to view 
        //render
        $this->render('comments', array(
            'data' => $data,
        ));
    }

    public function actionCreated() {

        $data = $result = array();
        //user id passed or not 
        $user_id = isset($_GET['id']) ? $_GET['id'] : Yii::app()->user->getId();
        $data['user_id'] = $user_id;
        $data = $this->get_header($user_id);
        $data['user_details'] = Yii::app()->db->createCommand('SELECT * from user where id=' . $user_id)->queryAll();


        //user created project list
        $data['created_projects'] = Yii::app()->db->createCommand(' select * from project where user_id = ' . $user_id . ' group by id')->queryAll();
        //generate links
        $data['links'] = $this->create_links($user_id);
        //generate category color codes
        $data['category_color'] = $this->category_color();
        //pass to view 
        //render
        $this->render('created', array(
            'data' => $data,
        ));
    }

    public function actionIndex() {

        $data = $result = array();
        //user id passed or not 
        $user_id = isset($_GET['id']) ? $_GET['id'] : Yii::app()->user->getId();
        $data['user_id'] = $user_id;
        //get data 
        $data = $this->get_header($user_id);
        $data['user_details'] = Yii::app()->db->createCommand('SELECT * from user where id=' . $user_id)->queryAll();


        //user created project list
        $data['user_projects'] = Yii::app()->db->createCommand(' select * from project where user_id = ' . $user_id . ' group by id')->queryAll();
        //generate links
        $data['links'] = $this->create_links($user_id);
        //generate category color codes
        $data['category_color'] = $this->category_color();
        //pass to view 
        //render
        $this->render('index', array(
            'data' => $data,
        ));
    }

    public function actionLoved() {

        $data = $result = array();
        //user id passed or not 
        $user_id = isset($_GET['id']) ? $_GET['id'] : Yii::app()->user->getId();
        $data['user_id'] = $user_id;
        $data = $this->get_header($user_id);
        $data['user_details'] = Yii::app()->db->createCommand('SELECT * from user where id=' . $user_id)->queryAll();


        //user created project list
        $data['loved_projects'] = Yii::app()->db->createCommand(' select x.* from project as x join user_love_project as y on x.id= y.project_id and y.user_id = ' . $user_id . ' group by x.id')->queryAll();
        //generate links
        $data['links'] = $this->create_links($user_id);
        //generate category color codes
        $data['category_color'] = $this->category_color();
        //pass to view 
        //render
        $this->render('loved', array(
            'data' => $data,
        ));
    }

    public function actionEdit() {
        $this->render('edit');
    }

    public function actionHide() {
        $order_id = (int)$_GET['id'];
        $status = (int) $_GET['status'];
         $url = $this->createUrl('profile/backed');
        //check if user has permission
        $owner = Yii::app()->db->createCommand('SELECT user_id from user_fund_project where id='.$order_id)->queryScalar();
        if($this->autorized_user($owner)==FALSE){
             $this->redirect($url);
             return false;
        }
        //set the status for this 
        $sql = 'UPDATE user_fund_project set visible = ' . $status.' where id='.$order_id;
        $result = Yii::app()->db->createCommand($sql)->execute();
        $this->layout= false;
        if (isset($result)) {
            echo true;
        } else {
            echo false;
        }
       
        $this->redirect($url);
    }
    
    public function actionDelcomment() {
        $comment_id = (int)$_GET['id']; 
        $url = $this->createUrl('profile/comments');
         $owner = Yii::app()->db->createCommand('SELECT userId from comments where id='.$comment_id)->queryScalar();
        if($this->autorized_user($owner)==FALSE){
             $this->redirect($url);
             return false;
        }
        //set the status for this 
        $sql = 'DELETE from comments where id='.$comment_id;
        $result = Yii::app()->db->createCommand($sql)->execute();
        $this->layout= false;
        if (isset($result)) {
            echo true;
        } else {
            echo false;
        }
        
        $this->redirect($url);
    }

    protected function create_links($user_id) {
        $links = array(
            'backed' => $this->createUrl('profile/backed'.'?id='.$user_id),
            'loved' => $this->createUrl('profile/loved'.'?id='.$user_id),
            'created' => $this->createUrl('profile/created'.'?id='.$user_id),
            'comments' => $this->createUrl('profile/comments'.'?id='.$user_id),
            'edit' => $this->createUrl('profile/edit', array('id' => $user_id)),
        );
        return $links;
    }

    protected function get_header($user_id) {
        //get data
        $data = array();
        $user_ok = $this->autorized_user($user_id);
        if ($user_ok) {
            $data['backed'] = Yii::app()->db->createCommand('SELECT count(distinct project_id) as count from user_fund_project where user_id=' . $user_id)->queryScalar();
        } else {
            $data['backed'] = Yii::app()->db->createCommand('SELECT count(distinct project_id) as count from user_fund_project where user_id=' . $user_id . ' and visible=1')->queryScalar();
        }
        //else show only public backed projects

        $data['created'] = Yii::app()->db->createCommand('SELECT count(distinct id) as count from project where user_id=' . $user_id)->queryScalar();
//            $data['comments'] = Yii::app()->db->createCommand('SELECT count(distinct id) as count from comment where user_id='.$user_id)->queryScalar();
        $data['comments'] = Yii::app()->db->createCommand('SELECT count(distinct id) as count from comments where userId=' . $user_id)->queryScalar();
        $data['loved'] = Yii::app()->db->createCommand('SELECT count(distinct project_id) as count from user_love_project where user_id=' . $user_id)->queryScalar();
        return $data;
    }

    protected function category_color() {
        $sql = 'SELECT * from category';
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($result as $key => $value) {
            $output[$value['category_id']] = $value['color'];
        }
        return $output;
    }

    protected function autorized_user($user_id) {
        //if logged in user is same as requested user show all backers 
        $logged_user = Yii::app()->user->getId();
        if ($user_id == $logged_user) {
            return true;
        } else {
            return false;
        }
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}