<?php

class DefaultController extends CController
{
	
    
    public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionProjects() {
                   $rawData=$table = $result = array();

            $rawData=Yii::app()->db->createCommand('SELECT x.id as project_main_id,x.*,y.*,z.* FROM project as x 
                                                                      left join user_fund_project as y
                                                                      on x.id = y.project_id
                                                                      left join user_love_project as z
                                                                      on z.project_id = x.id')->queryAll();
//            die(print_r($rawData));
            foreach ($rawData as $key => $value) {
                                $result[$key] = array_values($value);
                                
                        $result[$key]['reward_level'] = Yii::app()->db->createCommand('SELECT count(*) as reward_level from reward where project_id='.$value['project_main_id'])->queryScalar();
                        
                        $result[$key]['backers'] = Yii::app()->db->createCommand('SELECT count(*) as backers from user_fund_project where project_id='.$value['project_main_id'].' group by user_id')->queryScalar();
                        
                         $result[$key]['loved'] = Yii::app()->db->createCommand('SELECT count(*) as backers from user_love_project where project_id='.$value['project_main_id'].' group by user_id')->queryScalar();
                        
                        $result[$key]['raised'] = Yii::app()->db->createCommand('SELECT SUM(amount) as amount from user_fund_project where project_id='.$value['project_main_id'])->queryScalar();
                }
            
   
                        $arrayDataProvider=new CArrayDataProvider($rawData, array(
                                'id'=>'id',
                                 'sort'=>array(
                                        'attributes'=>array(
                                                'title', 'goal',
                                        ),
                                ), 
                                'pagination'=>false
                        ));

                        $params =array(
                            'arrayDataProvider'=>$arrayDataProvider,
                        );

                        if(!isset($_GET['ajax'])) $this->render('projects', $params);
                        else  $this->renderPartial('projects', $params);
                       
                }
                
                public function actionReporting() {
                    //get array fpr front end values 
                    $result = array();
                    $result['TOTAL_RAISED'] = $this->query("SELECT SUM(amount) as count from user_fund_project where status='SUCCESS'");
                    $result['SUCCESSFULLY_FUNDED_CAMPAIGNS'] = $this->query("SELECT COUNT(*) as count from project where project_status='success' ");
                    $result['CAMPAIGNS_LOVED'] = $this->query("  SELECT COUNT(distinct project_id) FROM user_love_project");
                    $result['TOTAL_BACKERS'] = $this->query("  SELECT COUNT(distinct user_id) FROM user_fund_project  where status='SUCCESS'");
                    $result['REPEAT_BACKERS'] = $this->query(" select  count(count) as total from (select count(*) as count from user_fund_project  where status='success'   group by user_id having( count)>1) as a");
                    $result['TOTAL_PLEDGES'] = $this->query("    SELECT COUNT(*) FROM reward ");
                    $result['AVERAGE_PLEDGE_VALUE'] = $this->query("  SELECT AVG(amount) FROM user_fund_project  where status='SUCCESS'");
                    $result['TOTAL_LAUNCHED'] = $this->query("  SELECT COUNT(*) FROM project WHERE publish_status = 'published'  ");
                    $result['UNSUCCESSFUL'] = $this->query("  SELECT COUNT(*) FROM project WHERE project_status = 'failed'  ");
                    $result['DRAFT'] = $this->query(" SELECT COUNT(*) FROM project WHERE publish_status = 'draft' ");
                    $result['FIXED'] = $this->query("  SELECT COUNT(*) FROM project WHERE funding_type = 'fixed'  ");
                    $result['FLEXIBLE'] = $this->query("  SELECT COUNT(*) FROM project WHERE funding_type = 'flexible'  ");
                    $result['NO_OF_MEMBERS'] = $this->query("      SELECT  COUNT(*) FROM tribes ");
                    $result['ACTIVE_MEMBERS'] = $this->query("      SELECT  COUNT(*) FROM tribes  where status = 'ACTIVE'  ");
                    $result['NO_OF_ABANDONED_CART'] = $this->query("    SELECT COUNT(*) FROM user_fund_project  where status='FAILED'");
                    
//                    CHART DATA
                    $total_projects = (int)$this->query("     select count(*) from project  ");
                    $success_projects = (int)$this->query("     select count(*) from project where  project_status = 'success' ");                                
                    $result['SUCCESS_FUND_RATE'] =(int)(($success_projects/$total_projects)*100) ;                    
                    $result['FIXED_VS_FLEXIBLE'] = (int)(($result['FIXED']/$result['FLEXIBLE'])*100);
                    
                    
                    $result['MOST_FUNDED_PROJECTS'] = $this->query("  select SUM(x.amount) as funded,x.project_id,y.title as project 
                        from user_fund_project as x 
  join project as y
  on x.project_id = y.id
  group by x.project_id order by funded desc limit 0,5",FALSE,TRUE);
                    
                    $result['MOST_FUNDED_CATEGORIES'] = $this->query("select SUM(x.amount) as funded,z.category_id,z.name as category from user_fund_project as x 
  join project as y
  on x.project_id = y.id
  join category as z 
  on z.category_id = y.category
  group by z.category_id order by funded desc limit 0,5",FALSE,TRUE);
                    
                    $result['MOST_POPULAR_REWARD_TYPES'] = $this->query("select SUM(x.amount) as funded,y.id,y.reward_types as reward_type from user_fund_project as x 
  join reward as y
  on x.reward_id = y.id
  group by y.reward_types order by funded desc limit 0,5",FALSE,TRUE);
                    
                    
//                    LAST ROW
                    $result['TOP_PROJECT_LOCATIONS'] = $this->query("  select count(*) as locations,city from project where project_status ='success' group by city order by locations desc",FALSE,TRUE);
                    $result['TOP_FUNDING_LOCATION'] = $this->query("select SUM(x.amount) as funded,y.id as city_id,y.city as city from user_fund_project as x 
  join project as y
  on x.project_id = y.id
  group by y.city order by funded desc",FALSE,TRUE);
                    
                    
                    //pass array to front end 
                     $params =array(
                            'reportData'=>$result,
                        );
                      
                    //render page 
                    $this->render('reporting',$params);
                }
                
                protected function query($query,$scalar=TRUE,$provider=FALSE){
                    if($scalar){
                       $field = Yii::app()->db->createCommand($query)->queryScalar(); 
                    }else{
                        if($provider){
                             $rawData = Yii::app()->db->createCommand($query)->queryAll();
                             $field = new CArrayDataProvider($rawData, array(
                                'id'=>FALSE,
                                 'sort'=>FALSE,
                                'pagination'=>false
                        ));
                        }
                        else{
                             $field = Yii::app()->db->createCommand($query)->queryAll();
                        }
                       
                    }
                    
                    return $field;
                }
                
                
                 public function actionTribes() {
                   $rawData=$table = $result = array();

            $rawData=Yii::app()->db->createCommand('select * from tribes as x  join user as y on   x.user_id = y.id  ')->queryAll();
            $arrayDataProvider=new CArrayDataProvider($rawData, array(
                                'id'=>FALSE,
                                 'sort'=>array(
                                        'attributes'=>array(
                                                'email', 'status',
                                        ),
                                ), 
                                'pagination'=>false
                        ));

                        $params =array(
                            'arrayDataProvider'=>$arrayDataProvider,
                        );

                        if(!isset($_GET['ajax'])) $this->render('tribes', $params);
                        else  $this->renderPartial('tribes', $params);
                       
                }
                
                
                
                public function actionUsers() {
                    //get array fpr front end values 
                   
                    $result = array();
                    $result['TOTAL_MEMBERS'] = $this->query("SELECT count(*) from user");
                    $result['ACTIVE_USERS'] = $this->query("select count(distinct id) from user WHERE DATE(last_login) >  CURDATE() - INTERVAL 180 DAY ");
                    $result['PROJECT_CREATORS'] = $this->query("   select count( distinct user_id) from project ");
                    $result['FUNDERS'] = $this->query(" select count(distinct user_id) from user_fund_project where status='SUCCESS' ");
                    $result['USERS_THAT_LOVE_PROJECTS'] = $this->query(" select count(distinct user_id) from user_love_project ");
                    $result['GHOST_ACCOUNTS'] = $this->query("   select count(distinct id) from app_user WHERE DATE(last_login) <  CURDATE() - INTERVAL 180 DAY  ");
                    $result['FEMALE_USERS'] = $this->query("     select count(*) from user where gender='Female' ");
                    $result['MALE_USERS'] = $this->query("     select count(*) from user where gender='Male' ");
                    $result['AGE_BAND'] = $this->query("  SELECT  CONCAT(AgeRange.MinAge,'-' ,AgeRange.MaxAge) as ageband, COUNT(*) as count 
FROM    
(
    SELECT 0 AS MinAge, 16 AS MaxAge
    UNION SELECT 16, 18
    UNION SELECT 19, 21
    UNION SELECT 22, 25
    UNION SELECT 26, 29
      UNION SELECT 30, 35
      UNION SELECT 36, 40
    UNION SELECT 40, 45
      UNION SELECT 40, 120
) AgeRange
INNER JOIN user
ON ROUND(DATEDIFF(CAST(NOW() as DATE), CAST(dob as DATE)) / 365, 0) BETWEEN AgeRange.MinAge AND AgeRange.MaxAge 
GROUP BY AgeRange.MinAge, AgeRange.MaxAge   ",FALSE,TRUE);
                    $result['USER_ACTIVITY'] = $this->query("  SELECT  CONCAT(ActivityRange.MinActivity,'-' ,ActivityRange.MaxActivity) as Activityband, COUNT(*) as count
FROM    
(
    SELECT 7 AS MinActivity, NULL AS MaxActivity
  UNION SELECT 7, 29
    UNION SELECT 30, 180
    UNION SELECT 181, 365
    UNION SELECT 365, 25    
) ActivityRange
INNER JOIN user
ON ROUND(DATEDIFF(CAST(NOW() as DATE), CAST(last_login as DATE)) , 0) BETWEEN ActivityRange.MinActivity AND ActivityRange.MaxActivity 
GROUP BY ActivityRange.MinActivity, ActivityRange.MaxActivity ",FALSE,TRUE);
                    $result['2_LAUNCHED_PROJECTS'] = $this->query("      SELECT COUNT(distinct user_id) AS count
FROM project where publish_status = 'published'
GROUP BY user_id
HAVING COUNT(*) > 1 ");
                    $result['2_SUCCESS_PROJECTS'] = $this->query("      SELECT COUNT(distinct user_id) AS count
FROM project where project_status = 'success' and funding_type='fixed'
GROUP BY user_id
HAVING COUNT(*) > 1 ");
                    $result['TOP_5_PROJECT_USERS'] = $this->query(" select count(*) count ,y.name,y.email from project as x 
 join user as y 
 on x.user_id = y.id
  where x.project_status = 'success' group by x.user_id order by count desc limit 0,5  ",FALSE,TRUE);
                    $result['TOP_5_FUNDED_USERS'] = $this->query(" select SUM(x.amount) as amount ,y.name,count(*) as projects from user_fund_project  as x 
 join user as y 
 on x.user_id = y.id
  where x.status = 'SUCCESS' group by x.user_id order by projects desc limit 0,5
  ",FALSE,TRUE);
                    $result['USERS_BY_LOCATION'] = $this->query("       select COUNT(*) as count,location from user where location IS NOT NULL group by location order by count desc  ",FALSE,TRUE);
                    
                     $result['MOST_ACTIVE_USERS'] = $this->query("        select name,email,last_login  from user  ORDER BY DATE(last_login) desc LIMIT 0,5 ",FALSE,TRUE);
                     
                     //funders vs lovers vs creators graph 
                     $funders = $this->query("    select count(distinct user_id) from user_fund_project ");
                     $creators = $this->query("    select count(distinct user_id) from project ");
                     $lovers = $this->query("    select count(distinct user_id) from user_love_project ");
                     
                     $base = max($funders,$creators,$lovers);
                     $funders_percent =  ($funders/$base)*100 ;
                     $creators_percent =  ($creators/$base)*100 ;
                     $lovers_percent =  ($lovers/$base)*100 ;
                     
                     $result['FUNDERS'] = (int)$funders ;
                     $result['CREATORS'] = (int)$creators;
                     $result['LOVERS'] = (int)$lovers;
                     
                     $result['FUNDERS_PERCENT'] = (int)$funders_percent ;
                     $result['CREATORS_PERCENT'] = (int)$creators_percent;
                     $result['LOVERS_PERCENT'] = (int)$lovers_percent;
                    //end 
                    
                    
                    
                    //pass array to front end 
                     $params =array(
                            'reportData'=>$result,
                        );
                      
                    //render page 
                    $this->render('users',$params);
                }
                
                
                public function actionCategories() {
                    //get array fpr front end values 
                   
                    $result = $cats  = array();
                    
                    //find categories and information 
                     $cats = $this->query("  select distinct x.category,y.name from project as x 
  join category as y 
  on x.category = y.category_id
  group by x.category ",FALSE,FALSE);
                    

                    //get category specific data 
                     foreach ($cats as  $key=>$cat) {
                         $category_id = $cat['category'];
                        $result[$key] = array(
                            'id'=>$category_id,
                            'name'=>$cat['name'],
                            'data'=>array(),
                            'funded'=>$this->query(" select sum(x.amount) as value from user_fund_project as x   join project as y    on x.project_id = y.id   and x.status = 'SUCCESS'   and y.category  = {$category_id} ")
                        );
                        
                        //RAISED
                        $result[$key]['data'][] =  $this->query(" select 'RAISED' as field,sum(x.amount) as value from user_fund_project as x   join project as y    on x.project_id = y.id   and x.status = 'SUCCESS'   and y.category  = {$category_id} ",FALSE,FALSE);
                        //successful projects
                        $result[$key]['data'][] = $success_projects =  $this->query(" select 'SUCCESSFUL PROJECTS ' as field,  count(distinct id) as value from project where project_status= 'success' and category  = {$category_id} ",FALSE,FALSE);                       
                        //loved
                        $result[$key]['data'][] =  $this->query(" select 'LOVED' as field,count(distinct x.user_id) as value from user_love_project as x 
  join project as y 
  on x.project_id = y.id
  where y.category  = {$category_id} ",FALSE,FALSE);
                        //UNSUCCESSFUL  PROJECTS 
                        $result[$key]['data'][] =  $this->query(" select 'UNSUCCESSFUL PROJECTS' as field,count(*) as value from project  as value  where project_status!='SUCCESS'  and category  = {$category_id} ",FALSE,FALSE);                        
//                        FIXED 
                        $result[$key]['data'][] =  $this->query(" select 'FIXED' as field,count(*) as value from project  as value  where funding_type='fixed'  and category  = {$category_id} ",FALSE,FALSE);
//                        FLEXIBLE 
                        $result[$key]['data'][] =  $this->query(" select 'FLEXIBLE' as field,count(*) as value from project  as value    where funding_type='flexible'  and category  = {$category_id} ",FALSE,FALSE);
//                        BACKERS 
                        $result[$key]['data'][] =  $this->query(" select 'BACKERS' as field,count(distinct x.user_id) as value from user_fund_project as x 
  join project as y 
  on x.project_id = y.id
  where y.category  = {$category_id} ",FALSE,FALSE);
//                        DRAFT  (UNLAUNCHED)
                        $result[$key]['data'][] =  $this->query(" select 'DRAFT (UNLAUNCHED)' as field,count(*) as value from project   where project_status='draft'   and category  = {$category_id} ",FALSE,FALSE);
//                        LIVE
                        $result[$key]['data'][] =  $this->query(" select 'LIVE' as field,count(*) as value from project   where publish_status='published'  and category  = {$category_id} ",FALSE,FALSE);
                         //SUCCESS RATE
                        $total_projects  =   $this->query("  SELECT COUNT(*) FROM project where category  = {$category_id} ");
                        $success_percent = (int)(($success_projects[0]['value']/$total_projects)*100);
                                $result[$key]['data'][] =  array( 
                                    array(
                                    'field'=>'(%)SUCCESS RATE',
                                    'value' =>$success_percent
                                )
                            );
                        

                    }
                   
                    //sorting result from most funded cat to least
                    $funded = array();
                    foreach ($result as $key => $row)
                    {
                        $funded[$key] = $row['funded'];
                    }
                    array_multisort($funded, SORT_DESC, $result);
                    
                    
                    //pass array to front end 
                     $params =array(
                            'reportData'=>$result,
                        );
                      
                    //render page 
                    $this->render('categories',$params);
                }
                
                
                
                
                public function actionFinancial() {
                    
                    
                    //array for stereotribes commission settings in %
                    $commission = array(
                        'fixed'=>7,
                        'flexible'=>10
                    );
                    //get array for front end values 
                    
                    
                    $result = array();
                    $result['TOTAL_RAISED'] = $this->query("SELECT SUM(amount) as count from user_fund_project where status='SUCCESS'");
                    
                    //st revenue from fixed and flexible project s
                    $fixed_project_total = $this->query("  select SUM(y.amount) from project as x   join user_fund_project as y    on x.id= y.user_id   where x.funding_type = 'fixed' and y.status='success' ");
                    $flexible_project_total = $this->query("  select SUM(y.amount) from project as x   join user_fund_project as y    on x.id= y.user_id   where x.funding_type = 'flexible' and y.status='success'  ");
                    //st revune = some% of fixed + some other % of flexible project amount
                    $result['STEREOTRIBES_REVENUE'] = (int)($fixed_project_total*$commission['fixed']/100 )+(int)($flexible_project_total*$commission['flexible']/100 );
                    
                    $result['LIVE_FUNDED'] = $this->query("select SUM(x.amount) from user_fund_project as x   join project as y    on y.id= x.user_id   where y.publish_status = 'published' and x.status='success'  ");
                    $result['AVG_CAMPAIGN_AMOUNT'] = $this->query(" select AVG(x.goal) from project as x where x.publish_status='published'  ");
                    $result['FIXED_RASIED'] = $fixed_project_total;
                   
                    $result['FLEXIBLE_RAISED'] = $flexible_project_total;
                    $result['SUCCESSFULLY_RAISED'] = $this->query("  select SUM(y.amount) from project as x   join user_fund_project as y    on x.id= y.user_id   where x.project_status = 'success' and y.status='success' ");
                    $result['UNSUCCESSFULLY_RAISED'] = $this->query("  select SUM(y.amount) from project as x   join user_fund_project as y    on x.id= y.user_id   where x.project_status = 'success' and y.status='success' ");
                    $total_projects_goal  =   $this->query("  SELECT SUM(goal) FROM project  ");
                    $total_money_raised = $fixed_project_total+$flexible_project_total;
                    $result['SUCCESS_RATE'] = (int)( ($total_money_raised)/($total_projects_goal )*100);
                    
                    
                    
                    $result['MONEY_PROJECT'] = $this->query("   SELECT
  SUM(CASE WHEN total BETWEEN 0 AND 1000 THEN 1 ELSE 0 END) as `0-1000`,
  SUM(CASE WHEN total BETWEEN 1001 AND 10000 THEN 1 ELSE 0 END) AS `1000-10000`,
   SUM(CASE WHEN total BETWEEN 10001 AND 20000 THEN 1 ELSE 0 END) AS `10000-20000`,
    SUM(CASE WHEN total BETWEEN 20001 AND 100000 THEN 1 ELSE 0 END) AS `20000-100000`,
    SUM(CASE WHEN total > 100001 THEN 1 ELSE 0 END) AS `100000+`,
  COUNT(*) AS `All Values`
FROM
  ( select SUM(amount) as total from user_fund_project group by project_id) as raised ",FALSE,FALSE);
                     $result['AVG_PLEDGE_AMOUNT'] = $this->query(" select AVG(x.amount) from user_fund_project as x where x.status='success'  ");
                     $result['FEATURED_RAISED'] = $this->query("  select SUM(y.amount) from project as x   join user_fund_project as y    on x.id= y.user_id   where  x.featured=1 ");
                     $result['FEATURED_CAMPAIGNS'] = $this->query("  select count(distinct y.user_id) from project as x   join user_fund_project as y    on x.id= y.user_id   where  x.featured=1 ");
                     $result['FEATURED_SUCCESS_RATE'] = (int)( ($result['FEATURED_RAISED'] )/($total_money_raised )*100);
                     
                     
                    $result['TOP_STEREOTRIBES_REVENUE'] = $this->query("  select y.title as project,z.name as category,concat(y.city,'-',y.country) as location, SUM(x.amount) as funded from user_fund_project as x join project as y on x.project_id = y.id left join category as z on y.category = z.category_id where y.project_status='success'    group by x.project_id order by funded desc  ",FALSE,TRUE);
                   
                    $result['RAIED_VS_DATE'] = $this->query("  select id,SUM(amount) as raised,DATE(timestamp) as date from user_fund_project where status ='success' group by date  ",FALSE,FALSE);
//                            die(print_r($result));
                    //pass array to front end 
                     $params =array(
                            'reportData'=>$result,
                        );
                    
                    
                    //render page 
                    $this->render('financial',$params);
                }
}