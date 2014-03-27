<?php

/**
 * Description of AddSources
 *
 * @author abhishek
 */
class AddFeedsForm extends CFormModel {

    public $feedType;
    public $feedProvider;
    public $feedUrl;
    public $feedCategory;
    public $errors;
    public $tprSchedule;

    public function rules() {
        return array(
            array('feedType, feedProvider, feedUrl, feedCategory, tprSchedule','required' ),
        );
    }

    public function add() {
        try {
            $feed = new Feeds();
            $feed->type = $this->feedType;
            $feed->provider = $this->feedProvider;
            $feed->url = $this->feedUrl;
            $feed->schedule = $this->tprSchedule;
            $feed->category = implode(',', $this->feedCategory);
            $feed->status = "ACTIVE";
            if (!$feed->save()) {
                $this->errors = $feed->getError();
            } else {
                return $feed;
            }
        } catch (Exception $e) {
            $this->errors = $e->getMessage();
        }
    }

}

?>
