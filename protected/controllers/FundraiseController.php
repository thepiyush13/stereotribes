<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FundraiseController extends Controller {

    public function actionContribute($pid, $rewardId = null) {

        $isPost = Yii::app()->request->isPostRequest;
        $pid = ($isPost) ? $_POST['projectId'] : $pid;
        $campaign = Campaign::instance($pid);

        //Setting the selected reward
        $selectedReward = null;
        foreach ($campaign->rewards as $reward) {
            if ($reward->id == $rewardId) {
                $selectedReward = $reward;
            }
        }
        
        //echo "<pre>",print_r($campaign);exit;
        
        $this->render('contribute', array(
            'campaign' => $campaign,
            'selectedReward' => $selectedReward,
        ));
        
    }
    
    
    /**
     * Function to save the funding details
     */
    public function actionSaveUserFund() {
        if (Yii::app()->request->isAjaxRequest) {
            $form = new FundraiseFirstForm();
            $form->setAttributes($_POST);
            if ($form->validate()) {
                $ufp = new UserFundProject();
                $ufp->user_id = Yii::app()->user->getId();
                $ufp->project_id = $_POST['projectId'];
                $ufp->amount = $_POST['amount'];;
                $ufp->timestamp = time();
                $ufp->shipping_address = implode(",",$_POST['shippingAddress']);
                $ufp->reward_id = $_POST['rewardId'];
                $ufp->reward_received_status = 0;
                $ufp->status = 'FAILED';
                
                //print_r($ufp->attributes);exit;
                $ufp->save();
                
                $errors = $ufp->getErrors();
                if($errors) {
                   Ajax::error($errors);
                } 
                Ajax::success($ufp->attributes);
            }
           //Sends validation error 
           Ajax::error(Utils::formatErrors($form));
        }
    }
    
    
    public function actionPayment($pid) {
        
        
        $this->render('payment');
    }
    
    
    public function actionShare() {
        $this->render('share');
    }

}
