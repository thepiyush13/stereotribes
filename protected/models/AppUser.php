<?php

/**
 * @author Kalpit Pandit <kalpit@inkoniq.com>
 */
class AppUser extends CActiveRecord
{
    public $confirm_password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'app_user';
	}
        
        public function add($params = array()) 
        {
            $transaction = $this->dbConnection->beginTransaction();
            try 
            {
                $this->fbId = $params['id'];
                $this->location = serialize($params['location']);
                $this->email = $params['email'];
                $this->name = $params['name'];
                $this->save();
                $transaction->commit();
            } 
            catch (Exception $e) 
            {
                $transaction->rollback();
                throw $e;
            }
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
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, password, location, confirm_password', 'required'),
                        array('email','unique'),
                        array('confirm_password', 'compare', 'compareAttribute' => 'password'),
			array('fbid', 'numerical', 'integerOnly'=>true),
			array('name, location', 'length', 'max'=>150),
			array('email', 'length', 'max'=>250),
			array('password', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, email, password, location, fbid', 'safe', 'on'=>'search'),
		);
	}

	public function ifUserExists($userEmail = "") {
            $result = $this->find('email=:email', array(':email' => $userEmail));
            
            if ($result) {
                return true;
            }
        }
    
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
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
			'location' => 'Location',
                        'last_login' => 'Last_login',
			'fbid' => 'Fbid',
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
		$criteria->compare('location',$this->location,true);
		$criteria->compare('fbid',$this->fbid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
