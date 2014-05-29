<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $gender
 * @property string $dob
 * @property string $description
 * @property string $fb_token
 * @property string $location
 * @property string $fbid
 * @property string $login_type
 * @property integer $status
 * @property string $last_login
 *
 * The followings are the available model relations:
 * @property Project[] $projects
 * @property UserFundProject[] $userFundProjects
 */
class Mainuser extends CActiveRecord
{
    
    
    // holds the password confirmation word
    public $repeat_password;
 
    //will hold the encrypted password for update actions.
    public $initialPassword;
    
    public $image;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('id', 'required'),
//			array('id, status', 'numerical', 'integerOnly'=>true),
//			array('name, email', 'length', 'max'=>55),
//			array('password', 'length', 'max'=>45),
//			array('gender', 'length', 'max'=>6),
//			array('fb_token, location, fbid, login_type', 'length', 'max'=>255),
//			array('dob, description, last_login', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
//                    array('password, repeat_password', 'required', 'on'=>'insert'),
            array('password, repeat_password', 'length', 'min'=>6, 'max'=>40),
                    array('profile_image', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true,'on'=>'update'),
            array('password', 'compare', 'compareAttribute'=>'repeat_password'),
                    array('id, name, email, gender, dob, description, fb_token,media, location, fbid, login_type, status, last_login', 'safe'),
                    array('main_url, facebook_link, soundcloud_link, twitter_link, bandcamp_link, youtube_link, myspace_link, vimeo_link, linkedin_link', 'length', 'max'=>255),
			array('id, name, email, password, gender, dob, description, fb_token, location, fbid, login_type, status, last_login', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'projects' => array(self::HAS_MANY, 'Project', 'user_id'),
			'userFundProjects' => array(self::HAS_MANY, 'UserFundProject', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'gender' => 'Gender',
			'dob' => 'Dob',
			'description' => 'Description',
			'fb_token' => 'Fb Token',
			'location' => 'Location',
			'fbid' => 'Fbid',
			'login_type' => 'Login Type',
			'status' => 'Status',
			'last_login' => 'Last Login',
                    'profile_image' => 'Profile Image',
                    'main_url' => 'Main Url',
			'facebook_link' => 'Facebook Link',
			'soundcloud_link' => 'Soundcloud Link',
			'twitter_link' => 'Twitter Link',
			'bandcamp_link' => 'Bandcamp Link',
			'youtube_link' => 'Youtube Link',
			'myspace_link' => 'Myspace Link',
			'vimeo_link' => 'Vimeo Link',
			'linkedin_link' => 'Linkedin Link',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('fb_token',$this->fb_token,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('fbid',$this->fbid,true);
		$criteria->compare('login_type',$this->login_type,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('last_login',$this->last_login,true);
                		$criteria->compare('main_url',$this->main_url,true);
		$criteria->compare('facebook_link',$this->facebook_link,true);
		$criteria->compare('soundcloud_link',$this->soundcloud_link,true);
		$criteria->compare('twitter_link',$this->twitter_link,true);
		$criteria->compare('bandcamp_link',$this->bandcamp_link,true);
		$criteria->compare('youtube_link',$this->youtube_link,true);
		$criteria->compare('myspace_link',$this->myspace_link,true);
		$criteria->compare('vimeo_link',$this->vimeo_link,true);
		$criteria->compare('linkedin_link',$this->linkedin_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mainuser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function beforeSave()
    {
        // in this case, we will use the old hashed password.
        if(empty($this->password) && empty($this->repeat_password) && !empty($this->initialPassword)){
            $this->password=$this->repeat_password=$this->initialPassword;
        }
        else{
             //because the hashes needs to match
            if(!empty($this->password) && !empty($this->repeat_password))
            {
                $this->password =md5($this->password);
                $this->repeat_password = md5($this->repeat_password);
            }
 
            $this->attributes=$data;
        }
        return parent::beforeSave();
    }
    public function afterFind()
    {
        //reset the password to null because we don't want the hash to be shown.
        $this->initialPassword = $this->password;
        $this->password = null;
 
        parent::afterFind();
    }
    
    public function saveModel($data=array())
    {
            //because the hashes needs to match
            if(!empty($data['password']) && !empty($data['repeat_password']))
            {
                //$data['password'] =md5($data['password']);
                $data['repeat_password'] = md5($data['repeat_password']);
            }
 
            $this->attributes=$data;
 
            if(!$this->save())
                return CHtml::errorSummary($this);
 
         return true;
    }
}
