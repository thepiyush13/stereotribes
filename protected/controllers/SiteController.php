<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    public $layout = 'main';
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
             
		$this->render('home',array('projects_html'=>$htm));
	}
        
        public function actionProjects(){
            $this->render('index');
        }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionGet(){
            
            $myModel = new MyBase;                          
            $page = (int)Yii::app()->request->getParam('page');
            $url_base = '/campaign/';
            
           
            //getting the block data 
             $projects  = $sorted_project =array();
             $type = array(1=>'featured',2=>'promo',3=>'normal');
             $img = array(1=>'a.jpg',2=>'b.jpg',3=>'c.jpg',4=>'d.jpg',5=>'e.jpg',6=>'aa',7=>'bb.png');
             //dummy data creation
//             for ($index = $page; $index <= ($page+11); $index++) {
//                 $projects[] = array(
//                     "percent"=>rand(0,100),
//                     "color"=>"#874795",
//                     "img"=>$img[rand(1,7)], 
//                     "url"=>"http://www.".rand(10,99).".com",
//                     "title"=>"Dj Shimmer Summer Party Mix Album",
//                     "location"=>"Location-".rand(0,99),
//                     "category"=>"Category-".rand(0,99),
//                     "author"=>"Author-".rand(0,99),
//                     "desc"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eu justo vel urna tempus ultrices. Donec nunc urna, dictum nec dictum eu, cursus nec augue.",
//                     "days"=>rand(0,99),
//                     "backers"=>rand(0,99),
//                     "pledge"=>rand(0,99),
//                     "type"=>$type[rand(1,3)]
//                 );
//            }
            
             //get first block as featured 
             $from = $page;
             $to = $from+1;             
             $sql = "Select z.project_id,concat('$url_base',z.project_id) as url,  x.title,  x.city as location,  y.name as category,  a.name as author,  x.short_summary as `desc`,  x.days_run as days,  x.image_url as img,  (case when (x.featured  = 1 ) then 'featured' else 'normal' end) as type,  y.color,  ROUND((SUM(z.amount)/x.goal)*100) as percent,  COUNT(distinct z.user_id) as backers,  SUM(z.amount) as pledge    from project as x  left join category as y   on x.category = y.category_id  left join user_fund_project as z   on x.id = z.project_id  join user as a  on x.user_id = a.id  where x.featured=1 group by z.project_id  order by x.project_live_date desc limit $from,$to";
             
             $projects['featured'] = Yii::app()->db->createCommand($sql)->queryAll();
             //if no featured block include 1 additional normal block 
                    $count  = empty($projects['featured']) ? 7 : 6;
             //else include regular no of blocks
             if($page==0){
                 $from  = 0;
                $to = $count;
            }
            else{
                $to  = $page*$count;
                $from = $to-$count;
            }
             $sql = "Select z.project_id,concat('$url_base',z.project_id) as url,  x.title,  x.city as location,  y.name as category,  a.name as author,  x.short_summary as `desc`,  x.days_run as days,  x.image_url as img,  (case when (x.featured  = 1 ) then 'featured' else 'normal' end) as type,  y.color,  ROUND((SUM(z.amount)/x.goal)*100) as percent,  COUNT(distinct z.user_id) as backers,  SUM(z.amount) as pledge    from project as x  left join category as y   on x.category = y.category_id  left join user_fund_project as z   on x.id = z.project_id  join user as a  on x.user_id = a.id  where x.featured=0 group by z.project_id  order by x.project_live_date desc limit $from,$to";
             $projects['normal'] = Yii::app()->db->createCommand($sql)->queryAll();
             
             //create html based on type 
             $htm = "";
                     if(!empty($projects['featured'])){
                 $htm.=$myModel->get_featured_block($projects['featured'][0]);
             }
             
             foreach ($projects['normal'] as $key => $normal_project) {                
               $htm.=$myModel->get_normal_block($normal_project);               
            }
             
           
            
            $this->layout=false;
            echo ($htm);
            Yii::app()->end(); 
           return true;
            
            //send back as html
            
            
        }
        
         public function actionGethome($width){
            
           $myModel = new MyBase;
             $url_base = '/campaign/';
             
             //get screen details 
             switch ($width) {
                case 600:
                    $count = 8;
                    break;
                 case 568:
                    $count = 8;
                    break;
                 case 800:
                    $count = 8;
                    break;
                 case 768:
                    $count = 8;
                    break;
                 case 1280:
                    $count = 8;
                    break;
                case 1920:
                    $count = 7;
                    break;
                case 1080:
                    $count = 8;
                    break;
                default:
                    $count = 7;
                    break;
            }
             
             
             $htm = '';
            $sql = "Select z.project_id,concat('$url_base',z.project_id) as url,  x.title,  x.city as location,  y.name as category,  a.name as author,  x.short_summary as `desc`,  x.days_run as days,  x.image_url as img,  (case when (x.featured  = 1 ) then 'featured' else 'normal' end) as type,  y.color,  ROUND((SUM(z.amount)/x.goal)*100) as percent,  COUNT(distinct z.user_id) as backers,  SUM(z.amount) as pledge    from project as x  left join category as y   on x.category = y.category_id  left join user_fund_project as z   on x.id = z.project_id  join user as a  on x.user_id = a.id  where x.featured=1 group by z.project_id  order by x.project_live_date desc limit 0,$count";
            
             $projects = Yii::app()->db->createCommand($sql)->queryAll();
             $first_project = $projects[0];
             unset($projects[0]);
             $rest_projects = $projects;
             
             $htm.=$myModel->get_featured_block($first_project);
             foreach ($rest_projects as $key => $normal_project) {                
               $htm.=$myModel->get_normal_block($normal_project);               
            }  
             
           
            
            $this->layout=false;
            echo ($htm);
            Yii::app()->end(); 
           return true;
            
            //send back as html
            
            
        }
}