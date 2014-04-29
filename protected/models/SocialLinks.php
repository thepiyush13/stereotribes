<?php

/**
 * This is the model class for social links and share items
 *

 */
class SocialLinks {

    private static $fb_url = "http://www.facebook.com";
    private static $twt_url = " https://twitter.com";
    private static $gplus_url = "https://plus.google.com";
    private static $lkd_url = "https://www.linkedin.com";

    /**
     * Returns the facebook share content link .	 
     * @param string $url url to be shared.
     * @param string $title title of the page.
     * @param string $desc description or summary of the message.
     * @return Leaves the static model class
     */
    public static function get_fb_share_link($url, $title, $desc) {

        $encoded_title = urlencode($title);
        $encoded_desc = urlencode($desc);
        $fb_app_id = '145634995501895'; //Yii::app()->params[$name];
        $share_url = self::$fb_url . '/dialog/feed?
                                              app_id=' . $fb_app_id . '
                                              &display=popup&caption=' . $encoded_desc . '
                                              &link=' . $url .
                '&redirect_uri=https://developers.facebook.com/tools/explorer';
        //  $share_url = self::$fb_url."/sharer.php?u=".$url."&title=".$encoded_title;

        return $share_url;
    }

    /**
     * Returns the twitter share content link .	 	 
     * @param string $desc description or summary of the message.
     * @return Leaves the static model class
     */
    public static function get_twt_share_link($desc) {

        $encoded_desc = urlencode($desc);
        $share_url = self::$twt_url . "/home?status={$encoded_desc}";
        return $share_url;
    }

    /**
     * Returns the google plus share content link .	 
     * @param string $url url to be shared.                
     * @return Leaves the static model class
     */
    public static function get_gplus_share_link($url, $desc) {

        $encoded_desc = urlencode($desc);
        $share_url = self::$gplus_url . "/share?url={$url}" . "&content=" . $encoded_desc;
        return $share_url;
    }

    /**
     * Returns the linked in share content link .	 
     * @param string $url url to be shared.    
     * @param string $title title of the page.
     * @param string $desc description or summary of the message.            
     * @return Leaves the static model class
     */
    public static function get_lkd_share_link($url, $title, $desc) {


        $encoded_title = urlencode($title);
        $encoded_desc = urlencode($desc);
        $share_url = self::$lkd_url . "/shareArticle?mini=true&url={$url}&title={$encoded_title}&summary={$encoded_desc}";
        return $share_url;
    }

}
