<?php

class Campaign extends CFormModel {

    private $id;
    private $title;
    private $shortSummary;
    private $country;
    private $city;
    private $flipImageUrl;
    private $shortUrl;
    private $category;
    private $goal;
    private $currency;
    private $projectFor;
    private $fundingType;
    private $daysRun;
    private $endDate;
    private $paymentDate;
    private $mediaType;
    private $videoUrl;
    private $imageUrl;
    private $pitchStory;
    private $mainLink;
    private $thankyouMediaType;
    private $thankyouMediaUrl;
    private $campaignUrl;
    private $status;
    private $socialAmplifierStatus;

    /**
     * User object (campaign owner)
     */
    private $user;

    /**
     * Stores rewards
     * 
     * @var array of Reward objects 
     */
    private $rewards;

    /**
     * External Links 
     * 
     * @var array of Links object
     */
    private $links;

    /**
     * Tribes associated with the campaigns
     * 
     * @var array of Tribe object
     *  
     */
    private $tribes;

    /**
     * Social amplifiers based on target
     * 
     * @var array of SocialAmplifier object
     *  
     */
    private $socialAmplifers;

    public function __construct() {
        ;
    }

    private function getConfig() {
        return array(
            'categories' => Config::getCategories(),
            'projectsFor' => Config::getCategories(),
            'currencies' => Config::getCurrencies(),
            'rewardTypes' => Config::rewardTypes(),
        );
    }

    /**
     * Step 1 
     */
    public function getStep1() {
        //if requested with id fetch from database
        if(isset($_GET['id']) && $_GET['id']) {
            
        }
        
        
        $result = array(
            'config' => $this->getConfig(),
            'user' => '',
            'data' => ''
        );
        Ajax::success($result);
    }

    /**
     * Step 2 
     */
    public function getStep2() {
        $result = array(
            'config' => $this->getConfig(),
            'user' => '',
            'data' => ''
        );
        Ajax::success($result);
    }

    /**
     *  Create campaign step2, should be an update
     */
    public function createCampaign($data) {
        $validator = new CreateCampaignValidator();
        $validator->setAttributes($data);
        if ($validator->validate()) {
            $command = Yii::app()->db->createCommand();
            $result = $command->insert('project', $data);
            Ajax::success($result);
        } else {
            Ajax::error($validator->getErrors());
        }
    }

    /**
     *  Create campaign
     */
    public function create($data) {
        $validator = new CreateValidator();
        $validator->setAttributes($data);
        if ($validator->validate()) {
            $command = Yii::app()->db->createCommand();
            if ($command->insert('project', $this->toUnderScore($data))) {
                $result = array();
                $result['campaignId'] = Yii::app()->db->getLastInsertId();
                Ajax::success($result);
            } else {
                
            }
        } else {
            Ajax::error($validator->getErrors());
        }
    }

    /**
     * Camel case to underscore
     * @param type $sectionName 
     */
    private function toUnderScore($dataAr = array()) {
        if (!is_array($dataAr))
            return;
        $_data = array();
        foreach ($dataAr as $field => $value) {
            $fieldUnderScore = Utils::fromCamelCase($field);
            $_data[$fieldUnderScore] = $value;
        }
        return $_data;
    }

    public function validateSection($sectionName = '') {
        switch ($sectionName) {
            case '':

                break;
        }
    }

    public function uploadFlipImage() {
        $options = array(
            'name' => 'flip_' . $_POST['campaignId'] . md5(rand(1, 1000))
        );
        $uploadedImage = CUploadedFile::getInstanceByName('flipImage');
        $uploader = new ImageUploader($uploadedImage, $options);
        if ($uploader->process()) {
            $uploader->getImagePath();
            Ajax::success(array(
                'picUrl' => $this->getUrl($uploader->getImagePath()),
            ));
        } else {
            Ajax::error($uploader->getError());
        }
    }

    private function getUrl($url) {
        return 'http://' . $_SERVER['HTTP_HOST'] . $url;
    }

}

class AppUser {

    private $id;
    private $name;
    private $email;
    private $connects;

}

/*
(id, name, dob, age, email, password, location, fbid=kalpit)
*/
