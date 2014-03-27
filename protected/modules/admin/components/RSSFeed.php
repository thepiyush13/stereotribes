<?php

class RSSFeed {

    public $rawFeed;
    public $title;
    public $language;
    public $pubDate;
    public $imageTitle;
    public $imageLink;
    public $imageUrl;
    public $articles;
    public $provider;
    public $schedules = array();
    public $prop;
    public $link;
    public $feedId;

    public function __construct($rawFeed) {
        $this->rawFeed = $rawFeed;
    }

    public function setProvider($provider) {
        $this->provider = $provider;
    }

    public function processFeed() {
        $this->categoryModel = new Category();
        $channel = $this->extractChannel();
        $this->extractArticles();
        $this->store();
        //echo $this->preview();
        //return $preview;
    }

    public function extractChannel() {
        $prefix = '/rss/channel/';
        $elements = array('title' => 'title', 'link' => 'link', 'language' => 'language', 'pubDate' => 'pubDate', 'image/title' => 'imageTitle', 'image/link' => 'imageLink', 'image/url' => 'imageUrl');
        foreach ($elements as $ele => $prop) {
            if ($result = XMLNode::getNodeData($prefix . $ele, $this->rawFeed)) {
                $content = $result->item(0)->nodeValue;
                $this->$prop = $content;
            } else {
                $this->$prop = '';
            }
        }
    }

    public function extractArticles() {
        $allItemNodes = XMLNode::getNodeData('/rss/channel/item', $this->rawFeed);
        $cntr = 0;
        $strCatFound = array();
        $strCat = '';
        $prefix = '/rss/channel/item';
        //$elements = array('title' => 'title', 'language' => 'language', 'pubDate' => 'pubDate', 'description' => 'description', 'content:encoded' => 'contentEncoded', 'category' => 'category');
        $elements = array('title' => 'title', 'language' => 'language', 'pubDate' => 'pubDate', 'description' => 'description', 'category' => 'category', 'link' => 'link');
        $this->articles = array();
        //echo "--";
        foreach ($allItemNodes as $anItem) {

            $article = new Articles();
            $article->setProviderId($this->provider->guid);
            $article->setProviderName($this->provider->name);
            foreach ($anItem->childNodes as $chItem) {
                if (in_array($chItem->nodeName, array_keys($elements))) {

                    $prop = $elements[$chItem->nodeName];
                    if ($prop == 'category') {
                        $article->category[] = $chItem->nodeValue;
                        $article->categoryNames[] = $chItem->nodeValue;
                    } else {
                        $article->$prop = strip_tags($chItem->nodeValue);
                    }
                    //echo $chItem->nodeName .' | ';
                }
            }
            $article->category = implode(',', $article->category);
            //add category





            $article->pubDate = date("Y-m-d h:i:s", strtotime($article->pubDate));
            $article->feedId = $this->feedId;
            $this->articles[] = $article;
        }
    }

  

    public function store() {
        //store channel stuff
        //store articles
        foreach ($this->articles as $article) {
            $article->storeDb();
        }
    }

    public function preview() {
        $html = '<div id="container" style="padding:10px;">';
        foreach ($this->articles as $item) {
            //file_put_contents('articles.txt', $item->title . "\n", FILE_APPEND);
            $html .= <<<HTM
            <div class="article-body">
                <h3 class="article-headline">{$item->title}</h3>
                <div class="article-bayline">
                    <a href="{$item->link}">{$item->providerName}</a> - {$item->pubDate}
                </div>
                
                <h2 class="article-summary"><p>{$item->description}</p></h2>
                
               <div class="article-content clrfix">
                    {$item->contentEncoded}
                </div>
            </div>

HTM;
        }
        return $html;
    }

}

