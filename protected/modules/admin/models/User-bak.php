<?php

/**
 * Description of User
 *
 * @author Kalpit
 */
class xUser extends CActiveRecord {

    public $oldpassword;
    public $newpassword;
    public $repeat_password;
    public $crmRole;
    public $adminRole;
    public $profilepic;
    public $userid;

    //public $roles;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name, email, employee_id, designation', 'required', 'on' => 'edit'),
            array('name, email, employee_id, designation, password, repeat_password', 'required', 'on' => 'add'),
            array('manager_id', 'fixManager', 'on' => 'add, edit'),
            array('email', 'email'),
            array('repeat_password', 'compare', 'compareAttribute' => 'password', 'on' => 'add', 'message' => 'Password should be same'),
            array('profilepic', 'file', 'types' => 'jpg,jpeg,png', 'allowEmpty' => true, 'on' => 'update'),
            array('email,employee_id', 'unique', 'message' => 'Given {attribute} is already exists'),
            array('newpassword, repeat_password, oldpassword', 'required', 'on' => 'resetpassword'),
            array('repeat_password', 'compare', 'compareAttribute' => 'newpassword', 'on' => 'resetpassword', 'message' => 'Password should be repeated'),
            array('oldpassword', 'verifyOldPassword', 'on' => 'resetpassword'),
            array('email, password, employee_id, designation, manager_id, profilepic', 'safe', 'on' => 'search'),
        );
    }

    /*
     * Prevent updating password field on update
     */

    public function beforeSave() {
        if (!$this->getIsNewRecord())
            unset($this->password);
        return parent::beforeSave();
    }

    public function verifyOldPassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            if (($user->password) != md5($this->oldpassword))
                $this->addError('oldpassword', 'Provided password is wrong');
        }
    }

    /**
     * if manager id is not set, set it to null 
     */
    public function fixManager() {
        if (!$this->manager_id)
            $this->manager_id = null;
    }

    /*
     * will encrypt password after validation done
     */

    protected function afterValidate() {
        $this->password = md5($this->password);
    }

    /*
     * return userlist with their roles for sites
     */

    public function getUsers() {
        $users = Yii::app()->db->createCommand()->select('u.email,u.userid, m.name as managername, u.name, u.designation, u.manager_id, site_users.role as site_role, crm_users.role as crm_role')
                ->from('user u')
                ->leftJoin('user m', 'm.userid=u.manager_id')
                ->leftJoin('site_users', 'u.userid=site_users.userid')
                ->leftJoin('crm_users', 'u.userid=crm_users.userid')
                ->queryAll();
        return $users;
    }

    public function getUser($userId) {
        //$user = User::model()->findByPk($userId);
        $user = Yii::app()->db->createCommand()->select('u.userid, u.email, m.name as managername, u.manager_id, u.name, u.designation, site_users.has_access as site_has_access, crm_users.has_access as crm_has_access, site_users.role as site_role, crm_users.role as crm_role')
                ->from('user u')
                ->leftJoin('user m', 'm.userid=u.manager_id')
                ->leftJoin('site_users', 'u.userid=site_users.userid')
                ->leftJoin('crm_users', 'u.userid=crm_users.userid')
                ->where('u.userid = ' . $userId)
                ->queryRow();

        return $user;
    }

    /*
     * Return Manager list
     */

    public function getUserBasicInfo($userId) {
        $user = Yii::app()->db->createCommand()->select('name, userid, designation, email')
                ->from('user')
                ->where('userid = ' . $userId)
                ->queryRow();
        return $user;
    }

    public function getRoleInModule($userId, $module = 'admin') {
        $user = Yii::app()->db->createCommand()->select('role')
                ->from($module . '_users')
                ->where('userid = ' . $userId . ' AND has_access=1')
                ->queryRow();
        return $user;
    }

    public function addUserInModules($userId, $moduleUsersTablePrefix, $role, $hasAccess = 0) {
        $moduleUsersTable = $moduleUsersTablePrefix . '_users';
        Yii::app()->db->createCommand()
                ->insert($moduleUsersTable, array(
                    'role' => $role, 'has_access' => $hasAccess, 'userid' => $userId
                ));
    }

    public function updateUserInModule($userId, $moduleUsersTablePrefix, $role, $hasAccess = 0) {
        $moduleUsersTable = $moduleUsersTablePrefix . '_users';
        Yii::app()->db->createCommand()
                ->update($moduleUsersTable, array(
                    'role' => $role,
                    'has_access' => $hasAccess,
                        ), 'userid=:whereUserId', array(
                    ':whereUserId' => $userId
                ));
    }


    public function getAdminRoles() {
        return Yii::app()->db->createCommand()
                        ->select('name')
                        ->from('admin_roles')
                        ->queryAll();
    }

    /*
     * Retrun userlist from sites based on argument
     */

    /*
     * Return userlist except passed table name
     */

    public function getUsersExcept($table = 'a') {
        $user = Yii::app()->db->createCommand("select userid,email from user where userid NOT IN (select userid from site_" . $table . ")")->queryAll();
        return $user;
    }

    /*
     * Return all the roles for users
     */

    public function getRolls() {
        return array('Admin', 'Customer');
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('UserId', $this->UserId);
        $criteria->compare('UserName', $this->UserName, true);
        $criteria->compare('Password', $this->Password, true);
        $criteria->compare('Gender', $this->Gender, true);
        $criteria->compare('LastLogin', $this->LastLogin, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}

