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
                $ufp->user_id = Yii::app()->user->details->id;
                $ufp->project_id = $_POST['projectId'];
                $ufp->amount = $_POST['amount'];;
                $ufp->timestamp = time();
                $ufp->shipping_address = implode(",", $_POST['shippingAddress']);
                $ufp->reward_id = $_POST['rewardId'];
                $ufp->reward_received_status = 0;
                $ufp->status = 'FAILED';
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

        // echo "<pre>",print_r($relatedProjects);exit;
        $this->render('share', array(
            'fundingInfo' => $fundingInfo,
            'totalFund' => $totalFund,
            'relatedProjects' => $relatedProjects
        ));
    }

    public function actionLikeOrUnlikeProject() {
        if (Yii::app()->request->isAjaxRequest) {
            $pid = $_POST['projectId'];
            $action = $_POST['action'];
            
            if ($pid && is_numeric($pid)) {
                $project = Project::model()->findByPk($pid);
                if ($project) {
                    if ($action === 'like') {
                        $ulp = new UserLoveProject();
                        $ulp->setAttributes(array(
                            'user_id' => Yii::app()->user->details->id,
                            'project_id' => $pid
                        ));
                        
                        if(!$ulp->save()) Ajax::error($ulp->getErrors());
                        
                    } else {
                        $ulp = Project::model()->find(array(
                            'condition'=>array('projectId=:PROJECTID','user_id=:USERID'),
                            'params'=>array(':PROJECTID'=>$pid,':USERID' => Yii::app()->user->details->id),
                        ));
                        
                        if(!$ulp) Ajax::error("Row not found");
                        
                        $delete = Project::model()->deleteByPk($ulp->id);
                        if(!$delete)  Ajax::error('delete failed');
                    }
                    
                    //Send success response
                    Ajax::success($action);
                    
                } else {
                    Ajax::error("Project not found");
                }
            }
        }
    }

}
