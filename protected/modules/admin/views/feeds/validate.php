
<?php
ini_set('max_execution_time', 3000);
$config = parse_ini_file(Yii::app()->basePath . "/config/feedsConfig.ini", true);
$feedObject = new FeedValidator();
$canValidate = false;
$feed = '';
$output = '';
$feedurl = 'http://';
$feedbox = '';
header('Content-type: text/html; charset=utf-8');

if (isset($POST['url']) || isset($POST['feedbox'])) {
    $feedbox = (isset($POST['feedbox'])) ? $POST['feedbox'] : '';
    if (isset($POST['url'])) {
        $url = @parse_url($POST['url']);
        if (!$url) {
            $output .= "<div style='color: red; text-align: center;'><p><strong>INVALID URL</strong></p></div>";
            $canValidate = false;
        } else {
            $feed = $feedObject->curlRequest($POST['url']);
            $canValidate = true;
        }
    } else {

        if (isset($POST['feedbox'])) {
            $feed = $POST['feedbox'];
            if (trim($feed) == '')
                $canValidate = false;
            else
                $canValidate = true;
        }
    }
}


if ($canValidate) {
    libxml_use_internal_errors(true);
    $xml = new DOMDocument();
    if (isset($POST['preview'])) {
        if ($xml->loadXML($feed)) {
            $feedObject->stripInvalidTags();
            $output = $feedObject->preview($feed);
        } else {
            $output .= er('<strong>It is not a valid xml File</strong>');
        }
    } else {
        $feedObject->stripInvalidTags();
        libxml_use_internal_errors(true);
        $xml = new DOMDocument();
        if ($xml->loadXML($feed)) {
            $xsdFile = (isset($_REQUEST['noRFC'])) ? 'rss1.xsd' : 'rss.xsd';
            if (0 && !$xml->schemaValidate('./' . $xsdFile)) {
                print '<b><span style="color: red;">Error: Schema Validation Failed!</span></b>';
                $feedObject->libxml_display_errors();
            } else {
                $feedObject->initialize($feed); // initialize configuration

                $feedObject->checkMandatoryTags(); // validate mandatory fields under channel

                $feedObject->checkTitleMismatch(); // title mismatch

                $feedObject->checkLink(); // check link
                $feedObject->checkLogo(); // logo validation
                $feedObject->checkMandatoryCDATAAndEocoding(); // check for mandatory CDATA and if encoded
                //validateEachItem(); // validation for each item

                $output = $feedObject->getOutput();
            }
        } // valid feed             
        else {
            $output .= er('<strong>It is not a valid xml File</strong>');
        }
    }
} // canValidate 
else {
    if (isset($POST['feedbox']))
        $output .= "<div style='color: red; text-align: center;'><p><strong>PLEASE INPUT FEED</strong></p></div>";
}
?>
<div style="margin-left: 10px;">
    <h3>ReadFiend RSS Feed Validator</h3>

    <?php
    if (isset($POST['intel']))
        $options = '<option value="FR">Provider</option>'; //$feedObject->getIntels($POST['intel']);
    else
        $options = '<option value="FR">Provider</option>'; //$feedObject->getIntels();

    $optionHtml = <<<HTML
    Partners <select name='intel'>$options</select>  &nbsp; 
    <input type="checkbox" name="showimage"> Show image  &nbsp;
    <input type="checkbox" name="validateimage"> validate image &nbsp;
    <input type="checkbox" name="noRFC"> Ignore RFC822 Date  &nbsp; 
    <input type="checkbox" name="useISO"> Assume ISO-5589-1
HTML;


    if (( isset($GET['opt']) && $GET['opt'] == 'direct') || isset($POST['feedbox'])) {
        $pageurl = '<a href = "/admin/feeds/validate/">Validate by URI</a>';

        $html = <<<HTML
<div id="teara" style="width: 60%;  margin: auto; text-align: center;">
<div id="teara" style="text-align: left;"><label><b>Feed Box</b></label><br><textarea rows="20" cols="92" name="feedbox">$feedbox</textarea>
</div>
</div>
	<div style="background-color: #f0f0f0; padding: 2px; border-bottom: 1px dashed;"><input type="submit" value="Validate" name="validate"> <input type="submit" value="Preview" name="preview" >
 &nbsp;&nbsp; {$optionHtml} &nbsp; {$pageurl}</div>
HTML;
    } else { //die("here");
        $getUrl = "";
        $url = isset($_POST['url']) ? $_POST['url'] : '';
        if(!$url && isset($GET['url']) && isset($GET['p']) && isset($GET['path'])) {
            $url = "http://".$GET['url']."/".$GET['p']."/bucket/".$GET['path'].".xml";
        }
        $pageurl = '<a href = "/admin/feeds/validate/opt/direct">Validate by direct input</a>';
        $html = <<<HTML
<div>
<div class="row">
    <div class="col-lg-6">
           <input placeholder="http://" class="form-control input-sm" type="text" value="$url" maxlength="255" size="55" id="url" name="url" >     
    </div>
    <div class="col-lg-5">
        <input type="submit" value="Validate" class="btn btn-sm btn-primary"/>
        <input type="submit" value="Preview" name="preview" class="btn btn-sm btn-info"/>         
    </div>
</div>
 
</div> <div style="background-color: #f0f0f0; padding: 2px; border-bottom: 1px dashed;">$optionHtml $pageurl </div>
HTML;
    }
    ?>

    <div style="float: right; margin-right: 25%;">
        <?php //echo $pageurl  ?>
    </div>
    <div style="clear: both;">&nbsp;</div>

    <form method="POST" action="/admin/feeds/validate">

        <?php echo $html; ?>

    </form>

    <style>
        .article-headline {
            font: 21px/25px 'MyriadPro-Bold', 'Helvetica';
            white-space: nowrap;
        }
        .article-summary {
            font: 14px/25px 'MyriadPro-Semibold', 'Helvetica';
        }
        .author-info {
            font: 14px/25px 'MyriadPro-Semibold', 'Helvetica';
        }
        .article-bayline {
            font: 14px/25px 'MyriadPro-Semibold', 'Helvetica';
        }
    </style>

    <div style="text-align: left;">
        <?php
        echo $output;

        /* $showReport = false;
          $showPreview = true;
          if($showReport)
          echo $output;
          if($showPreview)
          ;//echo preview();
         */
        ?>

    </div>
</div>

<script>
    $(document).ready(function(){
        var url = '<?php echo (isset($GET["url"])) ? $GET["url"] : ""?>';
        if(url && url != '') {
            $("input[name='preview']").trigger("click");
        }
    });
    </script>