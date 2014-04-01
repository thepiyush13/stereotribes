<?php

class WebUser extends CWebUser {

    public function checkAccess($operation, $params = array()) {
        
        if (empty($this->id)) {
            return false;
        }
        $roles = $this->getState('roles');
        if (Yii::app()->getController()->getModule()) {
            $currentModule = Yii::app()->getController()->getModule()->getId();
            if (in_array($currentModule, array('admin'))) {
                $userRoleInModule = $roles[$currentModule]['role'];
                if ($userRoleInModule == 'admin') {
                    return true;
                }
                return ($operation === $userRoleInModule);
            }
        }
    }
    
    public function checkAccessInModule($moduleName) {
        $roles = $this->getState('roles');
        if($roles[$moduleName]['role'] ){
            return true;
        }
        return false;
        
    }

}
