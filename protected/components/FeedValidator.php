<?php

/**
 * Description of FeedValidator
 *
 * @author abhishek
 */
class FeedValidator {

    public $title;
    public $language;
    public $pubDate;
    public $imageTitle;
    public $imageLink;
    public $imageUrl;
    public $items;
    public $config;
    public $feed;
    public $output;
    public $errMsgs;
    public $report;
    public $errOutput;
    public $obj;

    public function __construct() {
        $this->config = parse_ini_file(Yii::app()->basePath . "/config/feedsConfig.ini", true);
    }

    public function libxml_display_error($error) {
        global $output;
        $return = "<br/>\n";
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= "<b>Warning $error->code</b>: ";
                break;
            case LIBXML_ERR_ERROR:
                $return .= "<b>Error $error->code</b>: ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= "<b>Fatal Error $error->code</b>: ";
                break;
        }
        $return = '<span style="color: red;">' . $return . '</span>';
        $return .= trim($error->message);
        if ($error->file) {
            //$return .= " in <b>$error->file</b>"; 
        }
        //$return .= " on line <b>$error->line</b>\n"; 

        return '<div style="text-align: left;">' . $return . '</div>';
    }

    function libxml_display_errors() {
        $errors = libxml_get_errors(); // returns array of LibXMLError object
        foreach ($errors as $error) {
            print libxml_display_error($error);
        }
        libxml_clear_errors();
    }

// validate mandatory fields under channel
    function initialize($feed) {
        $this->config = parse_ini_file(Yii::app()->basePath . "/config/feedsConfig.ini", true);
        ;
        $this->feed = $feed;
        $this->errMsgs = '';
        $this->report = '';
        $this->output = '';
    }

//strip invalid tags
    function stripInvalidTags($prv = '') {
        //global $config, $feed, $errMsgs, $report, $output, $errOutput;
        $_errOutput = '';
        $validTags = array('title', 'pubDate', 'image', 'language', 'link', 'item', 'atom:link');
        $validItemChildTags = array('title', 'link', 'pubDate', 'guid', 'description', 'content:encoded', 'category', 'keywords');
        $validImageChildTags = array('title', 'link', 'url');

        if (stristr($this->feed, 'encoding="utf-8"')) {
            if (isset($_POST['useISO'])) {
                //$this->feed = str_ireplace ('encoding="utf-8"', 'encoding="ISO-8859-1"', $this->feed);
                $this->output .= "<p><span style='color: red;'>Trying to validate assuming charset is ISO-8859-1</span></p>";
            }
        }

        $xmlDoc = new DOMDocument();
        if (!@$xmlDoc->loadXML($this->feed))
            return;

        $x = $xmlDoc->documentElement;
        $list = array();
        foreach ($x->childNodes AS $item) {
            if ($item->nodeName == 'channel') {
                foreach ($item->childNodes as $chItems) {
                    if ($chItems->nodeName !== '#text') {
                        if ($chItems->nodeName == 'image') {
                            foreach ($chItems->childNodes as $imgChild) {
                                if (!in_array($imgChild->nodeName, $validImageChildTags)) {
                                    if ($imgChild->nodeName !== '#text') {
                                        $invalidImageChilds[] = $imgChild;
                                        $_errOutput .= '<tr><td>' . wr('&lt;' . $imgChild->nodeName . '&gt;') . '</td><td> ' . wr('ignored under &lt;image&gt;')
                                                . '</td></tr>';
                                    }
                                }
                            }
                            if (is_array($invalidImageChilds)) {
                                foreach ($invalidImageChilds as $node) {
                                    $chItems->removeChild($node);
                                }
                            }
                        } else {
                            $items[] = $chItems->nodeName;
                        }
                    }
                }
                $list = array_unique($items);
            }
        }

        $unwanted = array_diff($list, $validTags);
        $channelNode = $xmlDoc->getElementsByTagName('channel')->item(0);
        $this->output .= '<div> <strong>IGNORING unnecessary tags (listed below if any) ..</strong>';
        $this->errOutput .= '<br><strong>Ignoring unnecessary elements (if any)</strong>';
        $this->output .= '<ul style="color: red;">';

        foreach ($unwanted as $t) {
            $node = $xmlDoc->getElementsByTagName($t)->item(0);
            if ($node) {
                $channelNode->removeChild($node);
                $this->output .= "<li>" . $node->nodeName . ' IGNORED</li>';
                $_errOutput .= '<tr><td>' . wr('&lt;' . $node->nodeName . '&gt;') . '</td><td> ' . wr('ignored under &lt;channel&gt;') . '</td></tr>';
            }
        }



        $this->output .= "</ul></div>";


        $this->feed = $xmlDoc->saveXML();
        //echo $this->feed;

        $allItemNodes = $this->getNodeData('/rss/channel/item');
        $allItemNodes = $xmlDoc->getElementsByTagName('item');
        $cntr = 0;
        foreach ($allItemNodes as $anItem) {
            $itemChilds = array();
            $toRemove = array();
            $routput = '';
            //$_errOutput ='';
            ++$cntr;
            foreach ($anItem->childNodes as $chItem) {
                if ($chItem->nodeName !== '#text') {
                    if (!in_array($chItem->nodeName, $validItemChildTags)) {// not permitted 
                        $toRemove[] = $chItem;
                        $routput .= "<li>" . $chItem->nodeName . ' IGNORED</li>';
                        //echo $node->nodeName;
                        $_errOutput .= '<tr><td>' . wr('&lt;' . $chItem->nodeName . '&gt;') . '</td><td>' . wr('ignored under &lt;item&gt; # ' . $cntr) . '</td></tr>';
                    }
                }
            }

            if (count($toRemove)) {
                $this->output .= "Item #" . ($cntr) . $routput;
            }

            foreach ($toRemove as $nitm) {
                $anItem->removeChild($nitm);
            }
        }
        if ($prv == 'prv') // no error output for preview
            $this->errOutput = '';
        else
            $this->errOutput .= '<table border=0 padding=0 margin=0>' . $_errOutput . '</table>';
        $this->feed = $xmlDoc->saveXML();
    }

// title mismatch
    function checkTitleMismatch() {
        global $config, $feed, $errMsgs, $report, $output, $errOutput;
        //check if image title and channel title are same;
        $this->output .= "<br><br><strong>Checking image title and channel title ... =></strong>";
        $this->errOutput .= "<hr><strong>Checking image title and channel title ...</strong>";
        $c1 = '';
        $c2 = '';
        $xpath1 = '/rss/channel/title';
        $xpath2 = '/rss/channel/image/title';

        $r1 = $this->getNodeData($xpath1);
        $r2 = $this->getNodeData($xpath2);
        if (is_object($r1) || is_array($r1)) {
            foreach ($r1 as $art) {
                $c1 = $art->nodeValue;
                break;
            }
        }

        if (is_object($r2) || is_array($r2)) {
            foreach ($r2 as $art) {
                $c2 = $art->nodeValue;
                break;
            }
        }
        //echo $c1, $c2;
        if (trim($c1) != trim($c2)) {
            $this->output .= er($this->errMsgs['titlemismatherror']);
            $this->errOutput .= '<br>' . er($this->errMsgs['titlemismatherror']);
            if ($r1)
                $this->errOutput .= '<br>Channel Title: <b><span style="background-color: #FFFF00">' . trim($c1) . '</span></b>';
            else
                $this->errOutput .= '<br>' . er('element &lt;title&gt; under element &lt;image&gt; is missing ');
            if ($r2)
                $this->errOutput .= '<br>Image Title: <b><span style="background-color: #33CC00">' . trim($c2) . '</span></b>';
            else
                $this->errOutput .= '<br>Image Title: ' . er('element &lt;title&gt; under element &lt;image&gt; is missing ');
        } else {
            $this->output .= 'OK';
            $this->errOutput .= ' <span class="ok">[OK]</span>';
        }
    }

    function checkLogo() {
        global $config, $feed, $errMsgs, $report, $output, $errOutput;
        $tag = '/rss/channel/image/url';
        $imgOutput = '';

        $str = '';

        $this->errOutput .= "<hr><strong>Checking image logo ... </strong>";
        if ($result = $this->getNodeData($tag)) {
            $logo = $result->item(0)->nodeValue;
            $this->output .= "<br>Logo [$tag] => ";
            $imgOutput .= $this->validateImageSize($logo, array('width' => 120, 'height' => 30), true);
            $this->errOutput .= $imgOutput;
            $this->output .= $imgOutput;
            $str .= $logo;
            if (isset($_POST['showimage']) && $_POST['showimage'] == 'on')
                $str .= '<br><img src="' . $logo . '">';
            $this->output .= '<div style="border: 1px dashed; background-color: #f0f0f0; margin-left: 10px; margin-right: 20px">' . $str . '</div>';
        } else {
            $this->errOutput .= '<br>' . er('element &lt;url&gt; under element &lt;image&gt; is missing ');
        }
    }

    function checkLink() {
        global $config, $feed, $errMsgs, $report, $output, $errOutput;
        $this->output .= "<br><br><strong>Validating Image Link, Logo ... </strong>";
        $this->errOutput .= "<hr><strong>Checking image Link ...</strong>";
        $tag = '/rss/channel/image/link';
        if ($result = $this->getNodeData($tag)) {
            $link = $result->item(0)->nodeValue;
            $this->output .= "<br>Image Link [$tag] => ";
            if (isValidUrl($link)) {
                if (isValidLink($link)) {
                    $this->output .= "OK";
                    $this->errOutput .= ' <span class="ok">[OK]</span>';
                } else {
                    $this->output .= er($this->errMsgs['invalidlinkerror']);
                    $this->errOutput .= er($this->errMsgs['invalidlinkerror']);
                }
            } else {
                $this->errOutput .= '<br>' . er('Invalid link <b>' . $link . "</b> under &lt;image&gt;");
            }
        } else {
            $this->errOutput .= '<br>' . er('element &lt;link&gt; under element &lt;image&gt; is missing ');
        }
    }

    /**
      Check if a mandatory tag exists as given by $tagpath in the xml document.
     * */
    function checkMandatoryTags() {
        $this->errOutput = '';
        //echo "<pre>", print_r($this->config), "</pre>";
        //global $errorMsgs, $this->config, $this->feed, $this->errMsgs, $this->output, $this->errOutput;

        $chnMandatoryTagMissing = '';
        $mandatory_fields = $this->config['Mandatory']; //mandatory_fields is associatve array
        $this->errMsgs = $this->config['ERRORMSGS'];

        $this->output .= "<br><strong>Validating Mandatory tags (channels)... </strong>";
        $this->errOutput .= "<hr><strong>Checking mandatory tags under &lt;channel&gt; ... </strong>";
        foreach ($mandatory_fields as $tag => $tagpath) {
            $this->output .= "<br>[$tagpath] => ";
            if (!($result = $this->getNodeData($tagpath))) {
                $this->output .= er($this->errMsgs['mandatorytagserror'] . " <b>$tag</b>");
                $chnMandatoryTagMissing .= '<br>' . er($this->errMsgs['mandatorytagserror'] . " <strong>&lt;$tag&gt;</strong> under &lt;channel&gt;");
            }
        }
        if ($chnMandatoryTagMissing != '')
            $this->errOutput .= $chnMandatoryTagMissing;
        else
            $this->errOutput .= ' <span class="ok">[OK]</span>';
        $this->checkMandatoryItemTags();
        //echo $this->output;
    }

    /**
      Check if a mandatory tag exists as given by $tagpath in the xml document.
     * */
    function checkMandatoryItemTags() {
        global $errorMsgs, $config, $feed, $errMsgs, $output, $errOutput, $errOutputCat, $errOutputLink;

        $errOutputCat = '';
        $errOutputLink = '';
        $bgcol = '';
        $mandatory_fields = $this->config['MandatoryItemTags']; //mandatory_fields is associatve array
        $this->errMsgs = $this->config['ERRORMSGS'];
        $_categories = getCategories($_POST['intel']);
        //print_r($_categories);
        $this->output .= "<br><strong>Validating Mandatory Item tags and <i>Category</i>... </strong>";
        $this->errOutput .= "<hr><strong>Checking mandatory tags under each  &lt;item&gt; ...</strong>";

        $allItemNodes = $this->getNodeData('/rss/channel/item');
        //$allItemNodes = $xmlDoc->getElementsByTagName('item');
        $cntr = 0;
        $strCatFound = array();
        $strCat = '';
        foreach ($allItemNodes as $anItem) {
            $this->output .= "<br><b>Item # " . (++$cntr) . '</b>';


            foreach ($anItem->childNodes as $chItem) {
                if ($chItem->nodeName !== '#text') {
                    if ($chItem->nodeName == 'category') {
                        $strCatFound[] = $chItem->nodeValue;

                        if (in_array(strtolower(trim($chItem->nodeValue)), $_categories)) {

                            $strCat = 'OK';
                        } else {
                            $errOutputCat .= '<br>' . er('Invalid category <b>' . $chItem->nodeValue . "</b> under &lt;item&gt; # " . $cntr);
                            $strCat = er($chItem->nodeValue . ' is NOT A VALID Category');
                        }
                    } else if ($chItem->nodeName == 'link') {
                        if (!isValidUrl(trim($chItem->nodeValue))) {
                            //if(! validateUrl(trim($chItem->nodeValue))) {
                            $errOutputLink .= '<br>' . wr('This link may not be correct <b>' . $chItem->nodeValue . "</b> under &lt;item&gt; # " . $cntr . '. Plese verify.');
                        }
                    }
                    $childList[] = '/rss/channel/item/' . $chItem->nodeName;
                }
            }

            $missingChilds = array_diff($mandatory_fields, $childList);
            $resErr = '';
            $_errOutput = '';
            foreach ($mandatory_fields as $tag) {

                if (in_array($tag, $missingChilds)) {
                    $_errOutput .= er($this->errMsgs['mandatorytagserror'] . " <strong>&lt;" . substr(strrchr($tag, '/'), 1) . "&gt;</strong> under &lt;item&gt; # " . $cntr) . '<br>';
                    $res = er($this->errMsgs['mandatorytagserror']);
                }
                else
                    $res = "OK";
                $this->output .= '<br>' . $tag . ' => ' . $res;
            }
            $bgcol = ($bgcol == '#f5f5f5') ? '#fff' : '#f5f5f5';
            if ($_errOutput) {
                $this->errOutput .= '<div style="border-bottom: 1px dotted #fff ; width: 600px; padding: 0px; background-color: ' . $bgcol . ';">' . $_errOutput . '</div>';
            }
            $this->output .= '<br><strong>Category => </strong> ' . $strCat;
        }

        if ($_errOutput == '')
            $this->errOutput .= ' <span class="ok">[OK]</span>';

        //echo '<BR>CATEGORY FOUND : '. implode(',' , array_unique($strCatFound) ).'</br>';
    }

    function invalidCategory() {
        global $errOutputCat, $errOutput;
        $this->errOutput .= '<hr><strong>Checking Category ...  </strong>';
        if ($errOutputCat)
            $this->errOutput .= $errOutputCat;
        else
            $this->errOutput .= ' <span class="ok">[OK]</span>';
    }

    function invalidLinks() {
        global $errOutputLink, $errOutput;
        $this->errOutput .= '<hr><strong>Checking Links ...  </strong>';
        if ($errOutputLink)
            $this->errOutput .= $errOutputLink;
        else
            $this->errOutput .= ' <span class="ok">[OK]</span>';
    }

    function checkMandatoryCDATAAndEocoding() {
        global $errorMsgs, $errMsgs, $output, $config, $feed, $errOutput, $embedErr;
        $strErr = '';
        $cdata_sections = $this->config['CDATA'];
        $insuffix = '';
        $isImageError = false;
        $this->output .= "<br><br><strong>Parsing CDATA (search images)..... </strong>";
        $this->errOutput .= "<hr><strong>Searching images .... </strong>";

        foreach ($cdata_sections as $tag => $tagpath) {
            $imgStack = array();
            $i = 0;
            if ($result = $this->getNodeData($tagpath)) {
                $count = 0;
                foreach ($result as $art) {

                    $isEncoded = false;
                    $str = '';
                    if (strstr($tagpath, '/rss/channel/item'))
                        $strItemNo = '<b>[' . ($i + 1) . ']</b>';
                    else
                        $strItemNo = '';
                    $this->output .= "<br>[$tagpath] $strItemNo=> ";
                    $content = $art->nodeValue;
                    if (1) {
                        // check img && embed
                        $count++;
                        if ($tagpath == '/rss/channel/item/content:encoded' || $tagpath == '/rss/channel/item/description') {
                            $strErr = '';
                            $str .= "<strong>Searching for Images in </strong>[$tagpath] $strItemNo ";
                            $error = false;

                            //check img
                            preg_match_all('/<img[^>]*>/i', $content, $matches);

                            foreach ($matches[0] as $key => $image) {
                                preg_match('/src\s*=\s*[\'|\"](.+?)[\'|\"]/', $image, $mts);
                                $imgStack[$i][] = $mts[1];
                                //$rawImg = $this->validateImage($mts[1]);
//                                if ($rawImg == false) {
//                                    $str .= er($this->errMsgs['nojpgerror']);
//                                    $isImageError = TRUE;
//                                } else {
//                                    $str .= "OK";
//                                }
//                                preg_match('/src\s*=\s*[\'|\"](.+?)[\'|\"]/', $image, $mts);
//                                $str .= '<br><b> &nbsp; </b> Found : <strong>' . $mts[1] . '</strong> => ';
//                                if (preg_match('/(\.jpg|\.jpeg|\.gif|\.png)$/i', $mts[1], $stuff)) {
//
//                                    $str .= "OK";
//                                } else {
//                                    $str .= er($this->errMsgs['nojpgerror']);
//                                    $insuffix = " in &lt;" . substr(strrchr($tagpath, '/'), 1) . "&gt; under &lt;item&gt; # " . $strItemNo;
//                                    $strErr = '<tr><td>' . $mts[1] . '' . $insuffix . '</td><td style="padding-left: 10px;">' . er($this->errMsgs['nojpgerror']) . '</td></tr>';
//                                    $isImageError = true;
//                                }
//
                                //if (isset($_POST['showimage']) && $_POST['showimage'] == 'on') {
                                //    $str .= '<br><img src="' . $mts[1] . '">';
                                //}
                            }

                            //print_r($imgStack[$i]);
                            if (isset($imgStack[$i]) && is_array($imgStack[$i])) {

                                //check image validity only when user want to validate images
                                //otherwise use the images as it is
                                $_result = array();
                                if (isset($_POST['validateimage']) && $_POST['validateimage'] != NULL) {
                                    $_result = multiRequest($imgStack[$i]);
                                }

                                if ($_result) {
                                    foreach ($_result as $key => $_res) {
                                        $im = @imagecreatefromstring($_res);
                                        if ($im !== false) {
                                            if (isset($_POST['showimage']) && $_POST['showimage'] == 'on') {
                                                $str .= '<br><img src="' . $imgStack[$i][$key] . '">';
                                            }
                                        } else {
                                            $str .="Invalid Image";
                                        }
                                    }
                                } else {
                                    foreach ($imgStack[$i] as $_url) {
                                        if (isset($_POST['showimage']) && $_POST['showimage'] == 'on') {
                                            $str .= '<br><img src="' . $_url . '">';
                                        }
                                    }
                                }
                            }
                        } // chk img ends
                        // check embed



                        if ($tagpath == '/rss/channel/item/content:encoded') {
                            $doc = new DOMDocument();
                            @$doc->loadHTMl($content);
                            $embedObjects = $doc->getElementsByTagName('embed');
                            if (is_object($embedObjects)) {

                                foreach ($embedObjects as $emObject) {
                                    $_emWidth = '';
                                    $_emHeight = '';
                                    $_embedErr = '';
                                    if ($emObject->hasAttribute('width'))
                                        $_emWidth = $emObject->getAttribute('width');
                                    else
                                        $_embedErr .= ' width not specified;';
                                    if ($emObject->hasAttribute('height'))
                                        $_emHeight = $emObject->getAttribute('height');
                                    else
                                        $_embedErr .= ' height not specified;';

                                    if ($_emWidth != '' && (int) $_emWidth > 620) {
                                        $_embedErr .= er(' Width: <b>' . $_emWidth . '</b> is more than 620px');
                                    }
                                    if ($_embedErr)
                                        $embedErr .= '<br>In &lt;item&gt; #' . $strItemNo . ' found &lt;embed... in which : ' . $_embedErr;
                                }
                            }
                        }
                    } //check img && embed


                    if (!$isEncoded) {
                        $this->output .= "OK";
                        if ($str)
                            $this->output .= '<div style="border: 1px dashed; background-color: #fafafa; margin-left: 10px; margin-right: 20px">' . $str . '</div>';
                    }
                    else {
                        $this->output .= '<div style="border: 1px dashed; background-color: #fafafa; margin-left: 10px; margin-right: 20px">' . $str . '</div>';
                    }

                    if ($strErr) {
                        $this->errOutput .= '<table border=0 padding=0 margin=0>' . $strErr . '</table>';
                    }
                    $i++;
                } // end foreach
//                if ($imgStack)
//                    echo "<pre>", print_r($imgStack), "</pre>";
            }
        }

        if (!$isImageError)
            $this->errOutput .= '<span class="ok">[OK]</span>';
        $this->checkEmbed();
    }

    function checkEmbed() {
        global $errOutput, $embedErr;
        $this->errOutput .= "<hr><strong>Searching embed tags inside &lt;content:encoded&gt; .... </strong>";
        if ($embedErr)
            $this->errOutput .= $embedErr;
        else
            $this->errOutput .= '<span class="ok">[OK]</span>';
    }

    function curlRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        // echo $data;
        //exit;
        return($data);
    }

    /**
      return NodeListObject or false
     * */
    function getNodeData($node) {
        // global $feed;

        $xmldoc = new DOMDocument();
        $xmldoc->loadXML($this->feed);
        $xpath = new Domxpath($xmldoc);
        $result = $xpath->query($node);

//	echo '0000'. gettype($result);
        $nodeExist = false;

        //iterate object to check if it is empty
        if (is_object($result) || is_array($result)) {
            foreach ($result as $art) {
                $nodeExist = true;
            }
        }
        if ($nodeExist)
            return $result;
        else
            return false;
    }

    function isContentSame($xpath1, $xpath2) {
        global $feed;
        $c1 = '';
        $c2 = '';
        $r1 = $this->getNodeData($xpath1);
        $r2 = $this->getNodeData($xpath2);
        if (is_object($r1) || is_array($r1)) {
            foreach ($r1 as $art) {
                $c1 = $art->nodeValue;
                break;
            }
        }

        if (is_object($r2) || is_array($r2)) {
            foreach ($r2 as $art) {
                $c2 = $art->nodeValue;
                break;
            }
        }
        //echo $c1, $c2;
        if (trim($c1) == trim($c2))
            return true;
        else
            return false;
    }

    function validateImageSize($imgurl, $dimension, $exact = true) {
        global $errMsgs, $output;
        $ch = curl_init();
        $timeout = 0;

        curl_setopt($ch, CURLOPT_URL, $imgurl);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        // Get binary 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);

        $imageStr = curl_exec($ch);
        \
        curl_close($ch);

        //$this->output .=  "$logourl".gettype($imageStr);
        $im = @imagecreatefromstring($imageStr);
        if ($im !== false) {
            $width = imagesx($im);
            $height = imagesy($im);
            if (($width <= $dimension['width'] ) && ( $height <= $dimension['height'] )) {
                return ' <span class="ok">[OK]</span>';
            }
            else
                return '<br>' . er($this->errMsgs['logosizeerror'] . '<span style="color: blue;"> Existing size (' . $width . 'px x ' . $height . 'px)</span>');
        }
        else {
            return '<br>' . er($this->errMsgs['invalidimageerror']);
        }
    }

    function validateImage($imgurl = "") {
        $ch = curl_init();
        $timeout = 0;
        $mh = curl_multi_init();
        curl_setopt($ch, CURLOPT_URL, $imgurl);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        // Get binary 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_multi_add_handle($mh, $ch);

//        
//            $active = null;
//            
//            //execute the handles
//            do {
//                $mrc = curl_multi_exec($mh, $active);
//                echo $mrc;
//            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
//
//            while ($active && $mrc == CURLM_OK) {
//                if (curl_multi_select($mh) != -1) {
//                    do {
//                        $mrc = curl_multi_exec($mh, $active);
//                        echo $mrc;
//                    } while ($mrc == CURLM_CALL_MULTI_PERFORM);
//                }
//            }
//            


        $imageStr = curl_exec($ch);

        curl_close($ch);
        curl_multi_close($mh);
        //$this->output .=  "$logourl".gettype($imageStr);
        $im = @imagecreatefromstring($imageStr);

        return $im;
    }

    function chkMandatoryCDATA($str = '') {
        global $feed, $output, $errOutput;
        $_errOutput = '';
        $this->errOutput .= '<hr><strong>Checking Mandatory CDATA Section ... </strong>';
        $ele = 'content:encoded';
        $cpattern = "/\<" . $ele . '\>(.*?)\<\!\[CDATA\[(?<text>[^\]]*)\]\]\>(.*?)\<\/' . $ele . '\\>/';
        $pattern = "/\<" . $ele . '\>(.*?)(?<text>[^\]]*)(.*?)\<\/' . $ele . '\\>/';

        //search for content:encoded
        $cntr = 0;
        $found = preg_match_all($pattern, $this->feed, $matches);
        //inside each content:encoded check if CDATA section is there 
        foreach ($matches[0] as $match) {
            //extra check 
            $strRemain = substr($match, strlen('<content:encoded>'));
            if (substr(trim($strRemain), 0, strlen('<![CDATA[')) == '<![CDATA[') {
                $cdataExists = true;
            } else {
                $cdataExists = false;
            }

            $cntr++;
            if ($cdataExists) {
                $found = preg_match_all($cpattern, $match, $cmatches);
                if (!$found) {
                    $_errOutput .= "<br>" . wr('CDATA exist inside &lt;content:encoded&gt; #' . $cntr . ', but syntax is doubutful, please verify yourself. ');
                }
            } else {
                $_errOutput .= "<br>" . er('CDATA section missing inside &lt;content:encoded&gt; #' . $cntr);
            }
        }

        $ele = 'description';
        $cpattern = "/\<" . $ele . '\>(.*?)\<\!\[CDATA\[(?<text>[^\]]*)\]\]\>(.*?)\<\/' . $ele . '\\>/';
        $pattern = "/\<" . $ele . '\>(.*?)(?<text>[^\]]*)(.*?)\<\/' . $ele . '\\>/';

        //search for description
        $cntr = 0;
        $found = preg_match_all($pattern, $this->feed, $matches);
        //inside each description check if CDATA section is there 
        foreach ($matches[0] as $match) {
            $strRemain = substr($match, strlen('<description>'));
            //extra check 
            if (substr(trim($strRemain), 0, strlen('<![CDATA[')) == '<![CDATA[') {
                $cdataExists = true;
            } else {
                $cdataExists = false;
            }

            $cntr++;
            if ($cdataExists) {
                $found = preg_match_all($cpattern, $match, $cmatches);
                if (!$found) {
                    $_errOutput .= "<br>" . wr('CDATA exist inside &lt;description&gt; #' . $cntr . ', but syntax is doubutful, please verify yourself. ');
                }
            } else {
                $_errOutput .= "<br>" . er('CDATA section missing inside &lt;description&gt; #' . $cntr);
            }
        }

        if ($_errOutput)
            $this->errOutput .= $_errOutput;
        else
            $this->errOutput .= ' <span class="ok">[OK]</span>';
    }

//    function preview() {
//        $number = 100;
//        $this->feed["channel"]["title"];
//        $this->feed["channel"]["link"];
//        $this->feed["channel"]["language"];
//        $this->feed["channel"]["pubDate"];
//
//        // image
//        $this->feed["image"]["title"];
//        $this->feed["image"]["url"];
//        $this->feed["image"]["link"];
//
//        // items
//        for ($i = 0; $i < $number; $i++) {
//            $this->feed["item"]["title"][$i];
//            $this->feed["item"]["link"][$i];
//            $this->feed["item"]["description"][$i];
//            $this->feed["item"]["author"][$i];
//            $this->feed["item"]["pubdate"][$i];
//        }
//    }

    function uncdata($xml) {
        // States:
        //
        //     'out'
        //     '<'
        //     '<!'
        //     '<!['
        //     '<![C'
        //     '<![CD'
        //     '<![CDAT'
        //     '<![CDATA'
        //     'in'
        //     ']'
        //     ']]'
        //
        // (Yes, the states a represented by strings.) 
        //

        $state = 'out';

        $a = str_split($xml);

        $new_xml = '';

        foreach ($a AS $k => $v) {

            // Deal with "state".
            switch ($state) {
                case 'out':
                    if ('<' == $v) {
                        $state = $v;
                    } else {
                        $new_xml .= $v;
                    }
                    break;

                case '<':
                    if ('!' == $v) {
                        $state = $state . $v;
                    } else {
                        $new_xml .= $state . $v;
                        $state = 'out';
                    }
                    break;

                case '<!':
                    if ('[' == $v) {
                        $state = $state . $v;
                    } else {
                        $new_xml .= $state . $v;
                        $state = 'out';
                    }
                    break;

                case '<![':
                    if ('C' == $v) {
                        $state = $state . $v;
                    } else {
                        $new_xml .= $state . $v;
                        $state = 'out';
                    }
                    break;

                case '<![C':
                    if ('D' == $v) {
                        $state = $state . $v;
                    } else {
                        $new_xml .= $state . $v;
                        $state = 'out';
                    }
                    break;

                case '<![CD':
                    if ('A' == $v) {
                        $state = $state . $v;
                    } else {
                        $new_xml .= $state . $v;
                        $state = 'out';
                    }
                    break;

                case '<![CDA':
                    if ('T' == $v) {
                        $state = $state . $v;
                    } else {
                        $new_xml .= $state . $v;
                        $state = 'out';
                    }
                    break;

                case '<![CDAT':
                    if ('A' == $v) {
                        $state = $state . $v;
                    } else {
                        $new_xml .= $state . $v;
                        $state = 'out';
                    }
                    break;

                case '<![CDATA':
                    if ('[' == $v) {


                        $cdata = '';
                        $state = 'in';
                    } else {
                        $new_xml .= $state . $v;
                        $state = 'out';
                    }
                    break;

                case 'in':
                    if (']' == $v) {
                        $state = $v;
                    } else {
                        $cdata .= $v;
                    }
                    break;

                case ']':
                    if (']' == $v) {
                        $state = $state . $v;
                    } else {
                        $cdata .= $state . $v;
                        $state = 'in';
                    }
                    break;

                case ']]':
                    if ('>' == $v) {
                        $new_xml .= str_replace('>', '&gt;', str_replace('>', '&lt;', str_replace('"', '&quot;', str_replace('&', '&amp;', $cdata))));
                        $state = 'out';
                    } else {
                        $cdata .= $state . $v;
                        $state = 'in';
                    }
                    break;
            } // switch
        }

        //
        // Return.
        //
            return $new_xml;
    }

    public function getOutput() {
        return $this->output;
    }

    //preview related methods
    function preview($rawFeed = "") {
        //global $feedArray, $feed, $obj;
        if (isset($_POST['useISO'])) {
            $rawFeed = str_ireplace('encoding="utf-8"', 'encoding="ISO-8859-1"', $rawFeed);
            echo "<p><span style='color: red;'>Trying to preview assuming charset is ISO-8859-1</span></p>";
        }
        //echo "<pre>", print_r($this->feed), "</pre>";exit;
        $this->obj = new channel();
        $this->prvChannelElements($rawFeed);
        //$obj->html();
        //echo 'showing preview';
        $this->prvItems($rawFeed);
        //var_dump($obj);
        return '<div class="row"><div class="col-lg-12"><div style="text-align: left; background:#FFFFFF repeat-x scroll 0 0;"><div id="outer-container" style="text-align: left; border: 1px solid #ccc; margin-top: 20px; background: #fff; color: #000;">' . $this->obj->html() . '</div></div></div></div>';
    }

    function prvChannelElements($feed) {
        //global $obj;
        $prefix = '/rss/channel/';
        $elements = array('title' => 'title', 'language' => 'language', 'pubDate' => 'pubDate', 'image/title' => 'imageTitle', 'image/link' => 'imageLink', 'image/url' => 'imageUrl');
        foreach ($elements as $ele => $prop) {
            if ($result = $this->_getNodeData($prefix . $ele, $feed)) {
                $content = $result->item(0)->nodeValue;
                $this->obj->$prop = $content;
            } else {
                $this->obj->$prop = '';
            }
        }
    }

    function prvItems($feed) {
        //global $obj;
        $allItemNodes = $this->_getNodeData('/rss/channel/item', $feed);
        $cntr = 0;
        $strCatFound = array();
        $strCat = '';
        $prefix = '/rss/channel/item';
        $elements = array('title' => 'title', 'language' => 'language', 'pubDate' => 'pubDate', 'description' => 'description', 'content:encoded' => 'contentEncoded', 'category' => 'category');
        $itmArray = array();
        foreach ($allItemNodes as $anItem) {
            $itm = new item();
            foreach ($anItem->childNodes as $chItem) {
                if (in_array($chItem->nodeName, array_keys($elements))) {
                    $prop = $elements[$chItem->nodeName];
                    $itm->$prop = $chItem->nodeValue;
                    //echo $chItem->nodeName .' | ';
                }
            }
            $itmArray[] = $itm;
        }
        $this->obj->items = $itmArray;
    }

    function _getNodeData($node, $feed) {        //global $feed;
        //echo $node;exit;
        //$feed = mb_convert_encoding($this->feed, 'utf-8');
        $xmldoc = new DOMDocument();
        $xmldoc->loadXML($feed);

        $xpath = new Domxpath($xmldoc);
        $result = $xpath->query($node);
        $nodeExist = false;
        //iterate object to check if it is empty
        foreach ($result as $art) {
            $nodeExist = true;
        }
        //var_dump($result);exit;
        if ($nodeExist)
            return $result;
        else
            return false;
    }

    //End of preview methods
}

function er($msg) {
    return '<span style="color: red">' . $msg . '</span>';
}

function wr($msg) {
    return '<span style="color: #339999">' . $msg . '</span>';
}

function getIntels($opt = '') {
    global $config;
    $options = '';
    $intls = explode('|', $this->config['Intels']['intels']);
    foreach ($intls as $intl) {
        $selected = ($opt == $intl) ? ' selected ' : '';
        $options .= '<option value="' . $intl . '" ' . $selected . '>' . $intl . '</option>';
    }
    return $options; //print_r($intls);
}

function getCategories($partner) {
    //echo $partner;
    $default = 'FR';
    //$partner = 'FR';
    $allCategories = array(
        'FR' => array("beaute", "mode", "bien-etre", "love-sexe", "vie-active", "famille", "cuisine", "deco", "astro"),
        'ES' => array("moda", "belleza", "stars", "salud", "familia", "decoracion", "cocina", "horoscopos"),
        'IT' => array("moda", "bellezza", "benessere", "amore", "famiglia", "casa", "hi-tech", "cucina", "oroscopo"),
        'DE' => array('klatsch-tratsch', 'beauty-trends', 'liebe-leben', 'fit-gesund', 'essen-trinken', 'horoskope'),
        'UK' => array('health', 'love-sex', 'Fashion', 'beauty', 'food-drink', 'family-parenting', 'horoscopes'),
    );

    if ($partner && $partner != '')
        $catArray = $allCategories[$partner];
    else
        $catArray = $allCategories[$default];
    return array_map('strtolower', $catArray);
}

function isValidUrl($url) {
    $regex = "((https?|ftp)\:\/\/)?"; // SCHEME
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP
    $regex .= "(\:[0-9]{2,5})?"; // Port
    $regex .= "(\/([ a-z0-9+\$_,\"\'’»«&()#:-]\.?)+)*\/?"; // Path
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 

    if (preg_match("/^$regex$/i", $url, $matches)) {
        return true;
    }
    return false;
}

/* 2nd function to validate url */

function validateURL($url) {
    $pattern = '/^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/';
    return preg_match($pattern, $url, $x);
//print_r($x);echo '--';
}

function isValidLink($url) {
    $url = parse_url($url);
    if (!$url) {
        return false;
    }

    $url = array_map('trim', $url);
    $url['port'] = (!isset($url['port'])) ? 80 : (int) $url['port'];
    $path = (isset($url['path'])) ? $url['path'] : '';

    if ($path == '') {
        $path = '/';
    }

    $path .= ( isset($url['query']) ) ? "?$url[query]" : '';

    if (isset($url['host']) AND $url['host'] != gethostbyname($url['host'])) {
        if (PHP_VERSION >= 5 && 0) {
            $headers = get_headers("$url[scheme]://$url[host]:$url[port]$path");
        } else {
            $fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 3000);

            if (!$fp) {
                return false;
            }
            fputs($fp, "HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n");
            $headers = fread($fp, 128);
            fclose($fp);
        }
        $headers = ( is_array($headers) ) ? implode("\n", $headers) : $headers;
        return (bool) preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
    }
    return false;
}

function multiRequest($data, $options = array()) {

    // array of curl handles
    $curly = array();
    // data to be returned
    $result = array();

    // multi handle
    $mh = curl_multi_init();

    // loop through $data and create curl handles
    // then add them to the multi-handle
    foreach ($data as $id => $d) {

        $curly[$id] = curl_init();

        $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
        curl_setopt($curly[$id], CURLOPT_URL, $url);
        curl_setopt($curly[$id], CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curly[$id], CURLOPT_BINARYTRANSFER, 1);

        // post?
        if (is_array($d)) {
            if (!empty($d['post'])) {
                curl_setopt($curly[$id], CURLOPT_POST, 1);
                curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
            }
        }

        // extra options?
        if (!empty($options)) {
            curl_setopt_array($curly[$id], $options);
        }

        curl_multi_add_handle($mh, $curly[$id]);
    }

    // execute the handles
    $running = null;
    do {
        curl_multi_exec($mh, $running);
    } while ($running > 0);

    // get content and remove handles
    foreach ($curly as $id => $c) {
        $result[$id] = curl_multi_getcontent($c);
        curl_multi_remove_handle($mh, $c);
    }

    // all done
    curl_multi_close($mh);

    return $result;
}

class channel {

    public $title;
    public $language;
    public $pubDate;
    public $imageTitle;
    public $imageLink;
    public $imageUrl;
    public $items;

    public function __construct() {
        
    }

    public function html() {

        //$html = '<div ><div ><a href="'.$this->imageLink.'"><img src="'.$this->imageUrl.'" alt="'.$this->imageTitle.'"/></a></div><div  style="float: left; margin-left: 20px;"><strong>'.$this->title.'</strong></div><div style="float: right; margin-right: 10px;"><span>'.$this->pubDate.'</span></div><div style="clear: both;"></div></div>';
        //echo '<br>'.$this->title;
        //echo '<br>'.$this->language;
        //echo '<br>'.$this->pubDate;
        //echo '<br>'.$this->imageTitle;
        //echo '<br>'.$this->imageLink;
        //echo '<br>'.$this->imageUrl;
        $html = '<div id="container" style="padding:10px;">';



        foreach ($this->items as $item) {
            //file_put_contents('articles.txt', $item->title . "\n", FILE_APPEND);
            $html .= <<<HTM
<div class="article-body">
    <h3 class="article-headline">{$item->title}</h3>
    <div class="article-bayline">
        <a href="{replace: provider URL}">{replace: Provider name}</a> - {$item->pubDate}
    </div>
    
   
    <h2 class="article-summary"><p>{$item->description}</p></h2>
    
    
   <div class="article-content clrfix">
        {$item->contentEncoded}
    </div>
</div>

HTM;


            /* $html .= <<<HTM
              <div class="article-body"><div class="article-content clrfix">
              {$item->contentEncoded}
              </div>
              </div>

              HTM;
             */
            //$html .= '<div style="border-bottom: 2px dotted; margin-top: 20px; margin-bottom: 10px;"><div  style="width: 75%; float: left;  "><strong><a href="'.$item->title.'">'.$item->title.'</a></strong></div><div style="width: 25%; float: right;"><span>'.$item->pubDate.'</span></div><div style="clear: both;"></div><div style="background-color: #f8f8f8; padding: 5px;">'.$item->description.'</div><div>'.$item->contentEncoded.'</div></div>';
        }

        return '<div>' . $html . '</div></div>';
    }

}

class item {

    public $title;
    public $link;
    public $pubDate;
    public $description;
    public $contentEncoded;
    public $category;

    public function __construct() {
        
    }

    public function html() {
        echo '<br>' . $this->title;
        echo '<br>' . $this->link;
        echo '<br>' . $this->pubDate;
        echo '<br>' . $this->description;
        echo '<br>' . $this->contentEncoded;
        echo '<br>' . $this->category;
    }

}

