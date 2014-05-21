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
        $rewardIds = array();
        if(!$campaign->rewards){
            $this->redirect('/');
            return ;
        }
        foreach ($campaign->rewards as $reward) {
            if ($reward->id == $rewardId) {
                $selectedReward = $reward;
            }
            $rewardIds[] = $reward->id;
        }

        //Getting rewards sold
        $ufp = new UserFundProject();
        $funds = $ufp->getUserFundsByRewardIds($rewardIds);
        $rewardSold = array();
        if ($funds) {
            foreach ($funds as $fund) {
                if (!$rewardSold[$fund['reward_id']]) {
                    $rewardSold[$fund['reward_id']] = 1;
                } else {
                    $rewardSold[$fund['reward_id']] ++;
                }
            }
        }

        $this->render('contribute', array(
            'campaign' => $campaign,
            'selectedReward' => $selectedReward,
            'rewardSold' => $rewardSold
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
                $ufp->amount = $_POST['amount'];
                $ufp->timestamp = time();
                $ufp->shipping_address = implode(",", $_POST['shippingAddress']);
                $ufp->reward_id = $_POST['rewardId'];
                $ufp->reward_received_status = 0;
                $ufp->status = 'FAILED';
                
                //print_r($ufp->attributes);exit;
                $ufp->save();

                $errors = $ufp->getErrors();
                if ($errors) {
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

    public function actionShare($pid, $ufid) {
        $ufp = new UserFundProject();
        $fundingInfo = $ufp->getFundingInfo($ufid);
        $totalFund = $ufp->getToalFund($pid);
        $relatedProjects = $ufp->getRelatedProjects($pid);

        // echo "<pre>",print_r($fundingInfo);exit;
        $this->render('share', array(
            'fundingInfo' => $fundingInfo,
            'totalFund' => $totalFund,
            'relatedProjects' => $relatedProjects
        ));
    }

    public function actionLikeOrUnlikeProject() {
        if (Yii::app()->request->isAjaxRequest) {
            
            if(Yii::app()->user->isGuest ){
                 Ajax::success("guest");                 
            }
            
            $pid = $_POST['projectId'];
            $action = $_POST['action'];

            if (!$pid && !is_numeric($pid)) {
                Ajax::error("Invalid parameters");
            }

            $project = Project::model()->findByPk($pid);
            if (!$project) {
                Ajax::error("Project not found");
            }

            $ulp = UserLoveProject::model()->find(array(
                'condition' => 'project_id=:PROJECTID AND user_id=:USERID',
                'params' => array(':PROJECTID' => $pid, ':USERID' => Yii::app()->user->details->id),
            ));
            
            if ($ulp) {
                (!$ulp->delete()) 
                    ? Ajax::error('delete failed')
                    : Ajax::success('unliked');
            } else {
                $model = new UserLoveProject();
                $model->user_id = Yii::app()->user->getId();
                $model->project_id = $pid;
                $model->timestamp = date('Y-m-d');
                
                if (!$model->save()) {
                    Ajax::error($model->getErrors());
                }
                
                Ajax::success('liked');
            }

        }
    }
    
    
    public function actionSendChat() {
        if (Yii::app()->request->isAjaxRequest) {
            
            $text = $_POST['content'];
            if(!$text) {
                Ajax::error("Content can't be null");
            }
            
            $mailQ = new MailQueue();
            $add = $mailQ->add('support@steriotribes.com',"Chat message",$text);
            
            if($add) {
                Ajax::success('added');
            }
            
            Ajax::error($mailQ->getErrors());
            
        }
        
    }

}
