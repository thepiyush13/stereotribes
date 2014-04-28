<?php

class Utils {
    /*     * *
     * Minimum value of client id sent from browser.
     */

    public static $_MIN_CLIENTID = 100000;

    public static function getTemplatePath() {
        $config = Yii::app();
        return $config->basePath . '/templates/' . $config->sourceLanguage;
    }

    public static function getTemplate($name) {
        $filename = self::getTemplatePath() . '/' . $name . '.html';
        if (file_exists($filename)) {
            return file_get_contents($filename);
        }

        return "";
    }

    /**
     * Translates a camel case string into a string with underscores (e.g. firstName -&gt; first_name)
     * @param    string   $string    String in camel case format
     * @return    string            $str Translated into underscore format
     */
    static function fromCamelCase($string) {
        $string[0] = strtolower($string[0]);
        return preg_replace_callback('/([A-Z])/', function ($c) {
                            return '_' . strtolower($c[1]);
                        }, $string);
    }

    /**
     * Translates a string with underscores into camel case (e.g. first_name -&gt; firstName)
     * @param    string   $str                     String in underscore format
     * @param    bool     $capitalise_first_char   If true, capitalise the first char in $str
     * @return   string                              $str translated into camel caps
     */
    static function toCamelCase($str, $capitalise_first_char = false) {
        if ($capitalise_first_char) {
            $str[0] = strtoupper($str[0]);
        }
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $str);
    }

    /**
     * Function to map array/object values to model
     * @param type $model
     * @param type $values
     * @return type
     */
    public static function mapToModel($model, $values) {
        $class = get_class($model);
        foreach ($values as $property => $val) {
            if (is_string($val)) {
                $property = Utils::fromCamelCase($property);
                if ($val && property_exists($class, $property)) {
                    $model->{$property} = $val;
                }
            }
        }

        return $model;
    }

    /**
     * Function to map values to model attributes
     * @param Class $model
     * @param array $values
     * @return type
     */
    public static function mapAttrs($model, $values) {
        $model->setAttributes(Utils::underscoreKeys($values), false);
        return $model;
    }

    /**
     * Convert under_score type array's keys to camelCase type array's keys
     * @param   array   $array          array to convert
     * @param   array   $arrayHolder    parent array holder for recursive array
     * @return  array   camelCase array
     */
    public static function camelCaseKeys($array, $arrayHolder = array()) {
        if (!$array) {
            return $array;
        }

        if (is_object($array)) {
            $array = json_decode(json_encode($array), true);
        }
        $camelCaseArray = !empty($arrayHolder) ? $arrayHolder : array();

        foreach ($array as $key => $val) {
//                $newKey = @explode('_', $key);
//                array_walk($newKey, create_function('&$v', '$v = ucwords($v);'));
//                $newKey = @implode('', $newKey);
//                 $newKey{0} = @strtolower($newKey{0});


            $func = create_function('$c', 'return strtoupper($c[1]);');
            $newKey = preg_replace_callback('/_([a-z])/', $func, $key);

            if (!is_array($val)) {
                $camelCaseArray[$newKey] = $val;
            } else {
                if (!isset($camelCaseArray[$newKey])) {
                    $camelCaseArray[$newKey] = array();
                }
                $camelCaseArray[$newKey] = Utils::camelCaseKeys($val, $camelCaseArray[$newKey]);
            }
        }
        return $camelCaseArray;
    }

    /**
     * Convert camelCase type array's keys to under_score+lowercase type array's keys
     * @param   array   $array          array to convert
     * @param   array   $arrayHolder    parent array holder for recursive array
     * @return  array   under_score array
     */
    public static function underscoreKeys($array, $arrayHolder = array()) {

        if (!$array) {
            return $array;
        }

        if (is_object($array)) {
            $array = json_decode(json_encode($array), true);
        }

        $underscoreArray = !empty($arrayHolder) ? $arrayHolder : array();
        foreach ($array as $key => $val) {
            $newKey = preg_replace('/[A-Z]/', '_$0', $key);
            $newKey = strtolower($newKey);
            $newKey = ltrim($newKey, '_');
            if (!is_array($val)) {
                $underscoreArray[$newKey] = $val;
            } else {
                if (!isset($underscoreArray[$newKey])) {
                    $underscoreArray[$newKey] = array();
                }
                $underscoreArray[$newKey] = self::underscoreKeys($val, $underscoreArray[$newKey]);
            }
        }
        return $underscoreArray;
    }

    public static function arrayToObj($array = array()) {
        return json_decode(json_encode($array), FALSE);
    }

    public static function reqPayload() {
        $request_body = file_get_contents('php://input');
        return json_decode($request_body, true);
    }

    public static function profilePicPath() {
        return Yii::app()->params['path']['proflePic'];
    }

    public static function formatErrors($model) {
        $errors = $model->getErrors();
//        $er = array();
//        foreach ($errors as $field => $error) {
//            if (is_array($error) && count($error))
//                $er[$field] = $error[0];
//        }
//
//        return $er;

        return self::extractErrors($errors);
    }

    public static function extractErrors($errors) {
        $er = array();

        foreach ($errors as $field => $error) {
            if (is_array($error) && count($error))
                $er[$field] = $error[0];
        }

        return $er;
    }

    public static function getErrorsMessages($errors) {
        $er = array();

        foreach ($errors as $field => $error) {
            if (is_array($error) && count($error))
                $er[] = $error[0];
        }

        return $er;
    }

    public static function sanitizeTitle($title, $raw_title = '', $context = 'display') {
        $title = strip_tags($title);
        // Preserve escaped octets.
        $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
        // Remove percent signs that are not part of an octet.
        $title = str_replace('%', '', $title);
        // Restore octets.
        $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
        /* if (seems_utf8($title)) {
          if (function_exists('mb_strtolower')) {
          $title = mb_strtolower($title, 'UTF-8');
          }
          $title = utf8_uri_encode($title, 200);
          } */
        $title = strtolower($title);
        $title = preg_replace('/&.+?;/', '', $title); // kill entities
        $title = str_replace('.', '-', $title);
        if ('save' == $context) {
            // nbsp, ndash and mdash
            $title = str_replace(array('%c2%a0', '%e2%80%93', '%e2%80%94'), '-', $title);
            // iexcl and iquest
            $title = str_replace(array('%c2%a1', '%c2%bf'), '', $title);
            // angle quotes
            $title = str_replace(array('%c2%ab', '%c2%bb', '%e2%80%b9', '%e2%80%ba'), '', $title);
            // curly quotes
            $title = str_replace(array('%e2%80%98', '%e2%80%99', '%e2%80%9c', '%e2%80%9d'), '', $title);
            // copy, reg, deg, hellip and trade
            $title = str_replace(array('%c2%a9', '%c2%ae', '%c2%b0', '%e2%80%a6', '%e2%84%a2'), '', $title);
        }
        $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
        $title = preg_replace('/\s+/', '-', $title);
        $title = preg_replace('|-+|', '-', $title);
        $title = trim($title, '-');
        return $title;
    }

    public static function getAdminErrorMsg($errors) {
        $errs = array();
        if (is_array($errors)) {
            foreach ($errors as $field => $error) {
                $errs[] = $error[0];
            }
        }
        $errMsg = implode(',', $errs);
        return $errMsg;
    }

    public static function themePriceFormat($amt, $decimals = 0) {
        return number_format($amt, $decimals, '.', ',');
    }

    public static function getProfilePic($id) {
        $path = Yii::app()->basePath . '/../uploads/admin/profile/';
        if (file_exists($path . 'pic-' . $id)) {
            return '/uploads/admin/profile/' . 'pic-' . $id;
        }
        return '/img/mail-avatar.jpg';
    }

    public static function compareArray($new, $old, $exclude = array()) {
        $differences = array();
        foreach ($old as $key => $value) {
            if (!in_array($key, $exclude) && $old[$key] != $new[$key]) {
                $differences[$key] = array(
                    'old' => $old[$key],
                    'new' => $new[$key]);
            }
        }

        return $differences;
    }

    public static function isValidDomainName($domainNname) {
        return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domainNname) //valid chars check
                && preg_match("/^.{1,253}$/", $domainNname) //overall length check
                && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domainNname) ); //length of each label
    }

    public static function endsWith($haystack, $needle) {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

    /**
     * Sorts an array by particular index in multidimensional array
     * @param type $array
     * @param type $on
     * @param type $order
     * @return type
     */
    public static function array_sort($array, $on, $order = SORT_ASC) {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }

    /**
     * generate unique string
     * @param type $length
     * @return string 
     */
    public static function generateRandomString($length = 54) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~-_.';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * 
     * @param type $string
     * @param type $maxCharacter
     * Truncate string to the max character
     * @return type string
     * return truncated string
     * eg .. : some stri..
     */
    public static function trucateString($string = NULL, $maxCharacter = null) {
        $strLength = strlen($string);
        return ($strLength > $maxCharacter) ? substr($string, 0, $maxCharacter) . '..' : $string;
    }

    public static function dateDifference($timeFrom) {
        $dateFrom = $timeFrom;
        $dateTo = time(); //strtotime($date);
        $dateDiff = $dateTo - $dateFrom;
        $days = floor($dateDiff / (60 * 60 * 24));
        $hours = floor(($dateDiff - ($days * 60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($dateDiff - ($days * 60 * 60 * 24) - ($hours * 60 * 60)) / 60);
        //echo $days."days,".$hours." hours,". $minutes . "minutes";
        if ($dateDiff > 0) {
            if ($days >= 2) {
                return $days . " days " . "ago";
            } elseif ($days > 1) {
                if ($hours) {
                    return $days . " days " . $hours . " hours " . " ago";
                } else {
                    return $days . " days ago";
                }
            } elseif ($days == 1) {
                if ($hours) {
                    return $days . " day " . $hours . " hours " . " ago";
                } else {
                    return $days . " day ago";
                }
            } elseif ($days == 0) {
                if ($hours == 0) {
                    if ($minutes > 3) {
                        return $minutes . " minutes ago";
                    } else {
                        return "about to expire";
                    }
                } else {
                    if ($minutes) {

                        if ($minutes == 1) {
                            return $hours . " hours " . $minutes . " minute ago";
                        } else {
                            return $hours . " hours " . $minutes . " minutes ago";
                        }
                    } else {
                        return $hours . " hours ago";
                    }
                }
            }
        } else {
            return "Just Now";
        }
    }

    /**
     * campaign specific 
     */
    public static function percentage($val1, $val2, $precision) {
        $res = round(($val1 / $val2) * 100, $precision);
        return $res;
    }

}
