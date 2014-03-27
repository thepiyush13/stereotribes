<?php

class FeedsController extends AdminController {

    public function actionIndex() {
        $feedsModel = new Feeds();
        $feeds = $feedsModel->getFeeds();
        $feedCategory = $feedsModel->getFeedsCategoryList();
        $this->render('index', array('feeds' => $feeds, 'categories' => $feedCategory));
    }

    public function actionAddsources() {
        $model = new AddprovidersForm();

        if ($_POST) {
            $model->attributes = $_POST;
            $result = $model->saveProviderInfo();
            if ($result) {
                $this->redirect('/admin/feeds/providers');
            }
        }

        $providerModel = new Providers();
        $providerList = $providerModel->getProvidersList();

        $this->render('addsources', array('model' => $model, 'providers' => $providerList));
    }

    public function actionProviders() {
        $providersModel = new Providers();
        $providers = $providersModel->getProvidersList();
        $this->render('providers', array('providers' => $providers));
    }

    public function actionAddfeedurls() {
        $model = new AddFeedsForm();
        if ($_POST) {
            $model->attributes = $_POST;
            $result = $model->add();
            if ($result) {
                $this->redirect('/admin/feeds/');
            }
        }
        $feedsModel = new Feeds();
        $providersModel = new Providers();
        $categoryModel = new Category();
        $providers = $providersModel->getProvidersList();
        $categoryList = $categoryModel->getCategoryList();
        $this->render('addfeedurls', array('model' => $model, 'providers' => $providers, 'categories' => $categoryList));
    }

    public function actionSchedule() {
        $this->render('schedule');
    }

    public function actionValidate() {
        $this->render('validate', array('POST' => $_POST, 'GET' => $_GET));
    }

    public function actionProfile() {
        $feedsModel = new Feeds();
        $provider = isset($_GET['provider_id']) ? $_GET['provider_id'] : '';
        $feedsList = $feedsModel->getFeeds($provider);
        $this->render('profile', array('feedsList' => $feedsList));
    }

    public function actionExtractfeeds() {
        $path = '/var/www/readfiend/feeds.readfiend.com/';
	$providersModel = new Providers();
        $providers = $providersModel->getProvidersList();
        foreach($providers as $provider) {

                $proc = new ProcessFeedsExtraction($path, $provider['guid']);

                $feedsList = $proc->process();
                $this->render('extract', array('feeds' => $feedsList));

        }
//        $proc = new ProcessFeedsExtraction($path, $provider);
        //$feedsList = $proc->process();
        //$this->render('extract', array('feeds' => $feedsList));
    }

}
