<?php

class CreateValidator extends CFormModel {
    
    public $goal;
    public $category;
    public $projectFor;
    public function rules() {
        return array(
            array('goal', 'required'),
            array('category', 'required'),
            array('projectFor', 'required'),
        );
    }
}