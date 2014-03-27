<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacebookUserIdentity
 *
 * @author abhishek
 */
class FacebookUserIdentity extends CBaseUserIdentity {
    private $_id;
    public $username;
    /**
     * This method will check if the facebook user is in system, and authenticates 
     * the user for access into the system
     * 
     * @param type $user
     * @return type
     */
    public function authenticate() {
        
        $u = new User();
        $user = User::model()->findByAttributes(array('email' => $this->username));
        if ($user == null) {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        } else {
            $this->_id = $user->userid;
            $this->setState('name', $user->email);
            $this->setState('roles', array(
                'admin' => $u->getRoleInModule($user->userid, 'admin')
            ));
            $this->setState('details', $user);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
    
    public function getId() {
        return $this->_id;
    }

}

?>
