<?php

class ProfileController extends Controller
{
	public function actionBacked()
	{
		$this->render('backed');
	}

	public function actionComments()
	{
		$this->render('comments');
	}

	public function actionCreated()
	{
		$this->render('created');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLoved()
	{
		$this->render('loved');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}