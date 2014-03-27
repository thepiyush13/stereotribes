<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticlesController
 *
 * @author abhishek
 */
class ArticlesController extends AdminController {

    public function actionIndex() {
        $model = new Articles();
        //Setting the page for pagination
        $model->page = (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;
        
        $provider = "";
        $data = (Yii::app()->request->isPostRequest) ? $_POST : $_GET;
        $filters = array();
        $filters = $model->getListingFilters($data);
        $totalPages = $model->getArticleCount($filters, $provider);
        $paginator = new CPagination($totalPages);
        $paginator->pageSize = $model->itemsPerPage;
        $articles = $model->getArticles($filters);
        $this->render('index', array(
            'articles' => $articles,
            'pages' => $paginator,
            'totalCount'    =>  $totalPages,
        ));
    }

}

?>
