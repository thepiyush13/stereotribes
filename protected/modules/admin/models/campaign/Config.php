<?php
class Config {
    public $categories = array();
    public $rewardTypes = array();
    
    public static function getCategories() {
        return array(
            //array('id' => 'musicplus', 'name' => 'Music+', 'iconUrl' => '', 'class' => 'musicplus-red', 'colorCode' => ''),
            array('id' => 'arts', 'name' => 'Arts', 'iconUrl' => '', 'class' => 'color-arts', 'colorCode' => ''),
            array('id' => 'technology', 'name' => 'Technology', 'iconUrl' => '', 'class' => 'color-technology', 'colorCode' => ''),
            array('id' => 'research', 'name' => 'Research', 'iconUrl' => '', 'class' => 'color-research', 'colorCode' => ''),
            array('id' => 'commercial', 'name' => 'Commercial', 'iconUrl' => '', 'class' => 'color-commercial', 'colorCode' => ''),
            array('id' => 'imaginative', 'name' => 'Imaginative', 'iconUrl' => '', 'class' => 'color-imaginative', 'colorCode' => ''),
            array('id' => 'performance', 'name' => 'Performance', 'iconUrl' => '', 'class' => 'color-performance', 'colorCode' => ''),
            array('id' => 'film', 'name' => 'Film', 'iconUrl' => '', 'class' => 'color-', 'colorCode' => ''),
            array('id' => 'games', 'name' => 'Games', 'iconUrl' => '', 'class' => 'color-', 'colorCode' => ''),
            array('id' => 'publishing', 'name' => 'Publishing', 'iconUrl' => '', 'class' => 'color-', 'colorCode' => ''),
        );
    }
    
    public static function rewardTypes() {
        return array(
            array('id' => 'educational', 'name' => 'Educational'),
            array('id' => 'under18', 'name' => 'Under 18'),
            array('id' => 'swag', 'name' => 'Swag'),
        );
    }
    
    
    public static function getProjectFor() {
        return array(
            array('id' => 'team', 'name' => 'Team'),
            array('id' => 'individual', 'name' => 'Individual'),
        );
        
    }
    
    public static function getCurrencies() {
        return array(
            array('id' => 'GBP', 'name' => 'GBP', 'symbol' => 'GBP'),
            array('id' => 'dollar', 'name' => 'Dollar', 'symbol' => '$'),
        );
        
    }
    
    public static function stepFields($id) {
       return array(
            'step1' => array('category', 'goal', 'currency', 'project_for')
            
        );
    }
    
    
}

