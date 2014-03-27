<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Providers
 *
 * @author abhishek
 */
class Providers extends CActiveRecord {
    public function tableName() {
        return 'providers';
    }
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function getProvidersList() {
        $query = "SELECT * FROM providers";
        return $this->dbConnection
                ->createCommand($query)
                ->queryAll();
    }
    
    
}

?>
