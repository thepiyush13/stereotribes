<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MailQueue extends BaseModel {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'mail_queue';
    }
    
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    
    public function add($to,$subject,$body) {
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->created_on = date('Y-m-d h:i:s');
        return $this->save();
    }
    
    
    
    
}