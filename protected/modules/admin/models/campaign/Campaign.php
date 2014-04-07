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

    /**
     * awesome campaign
     * @var type 
     */
    public $mediaType;
    public $videoUrl;
    public $imageUrl;
    public $pitchStory;

    /**
     *
     * @var type 
     */
    public $mainLink;
    public $thankyouMediaType;
    public $thankyouMediaUrl;
    public $shareUrl;
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
    public $rewardsDisclaimer; //campaign specific and not reward specific
    public $rewards;

    /**
     * External Links 
     * 
     * @var array of Link object
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
        $this->fetchLinks();
        $this->fetchMediaLinks();
        $this->fetchTribes();
        $this->fetchSocialAmplifers();
    }

    /**
     * fetch Campaign
     */
    public function fetchCampaignAttributes() {
        $attributes = array('title', 'shortSummary', 'country', 'city', 'flipImageUrl', 'shortUrl', 'category', 'goal', 'currency', 'projectFor', 'fundingType', 'daysRun', 'endDate', 'paymentDate', 'mediaType', 'videoUrl', 'imageUrl', 'pitchStory', 'mainLink', 'thankyouMediaType', 'thankyouMediaUrl', 'shareUrl', 'status', 'socialAmplifierStatus', 'userId');
        $sql = "SELECT * FROM project where id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues, 'queryRow');
        $map = $this->mapAttrsKey($attributes);
        $this->exchangeData($result, $map);

        //reset values;
        $this->shareUrl = $_SERVER['HTTP_HOST'] . '/tcampaign/' . $this->id . '/?share=' . $this->shareUrl;
    }

    public function fetchRewards() {
        $attributesRewards = array('id', 'serial', 'name', 'rewardTypes', 'fundAmount', 'available', 'estimatedDelivery', 'description', 'fundersShippingAddressRequired', 'projectId');

        $sql = "SELECT * FROM reward where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);

        for ($i = 0; $i < count($result); $i++)
            $result[$i]['reward_types'] = (trim($result[$i]['reward_types'])) ? explode(',', $result[$i]['reward_types']) : array();
        $map = $this->mapAttrsKey($attributesRewards);
        $this->exchangeDataArray($result, $map, 'rewards', 'Reward');
    }

    public function fetchUser() {
        $attributesLink = arry('id', 'title', 'url', 'type', 'projectId');
        $sql = "SELECT * user where id = :USER_ID";
        $bindValues = array(':USER_ID' => $this->userId);
        $result = $this->fetch($sql, $bindValues, 'queryOne');
        $map = $this->mapAttrsKey($attributesLink);
        $this->exchangeDataArray($result, $map);
    }

    public function fetchLinks() {
        $attributesLinks = array('id', 'title', 'url', 'type', 'projectId');
        $sql = "SELECT * FROM links where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);
        $map = $this->mapAttrsKey($attributesLinks);
        $this->exchangeDataArray($result, $map, 'links', 'Link'); //data, property-field mapping, attribute, class
    }

    public function fetchMediaLinks() {
        $attributesLinks = array('id', 'title', 'description', 'type', 'code_url', 'projectId');
        $sql = "SELECT * FROM media_links where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);
        $map = $this->mapAttrsKey($attributesLinks);
        $this->exchangeMediaLink($result, $map, 'mediaLinks', 'MediaLink'); //data, property-field mapping, attribute, class
    }

    public function fetchTribes() {
        $attributesTribe = array('id', 'email', 'name', 'canEdit', 'status', 'projectId');
        $sql = "SELECT * FROM tribes where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);
        $map = $this->mapAttrsKey($attributesTribe);
        $this->exchangeDataArray($result, $map, 'tribes', 'Tribe');
    }

    public function fetchSocialAmplifers() {
        $attributesLinks = array('percent', 'title', 'message', 'postStatus', 'projectId');
        $sql = "SELECT * FROM social_amplifier where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);
        $map = $this->mapAttrsKey($attributesLinks);
        $this->exchangeDataArray($result, $map, 'socialAmplifers', 'SocialAmplifier'); //data, property-field mapping, attribute, class
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
            'staticLinks' => Config::staticLinks(),
            'socialAmplifiers' => Config::getSocialAmplifiers(),
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
     * very specific to campaing
     * @param type $data
     * @param type $map
     * @param type $property
     * @param type $class
     * @return type 
     */
    public function exchangeMediaLink($data, $map, $property, $class) {
        if (!is_array($data))
            return;
        $this->{$property}['video'] = array();
        $this->{$property}['image'] = array();
        $this->{$property}['audio'] = array();
        $this->{$property}['pdf'] = array();
        foreach ($data as $row) {
            $mo = new MediaLink();
            foreach ($map as $attr => $key) {
                $mo->$attr = isset($row[$key]) ? $row[$key] : '';
            }
            switch ($row['type']) {
                case 'video':
                    $this->{$property}['video'][] = $mo;
                    break;
                case 'image':
                    $this->{$property}['image'][] = $mo;
                    break;
                case 'audio':
                    $this->{$property}['audio'][] = $mo;
                    break;
                case 'pdf':
                    $this->{$property}['pdf'][] = $mo;
                    break;
            }
        }
    }

    /**
     * Step 1 
     */
    public function getStep1() {
        //if requested with id fetch from database
        if (isset($_POST['campaignId']) && $_POST['campaignId']) {
            $campaign = self::instance($_POST['campaignId']);
        }


        $result = array(
            'config' => $this->getConfig(),
            'user' => '',
            'data' => $campaign
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
     * Step 3
     */
    public function getStep3() {
        //if requested with id fetch from database
        if (isset($_POST['data']['campaignId']) && $_POST['data']['campaignId']) {
            $campaign = self::instance($_POST['data']['campaignId']);
        }




        $result = array(
            'config' => $this->getConfig(),
            'user' => '',
            'data' => $campaign
        );

        //print_r($result);
        Ajax::success($result);
    }

    /**
     * Step 3
     */
    public function getStep4() {
        //if requested with id fetch from database
        if (isset($_POST['data']['campaignId']) && $_POST['data']['campaignId']) {
            $campaign = self::instance($_POST['data']['campaignId']);
        }

        $result = array(
            'config' => $this->getConfig(),
            'user' => '',
            'data' => $campaign
        );

        //print_r($result);
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
            //if campaign id then update else insert
            $command = Yii::app()->db->createCommand();
            $columns = $data; //data from step 1
            if (isset($_POST['campaignId']) && $_POST['campaignId']) {
                $columns = $this->toUnderScore($columns);
                $command->update(
                        'project', $columns, 'id = :ID', array(':ID' => $_POST['campaignId'])
                );
            } else {
                $columns['shareUrl'] = Utils::generateRandomString(); //share with tribes  
                $columns['status'] = 'draft';
                $columns = $this->toUnderScore($columns);

                if ($command->insert('project', $columns)) {
                    $result = array();
                    $result['campaignId'] = Yii::app()->db->getLastInsertId();
                    $this->insertStaticLink($result['campaignId']); //insert into links table
                    $this->insertSocialAmplifier($result['campaignId']); //insert social amplifier stuff
                    //add static links with empty url
                    Ajax::success($result);
                } else {
                    
                }
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
            'name' => 'awesome_campaign_' . $_POST['campaignId'] . md5(rand(1, 1000))
        );
        $uploadedImage = CUploadedFile::getInstanceByName('awesomeCampaignImage');
        $this->uploadImage($uploadedImage, $options);
    }

    public function uploadMediaLinkImage($data) {
        $options = array(
            'name' => 'mediaLink_image_' . $_POST['campaignId'] . '_' . md5(rand(1, 1000))
        );
        $uploadedImage = CUploadedFile::getInstanceByName('mediaLinkFile_image_' . $_POST['id']);
        $uploader = new ImageUploader($uploadedImage, $options);
        if ($uploader->process()) {
            $uploader->getImagePath();
            Ajax::success(array(
                'picUrl' => $this->getUrl($uploader->getImagePath()),
                'id' => $_POST['id']
            ));
        } else {
            Ajax::error($uploader->getError());
        }
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

    public function validRequest() {
        if (isset($_POST['campaignId']) && $_POST['campaignId']) {
            //if authenticate user 
            return true;
        }
    }

    public function saveFlipbox() {
        if ($this->validRequest()) {
            $data = $_POST['data'];
            $columns = array(
                'title' => $data['title'],
                'short_summary' => $data['shortSummary'],
                'country' => $data['country'],
                'city' => $data['city'],
                'flip_image_url' => $data['flipImageUrl'],
            );

            $command = Yii::app()->db->createCommand();
            $command->update(
                    'project', $columns, 'id=:ID', array(':ID' => $_POST['campaignId']));
        }
    }

    public function saveGoalSetting() {
        if ($this->validRequest()) {
            $data = $_POST['data'];

            $columns = array(
                'currency' => $data['currency'],
                'goal' => $data['goal'],
                'funding_type' => $data['fundingType'],
                'days_run' => $data['campaignLength']['daysRun'],
                'end_date' => ($data['campaignLength']['endDate']) ? $data['campaignLength']['endDate'] : null,
                'payment_date' => ($data['campaignLength']['paymentDate']) ? $data['campaignLength']['paymentDate'] : null,
            );

            $command = Yii::app()->db->createCommand();
            $command->update(
                    'project', $columns, 'id=:ID', array(':ID' => $_POST['campaignId']));
        }
    }

    public function saveAwesomeCampaign() {
        if ($this->validRequest()) {
            $data = $_POST['data'];


            $columns = array(
                'media_type' => $data['mediaType'],
                'image_url' => $data['imageUrl'],
                'video_url' => $data['videoUrl'],
                'pitch_story' => $data['pitchStory'],
            );

            $command = Yii::app()->db->createCommand();
            $command->update(
                    'project', $columns, 'id=:ID', array(':ID' => $_POST['campaignId']));
        }
    }

    public function saveReward() {
        if ($this->validRequest()) {
            $data = $_POST['data'];
            $data['rewardTypes'] = ($data['rewardTypes']) ? implode(',', $data['rewardTypes']) : '';

            $columns = array(
                'serial' => $data['serial'],
                'name' => $data['name'],
                'reward_types' => $data['rewardTypes'],
                'fund_amount' => $data['fundAmount'],
                'available' => $data['available'],
                'estimated_delivery' => $data['estimatedDelivery'],
                'description' => $data['description'],
                'funders_shipping_address_required' => $data['fundersShippingAddressRequired'],
                'project_id' => $data['projectId'],
            );

            $command = Yii::app()->db->createCommand();

            //update if id is  set
            if ($data['id']) {
                $command->update(
                        'reward', $columns, 'id=:ID', array(':ID' => $data['id']));
            } else { //insert
                $command->insert(
                        'reward', $columns);

                $result['id'] = Yii::app()->db->getLastInsertId();
                $result['section'] = 'reward';
                Ajax::success($result);
            }



//            $columns = array(
//                'media_type' => $data['mediaType'],
//                'image_url' => $data['imageUrl'],
//                'video_url' => $data['videoUrl'],
//                'pitch_story' => $data['pitchStory'],
//            );
//            
//            $command = Yii::app()->db->createCommand();
//            $command->update(
//                    'reward', 
//                    $columns,
//                    'id=:ID',
//                    array(':ID' => $_POST['campaignId']));
        }
    }

    public function deleteReward() {
        if ($this->validRequest()) {
            $data = $_POST['data'];
            if ($data['id']) {
                $command = Yii::app()->db->createCommand();
                $command->delete('reward', 'id=:ID', array(':ID' => $data['id']));
            }
        }
    }

    /**
     * A new project created, add static links without other attributes into database
     * @param type $projectId 
     */
    public function insertStaticLink($projectId) {
        $links = Config::staticLinks();
        $command = Yii::app()->db->createCommand();
        if (is_array($links)) {
            foreach ($links as $link) {
                $link['project_id'] = $projectId;
                $command->insert('links', $link);
            }
        }
    }

    /**
     * A new project created, add static links without other attributes into database
     * @param type $projectId 
     */
    public function insertSocialAmplifier($projectId) {
        $socialAmplifiers = Config::getSocialAmplifiers();
        $command = Yii::app()->db->createCommand();
        if (is_array($socialAmplifiers)) {
            foreach ($socialAmplifiers as $amplifier) {
                $amplifier['project_id'] = $projectId;
                $command->insert('social_amplifier', $amplifier);
            }
        }
    }

    /**
     * check tribe mails
     * for each valid emails add to tribe.  If already exists then overwrite 
     * 
     */
    public function processMails($data, $ajax = true) {
        $emails = explode(',', $data['emails']);
        $_tribes = array('tribes' => array());
        if (is_array($emails)) {
            if (is_array($data['tribes']))
                foreach ($data['tribes'] as $t) {
                    $_email = strtolower($t['email']);
                    if ($_email) {
                        $_tribes['tribes'][$_email] = $t;
                    }
                }

            $canEdit = $data['canEdit'];
            foreach ($emails as $email) {
                if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                    $_emailNew = trim(strtolower($email));
                    if (!array_key_exists($_emailNew, $_tribes['tribes'])) {
                        $_tribes['tribes'][$_emailNew] = array('id' => '', 'email' => $_emailNew, 'name' => '', 'canEdit' => $canEdit, 'profilePic' => '', 'projectId' => '');
                    } else {
                        $_tribes['tribes'][$_emailNew]['canEdit'] = $canEdit;
                    }
                }
            }



            if ($ajax === true) {
                Ajax::success(array('tribes' => array_values($_tribes['tribes'])));
            } else {
                return $_tribes['tribes'];
            }
        }
    }

    public function inviteTribes($data) {
        if ($this->validRequest()) {
            //update database
            $tribes = (trim($data['emails'])) ? $this->processMails($data, false) : $data['tribes'];

            if ($tribes && is_array($tribes)) {
                $command = Yii::app()->db->createCommand();
                $command->delete('tribes', 'project_id=:ID', array(':ID' => $_POST['campaignId']));
                foreach ($tribes as $tribe) {

                    $columns = array(
                        'email' => $tribe['email'],
                        //'name' => $tribe['name'],
                        'can_edit' => $tribe['canEdit'],
                        'status' => $tribe['status'],
                        'user_id' => '', //query user by email
                        'project_id' => $_POST['campaignId'] //query user by email
                    );

                    $command->insert('tribes', $columns);
                }
            }

            Ajax::success(array('tribes' => array_values($tribes)));
        }
    }

    public function saveAmplifers($data) {
        print_r($data);
        if ($this->validRequest()) {
            //update database
            $socialAmplifers = $data['socialAmplifers'];

            if ($socialAmplifers && is_array($socialAmplifers)) {
                $command = Yii::app()->db->createCommand();
                foreach ($socialAmplifers as $amplifer) {

                    $columns = array(
                        'title' => $amplifer['title'],
                        'message' => $amplifer['message'],
                        'post_status' => ($amplifer['postStatus']) ? 1 : 0,
                    );

                    $command->update(
                            'social_amplifier', $columns, 'project_id = :ID AND percent = :PERCENT', array(':ID' => $_POST['campaignId'], ':PERCENT' => $amplifer['percent'])
                    );
                }
            }

            Ajax::success(array());
        }
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

