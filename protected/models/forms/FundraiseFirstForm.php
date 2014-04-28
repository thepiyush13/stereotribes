<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FundraiseFirstForm extends CFormModel {
    
    
    public $projectId;
    public $amount;
    public $address;
    public $rewardId;
    
    public function rules()
    {
        return array(
            array('projectId, amount,rewardId', 'required'),
        );
    }
    
}