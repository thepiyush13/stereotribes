<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserFundProject extends BaseModel {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_fund_project';
    }
    
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    
    /**
     * Returns all user funds by id
     * @param array $ids
     * @return array
     */
    public function getUserFundsByRewardIds($ids = array()) {
        $sql = "SELECT * from user_fund_project WHERE reward_id IN (".implode(',', $ids).")  AND status = 'SUCCESS'" ;
        $result = $this->fetch($sql, array(), 'queryAll');
        return $result;
    }
    
    
    /**
     * 
     * @param integer $pid
     * @return integer
     */
    public function getToalFund($pid) {
        $sql = "SELECT amount FROM user_fund_project WHERE project_id = :PROJECTID AND status = 'SUCCESS'";
        $funds = $this->fetch($sql,array(':PROJECTID' => $pid));
        $total = 0;
        foreach($funds as $fund) {
            $total += $fund['amount'];
        }
        return $total;
    }
    
    
    public function getRelatedProjects($projectId) {
        $sql = "SELECT 
                    project.id,
                    project.title,
                    project.short_summary,
                    project.country,
                    project.city,
                    project.flip_image_url,
                    project.category,
                    project.end_date,
                    project.status,
                    project.country,
                    project.city,
                    project.goal,
                    project.end_date,
                    project.thankyou_image_url,
                    project.thankyou_video_url,
                    ufp.id as ufpid,
                    ufp.amount,
                    app_user.name as fullname,
                    app_user.email,
                    app_user.location,
                    ulp.user_id as liked
                 FROM project
                 JOIN (SELECT * FROM project WHERE id = :PROJECTID) prjTable ON project.category = prjTable.category
                 LEFT JOIN user_fund_project ufp ON ufp.project_id = :PROJECTID
                 JOIN app_user ON project.user_id = app_user.id
                 LEFT JOIN user_love_project ulp ON (ulp.project_id = project.id) AND ulp.user_id = :USERID
                 LIMIT 4";
        
        $bindValues = array(
            ':PROJECTID' => $projectId,
            ':USERID'    => Yii::app()->user->details->id
        );
        $projects = $this->fetch($sql,$bindValues);
        
        $results = array();
        foreach($projects as $project) {
            $pid = $project['id'];
            $ufpid = $project['ufpid'];
            if(!$results[$pid]) {
                $results[$pid] = $project;
            }
            $results[$pid]['funds'][$ufpid] = array('ufpid' => $ufpid, 'amount' => $project['amount']); 
        };
        
        return $results;
    }
    
    
    public function getFundingInfo($ufid) {
        $sql = "SELECT * FROM user_fund_project ufp
                JOIN reward ON reward.id = ufp.reward_id 
                JOIN project ON project.id = ufp.project_id 
                WHERE ufp.id = :UFID";
        $funds = $this->fetch($sql,array(':UFID' => $ufid),'queryRow');
        return $funds;
    }
    
    
    
    
}
