<?php

class AdminController extends Controller
{
    
    
    public $layoutPath = 'admin.views.layouts';
    public $layout = 'admin';
    
    /**
     *  ACL Filter
     */
    public function filters() {
        // print_r(Yii::app()->user);exit;
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Define Access Rules
     * @return type array
     */
    public function accessRules() {
        return array(
            array('allow', // deny all users
                'roles' => array('admin','superadmin','users'),
            ),
            
            array('deny',
                'roles' =>  array('guest')),
            
        );
    }
    
    

}
