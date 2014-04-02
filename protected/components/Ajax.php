<?php

class Ajax {
  
    public static function error($error) {
        $res = array(
            'error' => $error
        );
        self::send($res);
    }
    
    public static function success($data = true) {
        $res = array(
            'error' => 0,
            'data' => $data
        );
        self::send($res);
    }
    
    
    public static function send($response) {
         echo json_encode($response, 1);
         Yii::app()->end();
    }
}

