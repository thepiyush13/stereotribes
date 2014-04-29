<?php

class CampaignController extends AdminController {

    public function actionIndex() {
        $m = new Campaign();
        $m->validate();
        $this->render('index');
    }

    public function actionCreate() {
        $m = new Campaign();
        $m->createCampaign(null);
        $this->render('create');
    }

}
