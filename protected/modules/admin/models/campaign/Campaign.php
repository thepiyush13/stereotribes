<?php

class Campaign extends CFormModel {

    public $id;
    public $title;
    public $shortSummary;
    public $country;
    public $city;
    public $flipImageUrl;
    public $shortUrl;
    public $category;
    public $goal;
    public $currency;
    public $projectFor;
    public $fundingType;
    public $daysRun;
    public $endDate;
    public $paymentDate;
    public $mediaType;
    public $videoUrl;
    public $imageUrl;
    public $pitchStory;
    public $mainLink;
    public $thankyouMediaType;
    public $thankyouMediaUrl;
    public $campaignUrl;
    public $status;
    public $socialAmplifierStatus;
    public $userId;

    /**
     * instace 
     */
    public static $_instance;

    /**
     * User object (campaign owner)
     */
    public $user;

    /**
     * Stores rewards
     * 
     * @var array of Reward objects 
     */
    public $rewards;

    /**
     * External Links 
     * 
     * @var array of Links object
     */
    public $links;

    /**
     * Tribes associated with the campaigns
     * 
     * @var array of Tribe object
     *  
     */
    public $mediaLinks;

    /**
     * Media links associated with the campaigns
     * 
     * @var array of MediaLink object
     *  
     */
    public $tribes;

    /**
     * Social amplifiers based on target
     * 
     * @var array of SocialAmplifier object
     *  
     */
    public $socialAmplifers;

    public function __construct($id = null) {
        if (!$id)
            return null;
        $this->id = $id;
        $this->fetchCampaignAttributes();
        $this->fetchRewards();
//        $this->fetchUser();
//        $this->feetchLinkds();
//        $this->fetchTribes();
//        $this->SocialAmplifers();
    }

    /**
     * fetch Campaign
     */
    public function fetchCampaignAttributes() {
        $attributes = array('title', 'shortSummary', 'country', 'city', 'flipImageUrl', 'shortUrl', 'category', 'goal', 'currency', 'projectFor', 'fundingType', 'daysRun', 'endDate', 'paymentDate', 'mediaType', 'videoUrl', 'imageUrl', 'pitchStory', 'mainLink', 'thankyouMediaType', 'thankyouMediaUrl', 'campaignUrl', 'status', 'socialAmplifierStatus', 'userId');
        $sql = "SELECT * FROM project where id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues, 'queryRow');
        $map = $this->mapAttrsKey($attributes);
        $this->exchangeData($result, $map);
    }

    public function fetchRewards() {
        $attributesRewards = array('id', 'serial', 'name', 'fundAmount', 'available', 'estimatedDelivery', 'description', 'fundersShippingAddressRequired', 'hasDisclaimer', 'projectId');
        
        $sql = "SELECT * FROM reward where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);
        
        $map = $this->mapAttrsKey($attributesRewards);
        $this->exchangeDataArray($result, $map, 'rewards', 'Reward');
    }

    public function fetchUser() {
        $sql = "SELECT * user where id = :USER_ID";
        $bindValues = array(':USER_ID' => $this->userId);
        $result = $this->fetch($sql, $bindValues, 'queryOne');
    }

    public function feetchLinkds() {
        $q = "SELECT * FROM links where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);
    }

    public function fetchTribes() {
        $sql = "SELECT * FROM tribes where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);
    }

    public function SocialAmplifers() {
        
    }

    public function fetch($sql = '', $bindValues, $method = 'queryAll') {
        if (!$sql)
            return null;
        return Yii::app()->db
                        ->createCommand($sql)
                        ->bindValues($bindValues)
                        ->{$method}();
    }

    /**
     * Returns Singleton instance
     * @return Camaign
     */
    public static function instance($id) {
        if (!isset(self::$_instance)) {
            self::$_instance = new self($id);
        }

        return self::$_instance;
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
     * function to map attributes and keys
     * @param type $attributes 
     */
    public function mapAttrsKey($attributes) {
        $_map = array();
        foreach ($attributes as $attrib) {
            $_map[$attrib] = Utils::fromCamelCase($attrib);
        }
        return $_map;
    }

    /**
     * map data with class attribute
     * @param type $data
     * @param type $map 
     */
    public function exchangeData($dataRow, $map) {
        if (!is_array($dataRow))
            return;
        
        foreach ($map as $attr => $key) {
            $this->$attr = isset($dataRow[$key]) ? $dataRow[$key] : '';
        }
    }

    /**
     * very specific to campaing
     * @param type $data
     * @param type $map
     * @param type $property
     * @param type $class
     * @return type 
     */
    public function exchangeDataArray($data, $map, $property, $class) {
        if (!is_array($data))
            return;
        foreach ($data as $row) {
            $o = new $class;
            foreach ($map as $attr => $key) {
                $o->$attr = isset($row[$key]) ? $row[$key] : '';
            }
            $this->{$property}[] = $o;
        }
        
    }

    /**
     * Step 1 
     */
    public function getStep1() {
        //if requested with id fetch from database
        if (isset($_GET['id']) && $_GET['id']) {
            $campaign = self::instance();
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
        //if requested with id fetch from database
        if (isset($_POST['data']['campaignId']) && $_POST['data']['campaignId']) {
            $campaign = self::instance($_POST['data']['campaignId']);
        }


        $result = array(
            'config' => $this->getConfig(),
            'user' => '',
            'data' => $campaign
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
        $this->uploadImage($uploadedImage, $options);
    }

    public function uploadAwesomeCampaignImage() {
        $options = array(
            'name' => 'campaign_' . $_POST['campaignId'] . md5(rand(1, 1000))
        );
        $uploadedImage = CUploadedFile::getInstanceByName('awesomeCampaignImage');
        $this->uploadImage($uploadedImage, $options);
    }

    public function uploadImage($uploadedImage, $options) {
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
