<?php

/**
 * @author Kalpit Pandit <kalpit@inkoniq.com>
 */
class AppUser extends CActiveRecord
{
    public $confirm_password;
    public $oldpassword;
    public $newpassword;

	public function tableName()
	{
		return 'app_user';
	}
        
        public function add($params = array()) 
        {
            $data['fbid'] = $params['id'];
            $data['email'] = $params['email'];
            $data['name'] = $params['name'];
            $data['location'] = $params['work'][0]['location']['name'];
            $this->attributes = $data;
            $this->save(false);
        }

    protected function afterValidate()
        {
            parent::afterValidate();
            if(!$this->hasErrors())
                $this->password = $this->hashPassword($this->password);
        }

        public function hashPassword($password)
        {
            return md5($password);
        }


        /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, email, password, location, confirm_password', 'required','on'=>'create'),
                        array('email','unique','on'=>'create'),
                        array('email','email','on'=>'create'),
                        array('newpassword,confirm_password,oldpassword','required','on'=>'changePassword'),
                        array('confirm_password,newpassword','compare','compareAttribute' => 'newpassword','on'=>'changePassword'),
                        array('oldpassword', 'verifyOldPassword','on'=>'changePassword'),
                        array('confirm_password', 'compare', 'compareAttribute' => 'password','on'=>'create'),
		);
	}

        /*
         * It will check old password 
         */
        public function verifyOldPassword($attribute,$params)
        {
                if(!$this->hasErrors())
                {
                        $user = AppUser::model()->findByAttributes(array('email' => Yii::app()->user->name));
                        if($user->password !== md5($this->oldpassword))
                                $this->addError('oldpassword','old password is wrong.');
                        else
                            $this->password = $this->newpassword;
                }
        }
        
	public function ifUserExists($userEmail = "") {
            $result = $this->find('email=:email', array(':email' => $userEmail));
            
            if ($result) {
                return true;
            }
        }
    
        /*
         * It will check given email is registered with Facebook or not?
         */
	public function isFbUser($userEmail = "") {
            $result = $this->find('email=:email', array(':email' => $userEmail));
            
            if ($result && $result->fbid && !$result->password) {
                return true;
            }
            else
                return false;
        }
        
	public function relations()
            {
		return array();
            }


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
