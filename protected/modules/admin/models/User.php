<?php

/**
 * Description of User
 *
 * @author abhishek
 */
class User extends CActiveRecord {

    public function tableName() {
        return 'user';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function add($params = array()) {
        $transaction = $this->dbConnection->beginTransaction();
        try {
            $this->fbId = $params['id'];
            $this->location = serialize($params['location']);
            $this->locale = $params['locale'];
            $this->gender = $params['gender'];
            $this->email = $params['email'];
            $this->name = $params['name'];
            $this->save();
            
//            $userId = $this->dbConnection->getLastInsertID();
//            $this->addUserInModules($userId, 'admin', 'user', 1);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    public function ifUserExists($userEmail = "") {
        $result = $this->find('email=:email', array(':email' => $userEmail));
        if ($result) {
            return true;
        }
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

}


?>
