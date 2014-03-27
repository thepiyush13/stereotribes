<?php

Class XMLNode {

    public static function getNodeData($node, $xml) {        //global $feed;
        $xmldoc = new DOMDocument();
        $xmldoc->loadXML($xml);

        $xpath = new Domxpath($xmldoc);
        $result = $xpath->query($node);
        $nodeExist = false;
        //iterate object to check if it is empty
        foreach ($result as $art) {
            $nodeExist = true;
        }
        if ($nodeExist)
            return $result;
        else
            return false;
    }

}

?>
