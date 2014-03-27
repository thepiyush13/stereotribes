<?php

/**
 * Description of ProcessFeedsExtraction
 *
 * @author abhishek
 */
Class ProcessFeedsExtraction {

    //1 loop through all the feed files
    //2 if valid xml
    //3 validate()
    //if sucess -> extract and store then move to sucess location
    //if fail -> move to fail location + log
    public $feedPath;
    public $provider;
    public $feedId;
    
    public function __construct($feedPath, $providerId) {
        $this->feedPath = $feedPath . "/" . $providerId . "/bucket" ;
        $this->provider =  Providers::model()->find('guid=:GUID',array(':GUID' => $providerId));
        $this->init();
    }

    public function init() {
        $this->process();
    }

    public function process() {
        $feedsHtml = "";
        if ($handle = opendir($this->feedPath)) {
            while (false !== ($xmlFile = readdir($handle))) {
                if ($xmlFile != "." && $xmlFile != "..") {
                    $rawRssFeed = file_get_contents($this->feedPath."/".$xmlFile);
                    $rssFeed = new RSSFeed($rawRssFeed);
                    $rssFeed->feedId = strstr($xmlFile, '.', TRUE);
                    $rssFeed->setProvider($this->provider);
                    $feedsHtml = $rssFeed->processFeed();
                }
            }
        }
        return $feedsHtml;
    }

}

?>
