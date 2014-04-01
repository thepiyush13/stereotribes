<?php

class IndexController extends AdminController
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionWelcome() {
            $this->render('index');
        }
}