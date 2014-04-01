<?php

class CreateCampaignValidator extends CFormModel {
    
    public $title;
    public $short_summary;
    public function rules() {
        return array(
            array('title', 'required'),
            array('short_summary', 'required'),
        );
    }
}
