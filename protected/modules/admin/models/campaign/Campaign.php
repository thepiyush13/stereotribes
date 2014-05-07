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
    public $thankyouVideoUrl;
    public $thankyouImageUrl;
    public $shareUrl;


    /*
     * campaign status -> draft, live, expired, blocked?
     */
    public $status;
    public $userId;

    /**
     * instace 
     */
    public static $_instance;

    /**
     * User object (campaign owner)
     */
    public $creator;

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
    public $socialAmplifierStatus;
    public $trackerCode;

    /**
     * fund
     * @param type $id
     * @return null 
     */
    public $paymentType;
    public $rememberMe;
    public $promotionMethod;
    public $toDoList;
    public $image_url;

    /**
     * fund stat
     */
    public $raised = 0;
    public $backers = 0;

    public function __construct($id = null) {
        if (!$id)
            return null;
        if(!$this->isValidCampaignId($id))
            return;
        $this->id = $id;
        $this->fetchCampaignAttributes();
        $this->fetchRewards();
        //$this->fetchCreater();
        $this->fetchLinks();
        $this->fetchMediaLinks();
        $this->fetchTribes();
        $this->fetchSocialAmplifers();
        
    }
    
    public function isValidCampaignId($id) {
        $sql = "SELECT * FROM project where id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $id);
        $result = $this->fetch($sql, $bindValues, 'queryRow');
        if($result)
            return true;
        return false;
    }

    /**
     * fetch Campaign
     */
    public function fetchCampaignAttributes() {
        $attributes = array('title', 'shortSummary', 'country', 'city', 'flipImageUrl', 'shortUrl', 'category', 'goal', 'currency', 'projectFor', 'fundingType', 'daysRun', 'endDate', 'paymentDate', 'mediaType', 'videoUrl', 'imageUrl', 'pitchStory', 'mainLink', 'thankyouMediaType', 'thankyouVideoUrl', 'thankyouImageUrl', 'shareUrl', 'status', 'socialAmplifierStatus', 'trackerCode', 'paymentType', 'rememberMe', 'promotionMethod', 'userId','image_url');
        $sql = "SELECT * FROM project where id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues, 'queryRow');
        $map = $this->mapAttrsKey($attributes);
        $this->exchangeData($result, $map);

        //reset values;
        $this->shareUrl = $_SERVER['HTTP_HOST'] . '/tcampaign/' . $this->id . '/?share=' . $this->shareUrl;
        $this->paymentDate = $this->paymentDate ? date_format(date_create_from_format('Y-m-d', $this->paymentDate), 'd/m/Y') : '';
        $this->endDate = $this->endDate ? date_format(date_create_from_format('Y-m-d', $this->endDate), 'd/m/Y') : '';
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
        $attributesLinks = array('id', 'title', 'description', 'type', 'codeUrl', 'projectId');
        $sql = "SELECT * FROM media_links where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);
        $map = $this->mapAttrsKey($attributesLinks);
        $this->exchangeMediaLink($result, $map, 'mediaLinks', 'MediaLink'); //data, property-field mapping, attribute, class
    }

    public function fetchTribes() {
        $attributesTribe = array('id', 'email', 'name', 'location', 'canEdit', 'status', 'projectId');
        $sql = "SELECT * FROM tribes where project_id = :CAMPAIGN_ID";
        $sql = "SELECT u.id as id, u.name as name, u.location as location, t.email as email FROM tribes t left join user u on (t.email = u.email) where t.project_id = :CAMPAIGN_ID";
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
    
    public function fetchCreator() {
        if($this->userId) {
            $this->creator = new AppUser($this->userId);
        }
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
        if (!isset(Campaign::$_instance)) {
            self::$_instance = new Campaign($id);
        }
        return self::$_instance;
    }

    public function getConfig() {
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
        $campaign = null;
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

        Ajax::success($result);
    }

    /**
     * Step 4
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

        Ajax::success($result);
    }

    /**
     * Step 5
     */
    public function getStep5() {
        //if requested with id fetch from database
        if ($this->validRequest()) {
            $campaign = self::instance($_POST['campaignId']);
            $result = array(
                'config' => $this->getConfig(),
                'user' => '',
                'data' => $campaign
            );
            Ajax::success($result);
        } else {
            Ajax::error(array());
        }
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
            Ajax::error(Utils::getErrorsMessages($validator->getErrors()));
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
                $result = $command->update(
                    'project', $columns, 'id = :ID', array(':ID' => $_POST['campaignId'])
                );
                $result = array();
                $result['campaignId'] = $_POST['campaignId'];
                sleep(3);
                Ajax::success($result);
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
            Ajax::error(Utils::getErrorsMessages($validator->getErrors()));
        }
    }

    /**
     * Camel case to underscore
     * @param type $sectionName 
     */
    public function toUnderScore($dataAr = array()) {
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

    public function fundThankyouUploadImage() {
        $options = array(
            'name' => 'fund_thankyou_' . $_POST['campaignId'] . md5(rand(1, 1000))
        );
        $uploadedImage = CUploadedFile::getInstanceByName('fundThankyouImage');
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

    public function getUrl($url) {
        return 'http://' . $_SERVER['HTTP_HOST'] . $url;
    }

    public function validRequest() {
        $command = Yii::app()->db->createCommand();
        //should have a campaign id
        if (isset($_POST['campaignId']) && $_POST['campaignId']) {
            //if valid campaing id and valid user and draft
            $result = $command->select('id')
                    ->from('project')
                    ->where('id=:CAMPAIGN_ID', array(':CAMPAIGN_ID' => $_POST['campaignId']))
                    ->queryRow();
            if ($result['id'])
                return true;
            return false;

            //return true;
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
                'end_date' => ($data['campaignLength']['endDate']) ? date_format(date_create_from_format('d/m/Y', $data['campaignLength']['endDate']), 'Y-m-d') : null,
                'payment_date' => ($data['campaignLength']['paymentDate']) ? date_format(date_create_from_format('d/m/Y', $data['campaignLength']['paymentDate']), 'Y-m-d') : null,
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

    public function saveCampaign() {
        if ($this->validRequest()) {
            $data = $_POST['data'];
            $this->updateCampaign($data);
            Ajax::success($result);
        }
    }

    public function updateCampaign($data, $id = null) {
        $attributes = array('title', 'shortSummary', 'country', 'city', 'flipImageUrl', 'shortUrl', 'category', 'goal', 'currency', 'projectFor', 'fundingType', 'daysRun', 'endDate', 'paymentDate', 'mediaType', 'videoUrl', 'imageUrl', 'pitchStory', 'mainLink', 'thankyouMediaType', 'thankyouMediaUrl', 'thankyouVideoUrl', 'thankyouImageUrl', 'shareUrl', 'status', 'socialAmplifierStatus', 'trackerCode', 'paymentType', 'rememberMe', 'promotionMethod', 'userId');
        /**
         * look for only above attributes 
         */
        $_data = array();
        foreach ($attributes as $attrib) {
            if (array_key_exists($attrib, $data)) {
                $col = Utils::fromCamelCase($attrib);
                $_data[$col] = $data[$attrib]; //copy data
            }
        }
        $columns = $_data;
        $campaignId = $id ? $id : $_POST['campaignId'];
        if (!$campaignId)
            return false;
        $command = Yii::app()->db->createCommand();
        $result = $command->update(
                'project', $columns, 'id=:ID', array(':ID' => $campaignId));
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
                'funders_shipping_address_required' => ($data['fundersShippingAddressRequired']) ? 1 : 0,
                'project_id' => $_POST['campaignId'],
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

    public function inviteTribes($data, $ajax = true) {
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

            if ($ajax === true) {
                Ajax::success(array('tribes' => array_values($tribes)));
            } else {
                return array('tribes' => array_values($tribes));
            }
        }
    }

    public function saveAmplifers($data, $ajax = true) {
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
            //update aplifer on status
            $_data = array();
            $_data['socialAmplifierStatus'] = $data['socialAmplifierStatus'];
            $this->updateCampaign($_data);


            if ($ajax === true) {
                Ajax::success(array());
            } else {
                return true;
            }
        }
    }

    public function saveLinks($data, $ajax = true) {
        if ($this->validRequest()) {
            //update main link
            $this->updateCampaign(array('mainLink' => $data['mainLink']));

            foreach ($data['links']['list'] as $link) {
                //if not custom then update
                //$link = $this->toUnderScore($link);
                $_link = array();
                if ($link['type'] == 'custom') {
                    $_link[title] = $link['title'];
                }


                $_link[url] = $link['url'];
                $_link[type] = $link['type'];
                $_link[project_id] = $link['projectId'];

                if ($link['type'] != 'custom') {
                    $this->updateLink($_link, $link['id']);
                } else {
                    if ($link['id'] != null) {
                        //update
                        $this->updateLink($_link, $link['id']);
                    } else {
                        //insert new 
                        $this->insertLink($_link);
                    }
                }
            }
            if ($ajax === true) {
                Ajax::success(array());
            } else {
                return true;
            }
        }
    }

    public function insertLink($link) {
        $command = Yii::app()->db->createCommand();
        $command->insert('links', $link);
    }

    public function updateLink($link, $id) {
        $command = Yii::app()->db->createCommand();
        $command->update('links', $link, 'id=:ID', array(':ID' => $id));
    }

    public function removeLink() {
        if ($this->validRequest()) {
            $data = $_POST['id'];
            if ($_POST['id']) {
                $command = Yii::app()->db->createCommand();
                $r = $command->delete('links', 'id=:ID', array(':ID' => $_POST['id']));
                Ajax::success(array());
            }
        }
    }

    /**
     * Media Links
     */
    public function filterMediaDBId($id) {
        if (is_null($id) || strlen((string) $id) > 11) {
            return null;
        }
        return $id;
    }

    public function saveMediaLinks($data, $ajax = true) {
        $videos = $data['mediaLinks']['video'];
        $music = $data['mediaLinks']['audio'];
        $images = $data['mediaLinks']['image'];
        $pdf = $data['mediaLinks']['pdf'];

        $media = array($videos, $music, $images, $pdf);
        $command = Yii::app()->db->createCommand();
        foreach ($media as $mGroup) {
            if (is_array($mGroup)) { //array of vidoes or images or music or pdf...
                foreach ($mGroup as $item) {

                    $_item = array();

                    $_item['title'] = $item['title'];
                    $_item['description'] = $item['description'];
                    $_item['type'] = $item['type'];
                    $_item['code_url'] = $item['codeUrl'];
                    $_item['project_id'] = $_POST['campaignId'];

                    if (is_null($this->filterMediaDBId($item['id']))) {
                        //insert
                        $command->insert('media_links', $_item);
                    } else {
                        //update
                        $command->update('media_links', $_item, 'id=:ID', array(':ID' => $item['id']));
                    }
                }
            }
        }
        Ajax::success(array());
    }

    public function removeMediaLink() {
        if ($this->validRequest()) {
            $data = $_POST['id'];
            if ($_POST['id']) {
                $command = Yii::app()->db->createCommand();
                $r = $command->delete('media_links', 'id=:ID', array(':ID' => $_POST['id']));
                Ajax::success(array());
            }
        }
    }

    public function saveThankyouVideo() {
        if ($this->validRequest()) {
            $data = $_POST['data']['fundThankyou'];
            $columns = array(
                'thankyou_media_type' => $data['thankyouMediaType'],
                'thankyou_image_url' => $data['thankyouImageUrl'],
                'thankyou_video_url' => $data['thankyouVideoUrl'],
            );


            $command = Yii::app()->db->createCommand();
            $command->update(
                    'project', $columns, 'id=:ID', array(':ID' => $_POST['campaignId']));
        }
    }

    public function saveFund() {
        if ($this->validRequest()) {
            $data = $_POST['data'];
            $data['paymentType'] = $data['paymentType'] ? 1 : 0;
            $data['rememberMe'] = $data['rememberMe'] ? 1 : 0;
            $this->updateCampaign($data);
            Ajax::success(array());
        }
    }

    public function goLive() {
        if ($this->validRequest()) {
            $data = array('status' => 'live');
            $this->updateCampaign($data);
            Ajax::success(array());
        }
    }

    public function saveStep4() {

        if ($this->validRequest()) {
            $data = $_POST['data'];

            //save tribe
            $this->inviteTribes($data, false);


            //save amplifiers
            $this->saveAmplifers($data, false);

            //turn on/off ampllifier
            $_data = array();
            $_data['socialAmplifierStatus'] = ($data['socialAmplifierStatus']) ? 1 : 0;
            $this->updateCampaign($_data);


            //save tracker code
            $_data = array();
            $_data['trackerCode'] = $data['trackerCode'];
            $this->updateCampaign($_data);
        }
    }

    public function xfetchRewards() {
        $attributesRewards = array('id', 'serial', 'name', 'rewardTypes', 'fundAmount', 'available', 'estimatedDelivery', 'description', 'fundersShippingAddressRequired', 'projectId');


        $sql = "SELECT * FROM reward where project_id = :CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);
        $result = $this->fetch($sql, $bindValues);

        for ($i = 0; $i < count($result); $i++)
            $result[$i]['reward_types'] = (trim($result[$i]['reward_types'])) ? explode(',', $result[$i]['reward_types']) : array();
        $map = $this->mapAttrsKey($attributesRewards);
        $this->exchangeDataArray($result, $map, 'rewards', 'Reward');
    }

    public function getFundStat() {
        $command = Yii::app()->db->createCommand();

        //fund raised
        $sql = "SELECT sum(amount) as raised from user_fund_project where project_id=:CAMPAIGN_ID";
        $bindValues = array(':CAMPAIGN_ID' => $this->id);

        if ($result = $this->fetch($sql, $bindValues, 'queryRow')) {
            $this->raised = $result['raised'];
        }

        //backed by number of users
        $sql = "SELECT count(*) as backers from user_fund_project where project_id=:CAMPAIGN_ID";
        if ($result = $this->fetch($sql, $bindValues, 'queryRow')) {
            $this->backers = $result['backers'];
        }
    }

}




/*
(id, name, dob, age, email, password, location, fbid=kalpit)
*/

