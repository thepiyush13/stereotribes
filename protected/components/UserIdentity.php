<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    private $_id;

    //private $roles;
    public function authenticate() {
        $user = AppUser::model()->findByAttributes(array('email' => $this->username));
        
        //$user->roles = array('sales', 'admin');
        //echo '<pre>'.print_r($user, 1);exit;
        
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($user->password !== md5($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $user->id;
            $this->setState('name', $user->email);
            $this->setState('roles', array(
                'normal' => "normal"
            ));

//                $this->setState('rolestest', array(
//                    'admin' => $u->getRoleInModule($user->userid, 'site'),
//                    'crm' => $u->getRoleInModule($user->userid, 'crm')));

            $this->setState('details', $user);
            //$this->setState('role', 'sales');
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
    
    public function getId() {
        return $this->_id;
    }

}
