<?php

class Articles extends CActiveRecord {

    public $id;
    public $title;
    public $link;
    public $pubDate;
    public $description;
    public $contentEncoded;
    public $category = array();
    public $providerId;
    public $providerName;
    public $feedId;
    public $itemsPerPage = 10;
    public $page = 1;
    public $categoryNames = array();

    const UNCATEGORIZRED = -1;
    public function tableName() {
        return 'articles';
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function storeDb() {
        if ($this->articleAlreadyExists()) {
            $this->setIsNewRecord(false); //hack to tell active record that it is new article
            $this->update();
        } else {
            $this->insert();
        }
        //cleanup categories mapping
        $this->cleanUpCategoriesMapping();
        //store category
        $categoryModel = new Category();
        $catFound = false;
        foreach ($this->categoryNames as $categoryName) {
            //get categories by name
            $categories = $categoryModel->getCategoriesByName($categoryName);
            if($categories) {
                $catFound = true;
                if(is_array($categories)) {
                    foreach($categories as $category) {
                        //map article to category
                        $categoryModel->mapArticleCategory($this->id, $category->id);
                    }
                }
                
            } else { //new category
                $newCategoryId = $categoryModel->addNewCategory($categoryName, 'C', self::UNCATEGORIZRED);
                $categoryModel->mapArticleCategory($this->id, $newCategoryId);
            }
            
            
//            // is readfiend category
//            if ($categoryId = $categoryModel->getCateroryIdByName($categoryName)) {
//                //add to article_category
//                $categoryModel->mapArticleCategory($this->id, $categoryId);
//                $catFound = true;
//            } else if ($categoryId = $categoryModel->getCateroryIdUsingAlias($categoryName)) {
//                $categoryModel->mapArticleCategory($this->id, $categoryId);
//                $catFound = true;
//            } else {
//                //article does not exist in category or alias category
//                //check if it exist in external category
//                if ($externalCategoryId = $categoryModel->getExternalCateroryIdByName($categoryName)) {
//                    //add to article_external_category
//                } else {
//                    //add new external article and get its id
//                    $externalCategoryId = $categoryModel->addNewExternalCategory($categoryName);
//                }
//                $categoryModel->mapExteralArticleCategory($this->id, $externalCategoryId);
//            }
        }
//        if ($catFound === false) {
//            $categoryModel->mapArticleCategory($this->id, -1);
//        }
    }
    
    public function cleanUpCategoriesMapping() {
        $command = Yii::app()->db->createCommand();
        $command->delete('article_category', 'article_id = :ARTICLEID', array(':ARTICLEID'=>$this->id));
        //$command->delete('article_category_external', 'article_id = :ARTICLEID', array(':ARTICLEID'=>$this->id));
    }

    public function setProviderId($providerId = "") {
        $this->providerId = $providerId;
    }

    public function setProviderName($name) {
        $this->providerName = $name;
    }

    public function setCategory($categories = array()) {
        $this->category = $categories;
    }

    public function articleAlreadyExists() {
        if (!$this->id) {
            $sql = "Select id from articles where link = :LINK";
            $result = Yii::app()->db
                    ->createCommand($sql)
                    ->bindParam(':LINK', $this->link)
                    ->queryRow();

            if ($result['id']) {
                $this->id = $result['id']; //set article id
                return true;
            } else {
                return false;
            }
        }
    }

    public function getAllArticles($criteria = array()) {
        return $this->findAll($criteria);
    }

    public function getaArticles($filters = array(), $onlyCount = false) {
        $join = "";
        $where = "";
        $offset = $this->getOffset();
        $limit = "";
        $columns = array('articles.*');
        $bindValues = array();


        if ($filters) {
            foreach ($filters as $field => $value) {
                switch ($field) {
                    case 'providerId':
                        $condition = ($where == "") ? "" : 'and';
                        $where .= "{$condition} providerId = :PROVIDERID ";
                        $bindValues[':PROVIDERID'] = $value;
                        break;
                    case 'feedId' :
                        $condition = ($where == "") ? "" : 'and';
                        $where .= "{$condition} feedId = :FEEDID ";
                        $bindValues[':FEEDID'] = $value;

                    default:
                        break;
                }
            }
        }

        $condition = ($where == "") ? 1 : $where;
        $where = "{$condition}";

        if ($onlyCount) {
            $columns = array('count(articles.id) as cnt');
        } else {
            $limit = " LIMIT {$offset},$this->itemsPerPage+10)";
        }

        $sql = "SELECT {{COLUMNS}} FROM articles {{JOIN}} WHERE {{WHERE}} ORDER BY articles.pubDate DESC {{LIMIT}}";

        $columns = implode($columns, ',');
        $sql = str_replace(array('{{JOIN}}', '{{WHERE}}', '{{COLUMNS}}', '{{LIMIT}}'), array($join, $where, $columns, $limit), $sql);

        $result = Yii::app()->db
                ->createCommand($sql)
                ->bindValues($bindValues)
                ->queryAll();

        if (!$result) {
            
        }

        return $result;
    }

    public function getArticles($filters = array(), $onlyCount = false) {
        //$q ='select p.name, p.guid, a.title, a.providerId  from category c left join article_category ac on (ac.category_id = c.id) left join articles a on (a.id = ac.article_id) left join providers p on (p.guid = a.providerId) where c.name = "Mobile"';
        $sql = "SELECT {{COLUMNS}} 
            FROM from category c left join article_category ac on (ac.category_id = c.id) left join articles a on (a.id = ac.article_id) left join providers p on (p.guid = a.providerId) WHERE 
            {{WHERE}} ORDER BY a.pubDate DESC {{LIMIT}}";

        $join = "";
        $where = "";
        $groupBy = "";
        $offset = $this->getOffset();
        $limit = "";
        $categoryFilter = "";
        $categoryCond = $providerCond ="";
        $columns = array('a.*', 'c.name as category_name, p.name as provider_name');
        $bindValues = array();
        $hasProviderId = false;
        $q = '';

        if ($onlyCount) {
            //$columns = array('count(*) as cnt');
            //$groupBy = ' group by a.id';
        } else {
            $limit = " LIMIT {$offset},10"; //.$this->itemsPerPage+10;
        }

        if ($filters) {


            foreach ($filters as $field => $value) {
                switch ($field) {
                    case 'providerId':
                        //$condition = ($where == "") ? "" : 'and';
                        //$where .= "{$condition} p.guid = :PROVIDERID ";
                        $bindValues[':PROVIDERID'] = $value;
                        $providerCond = ' where tp.guid = :PROVIDERID ';
                        $hasProviderId = true; 
                        break;
                    case 'feedId' :
                        $condition = ($where == "") ? "" : 'and';
                        $where .= "{$condition} feedId = :FEEDID ";
                        $bindValues[':FEEDID'] = $value;
                    case 'category' :
                        //$condition = ($where == "") ? "" : 'and';
                        //$where .= "{$condition} c.cat_id = :CATEGORYID ";
                        $bindValues[':CATEGORY'] = $value;
                        $categoryCond = ' where tc.cat_id = :CATEGORY ';

                    default:
                        break;
                }
            }
        }

        $q = 'join  (select tac.article_id from category tc left join article_category tac on (tac.category_id = tc.id) ' . $categoryCond . ' ' . $limit . ') as t on (t.article_id = a.id)';
        $condition = ($where == "") ? 1 : $where;
        $where = "{$condition}";
        
        if($hasProviderId) {
            $q='join  (select ta.id from providers tp left join articles ta on (ta.providerId = tp.guid) ' . $providerCond . ' ' . $limit . ') as t on (t.id = a.id)';
        }

        //$q="";
        //$sql = "SELECT {{COLUMNS}} FROM articles {{JOIN}} WHERE {{WHERE}} ORDER BY articles.pubDate DESC {{LIMIT}}";

        $sql = "SELECT {{COLUMNS}} 
                    FROM  articles a " . $q . " left join article_category ac on (a.id = ac.article_id) left join category c on (ac.category_id = c.id) left join providers p on (p.guid = a.providerId) WHERE 
                    {{WHERE}} {{COUNTGROUPBY}} ORDER BY a.pubDate DESC {{LIMIT}} ";
        $columns = implode($columns, ',');
        $sql = str_replace(array('{{JOIN}}', '{{WHERE}}', '{{COLUMNS}}', '{{LIMIT}}', '{{CATEGORYFILTER}}', '{{COUNTGROUPBY}}'), array($join, $where, $columns, '', $categoryFilter, $groupBy), $sql);

        $result = Yii::app()->db
                ->createCommand($sql)
                ->bindValues($bindValues)
                ->queryAll();

        if (!$result) {
            
        }

        return $result;
    }

    public function getArticleCount($filters = array()) {
        $result = $this->getArticles($filters, TRUE);
        if ($result) {
            $_articles = array();
            foreach ($result as $article) {
                if (array_key_exists($article['id'], $_articles)) {
                    
                } else {
                    $_articles[$article['id']] = $article;
                }
            }
            return count($_articles);
            //return $result[0]['cnt'];
        }
        return 0;
    }

    public function getOffset() {
        if ($this->page == 1) {
            return 0;
        }
        $page = ($this->page - 1 ) * $this->itemsPerPage;

        return $page;
    }

    public function getListingFilters($data) {
        $listingFilters = array('providerId', 'feedId', 'category');
        $filters = array();
        foreach ($listingFilters as $slug) {
            if (isset($data[$slug]) && $data[$slug]) {
                $filters[$slug] = $data[$slug];
            }
        }
        return $filters;
    }

}

