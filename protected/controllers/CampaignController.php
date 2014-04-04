<?php

class CampaignController extends Controller {

    public $layout = '//layouts/site';

    public function actionIndex() {
        $this->render('index');
    }

    public function actionCreate() {
        $this->render('step1');
    }

    public function actionStep2() {
        $this->render('step2');
    }

    public function actionStep3() {
        $this->render('step3');
    }
    
    public function actionStep4() {
        $this->render('step4');
    }

    public function actionWelcome() {
        $this->render('index');
    }

    private function getPost() {
        return ($post = Utils::reqPayload()) ? $post : $_POST;
    }

    /**
     * Handles ajax request  
     */
    public function actionApi() {

        //angular js post fix
        $_POST = $this->getPost();
        //print_r($_POST);
        //valid end points to call
        $methodList = array(
            'campaign.getStep1',
            'campaign.getStep2',
            'campaign.getStep3',
            'campaign.getStep4',
            'campaign.getStep5',
            'campaign.create',
            'campaign.designFlip',
            'campaign.fundTarget',
            'campaign.mediaLinks',
            'campaign.saveFlipbox',
            'campaign.saveGoalSetting',
            'campaign.saveAwesomeCampaign',
            'campaign.saveReward',
            'campaign.deleteReward',
        );

        $result = '';
        $error = '';
        if (Yii::app()->request->isAjaxRequest) {
            if (isset($_POST['method']) && $_POST['method']) {
                if (in_array($_POST['method'], $methodList)) {
                    $method = $this->getMethodName($_POST['method']);
                    $campaignModel = new Campaign();
                    $campaignModel->$method($_POST['data']);
                } else {
                    echo json_encode(array('error' => 'Invalid request'));
                }
            } else {
                echo json_encode(array('error' => 'Must request with a valid method name'));
            }

            Yii::app()->end();
        } else {
            echo "Will redirect you";
        }
    }

    public function actionUpload() {
        $methodList = array(
            'campaign.uploadFlipImage',
            'campaign.uploadAwesomeCampaignImage',
        );

        $result = '';
        $error = '';
        if (isset($_POST['method']) && $_POST['method']) {
            if (in_array($_POST['method'], $methodList)) {
                $method = $this->getMethodName($_POST['method']);
                $campaignModel = new Campaign();
                $campaignModel->$method($_POST['data']);
            } else {
                echo json_encode(array('error' => 'Invalid request'));
            }
        } else {
            echo json_encode(array('error' => 'Must request with a valid method name'));
        }

        Yii::app()->end();
    }

    /**
     * return class method to call - after dot
     */
    private function getMethodName() {
        $request = explode('.', $_POST['method']);
        return $request[1];
    }

}
