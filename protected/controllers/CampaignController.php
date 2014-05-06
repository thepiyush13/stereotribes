<?php

class CampaignController extends Controller {

    public $layout = '//layouts/site';

    /**
     * campaign details 
     */
    public function actionIndex($id) {

        if (!$id)
            echo "invalid";
        $campaign = null;
        if (isset($_GET['id']) && $_GET['id']) {
            $campaign = Campaign::instance($_GET['id']);
            //get fund stat
            $campaign->getFundStat();
            $campaign->fetchCreator(); //get campaing creater
        }
        

        $result = array(
            'config' => $campaign->getConfig(),
            'user' => '',
            'data' => $campaign
        );
        //for comment module 
         $model = Project::model()->findByAttributes(array( 'id'=> $_GET['id'] ));
        $this->render('detail', array('data' => $result['data'], 'config' => $result['config'],'model'=>$model));
    }

    public function actionCreate() {
        $this->render('step1');
    }

    public function actionStep1() {
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

    public function actionStep5() {
        $this->render('step5');
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
            'campaign.saveLinks',
            'campaign.saveMediaLinks',
            'campaign.removeLink',
            'campaign.removeMediaLink',
            'campaign.processMails',
            'campaign.inviteTribes',
            'campaign.saveAmplifers',
            'campaign.saveCampaign',
            'campaign.saveFund',
            'campaign.saveThankyouVideo',
            'campaign.goLive',
            'campaign.saveStep4',
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
            'campaign.uploadMediaLinkImage',
            'campaign.fundThankyouUploadImage',
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

    public function actionCss() {
        $categories = Config::getCategories();
        foreach ($categories as $c) {
            $color = $this->hex2rgb($c['colorCode']);
            $colorOpacity = $this->hex2rgb($c['colorCode'], true);
            $name = strtoupper($c['name']);
            echo $color;
            $css .= <<< EOD
            
            body.{$c['id']} {
                background: {$color};
            }
            
            body.{$c['id']}:before {
                position: absolute;
                content: '{$name}';
                left: -4px;
                top: 320px;
                color: {$colorOpacity};
                font-size: 78px;
                font-family: 'lotregular';
                -webkit-transform: rotate(-90deg);
                -moz-transform: rotate(-90deg);
                -o-transform: rotate(-90deg);
                -ms-transform: rotate(-90deg);
                transform: rotate(-90deg);
                
            }
            
EOD;
        }

        echo $path = realpath(Yii::app()->basePath . '/../css/category.css');
        file_put_contents($path, $css);
    }

    public function hex2rgb($hex, $opacity = false) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        $o = $opacity ?  'rgba('.implode(', ', $rgb).', 0.80)' :  'rgb('.implode(', ', $rgb).')';
        return $o;
        //return implode(",", $rgb); // returns the rgb values separated by commas
        //return $rgb; // returns an array with the rgb values
    }

    /**
     * 
     */
}
