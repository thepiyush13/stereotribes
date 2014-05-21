<?php

class SearchController extends Controller
{
	public $layout = 'common';
	public function actionIndex()
	{
		
            //get the category id 
            if(!$_GET['keyword'] || !$_GET['type'] ){
                $this->redirect('/');
            }
                $data['keyword'] = urldecode($_GET['keyword']);
                 $data['type'] = urldecode($_GET['type']);
                
                 
           
            
            $this->render('index',array('data'=>$data));
	}
	public function actionLocation()
	{
		$this->render('location');
	}

	public function actionTags()
	{
		$this->render('tags');
	}
 public function actionGet(){
            
            $myModel = new MyBase;                          
             $keyword = urldecode($_GET['keyword']);
             $type = urldecode($_GET['type']);
             $page = urldecode($_GET['page']);
            $url_base = '/campaign/';
            
             switch ($type) {
    case 'location':
        $sub_sql = "where  x.city like '$keyword' ";        
        break;
    case 'default':
        $sub_sql = "where  x.title like '%$keyword%' or  x.short_summary like '%$keyword%' ";
        break;         
    default:
        //$sub_sql = "where  x.title like '$keyword' and  x.desc like '$keyword' ";
        break;
}
            
           
            //getting the block data 
             $projects  = $sorted_project =array();
             $type = array(1=>'featured',2=>'promo',3=>'normal');
             $img = array(1=>'a.jpg',2=>'b.jpg',3=>'c.jpg',4=>'d.jpg',5=>'e.jpg',6=>'aa',7=>'bb.png');
           
//             //if no featured block include 1 additional normal block 
                    $count  = 10;
//             //else include regular no of blocks
             if($page==0){
                 $from  = 0;
                $to = $count;
            }else if($page==1){
                $from  = $count;
                $to = 2*$count;
            }
            else{
                $to  = $page*$count;
                $from = $to-$count;
            }
             $sql = "Select distinct z.project_id,concat('$url_base',z.project_id) as url,  x.title,  x.city as location,  y.name as category,  a.name as author,  x.short_summary as `desc`,  x.days_run as days,  x.image_url as img,  (case when (x.featured  = 1 ) then 'featured' else 'normal' end) as type,  y.color,  ROUND((SUM(z.amount)/x.goal)*100) as percent,  COUNT(distinct z.user_id) as backers,  SUM(z.amount) as pledge    from project as x  left join category as y   on x.category = y.category_id  left join user_fund_project as z   on x.id = z.project_id  join user as a  on x.user_id = a.id $sub_sql group by z.project_id  order by x.project_live_date desc limit $from,$to";
//             die($sql);
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