<?php

class AppUser {

    public $id;
    public $name;
    public $email;
    public $location;
    public $connects;

    public function __construct($id) {
        if (!$id)
            return;
        $this->id = $id;
        $this->fetchAppUser();
    }

    public function fetchAppUser() {
        $sql = "SELECT * from user where id = :USER_ID";
        $bindValues = array(':USER_ID' => $this->id);
        $result = Yii::app()->db
                        ->createCommand($sql)
                        ->bindValues($bindValues)
                        ->queryRow();
        
        if($result) {
            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->location = $result['location'];
            $this->status = $result['status'];
        }
    }

}