<?php

class AddprovidersForm extends CFormModel {

    public $providerName;
    public $providerUrl;

    public function rules() {
        return array(
            array('providerName,providerUrl', 'required')
        );
    }

    public function saveProviderInfo() {
        try {
            $provider = new Providers();
            $provider->name = $this->providerName;
            $provider->url = $this->providerUrl;
            $provider->guid = Utils::sanitizeTitle(strtolower($this->providerName));
            if (!$provider->save()) {
                $this->errors = $provider->getErrors();
            }
            
            return true;
        } catch (Exception $e) {
            return $this->errors = $e->getMessage();
        }
    }

}

?>
