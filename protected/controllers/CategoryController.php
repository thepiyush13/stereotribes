<?php

class CategoryController extends Controller
{
    
    public $layout = 'common';
	public function actionIndex($id)
	{
		
            //get the category id 
            if(!$id){
                $this->redirect('/');
            }
            $cat_id = $id;
            //get category name 
            $sql = 'select name from category where category_id='.$cat_id;
            $data['cat_name'] = Yii::app()->db->createCommand($sql)->queryScalar();
            //get the html blocks for this catgeory 
            $data['cat_id']  = $cat_id;
            
            //put html to front page 
            
            //display 
            
            $this->render('index',array('data'=>$data));
	}

	public function actionPage()
	{
		$this->render('page');
	}

	public function actionSearch()
	{
		$this->render('search');
	}

	 public function actionGet(){
            
            $myModel = new MyBase;                          
            $page = (int)Yii::app()->request->getParam('page');
            $cat_id = (int)Yii::app()->request->getParam('cat_id');
            $url_base = '/campaign/';
            
           
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
             $sql = "Select distinct z.project_id,concat('$url_base',z.project_id) as url,  x.title,  x.city as location,  y.name as category,  a.name as author,  x.short_summary as `desc`,  x.days_run as days,  x.image_url as img,  (case when (x.featured  = 1 ) then 'featured' else 'normal' end) as type,  y.color,  ROUND((SUM(z.amount)/x.goal)*100) as percent,  COUNT(distinct z.user_id) as backers,  SUM(z.amount) as pledge    from project as x  left join category as y   on x.category = y.category_id  left join user_fund_project as z   on x.id = z.project_id  join user as a  on x.user_id = a.id  where  y.category_id = $cat_id group by z.project_id  order by x.project_live_date desc limit $from,$to";
             
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
}