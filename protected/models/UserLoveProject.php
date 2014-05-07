<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserLoveProject extends BaseModel {
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_love_project';
    }
    
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    
    public function fetchLike($userId,$projectId) {
        $sql = "SELECT * FROM user_love_project WHERE user_id=:USERID and project_id=:PROJECTID";
    }
}


