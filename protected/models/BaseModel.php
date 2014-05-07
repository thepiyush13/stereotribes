<?php

/**
 * This model is used to share some common functions to all models
 */
class BaseModel extends CActiveRecord {
    
    
    public function mapAttrs($values,$safeOnly = false) {
        $this->setAttributes(Utils::underscoreKeys($values), $safeOnly);
    }
    
    
    public function errorMessage() {
       return Utils::formatErrors($this);
    }
    
    
    public function executeQuery($sql="",$bindValues = array()) {
        return Yii::app()->db
                    ->createCommand($sql)
                    ->bindValues($bindValues)
                    ->execute();
    }
    

     public function insertData($table="", $data="") {
        return Yii::app()->db
                    ->createCommand()
                    ->insert($table, $data);
    }
    
    public function fetch($sql="", $bindValues = array(),$method = 'queryAll') {
        return Yii::app()->db
                    ->createCommand($sql)
                    ->bindValues($bindValues)
                    ->{$method}();
    }
    
    
    public function getDbCmnd() {
        return Yii::app()->db->createCommand();
    }
    
    /**
     * query table with given conditions
     * @param type $select
     * @param type $table
     * @param type $where
     * 
     */
    public function selectWhere($select = array(), $table = "", $where = array(), $joins = array(), $method = 'queryAll') {
        return Yii::app()->db
                    ->createCommand()
                    ->select(($select) ? $select : '*')
                    ->from($table)
                    //->setJoin('INNER JOIN lead_contacts ON leads.contact_id = lead_contacts.user_id')
                    ->where($where)
                    ->{$method}();
                
    }
    
}
