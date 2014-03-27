<?php

class Provider {

    private $id;
    private $name;
    private $logo;
    public $url;
    public $guid;
    
    public function __construct($id = null, $name = "", $logo = "", $url = "") {
        $this->id = $id;
        $this->name = $name;
        $this->logo = $logo;
        $this->url = $url;
    }

    public function getProviderId() {
        return $this->id;
    }

    public function getProviderName() {
        return $this->name;
    }

    public function getProviderLogo() {
        return $this->logo;
    }

}
