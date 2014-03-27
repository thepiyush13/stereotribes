<?php

/**
 * Description of Feeds
 *
 * @author abhishek
 */
class Feeds extends CActiveRecord {

    public function tableName() {
        return 'feeds';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getFeeds($provider = "") {
        $sql = "SELECT 
            providers.name,
            feeds.id,
            feeds.status,
            feeds.provider,
            feeds.type,
            feeds.schedule,
            feeds.category as category,
            providers.name,
            feeds.url  FROM feeds 
            LEFT JOIN providers ON feeds.provider = providers.id";
            //LEFT JOIN feed_category ON feeds.category = feed_category.id";
        if ($provider) {
            $sql .= " WHERE feeds.provider =:PROVIDER";
        }
        return $this->dbConnection
                        ->createCommand($sql)
                        ->bindParam(':PROVIDER', $provider)
                        ->queryAll();
    }

    public function getFeedsCategoryList() {
        $sql = "SELECT * FROM feed_category";
        return $this->dbConnection
                        ->createCommand($sql)
                        ->queryAll();
    }

}

?>
