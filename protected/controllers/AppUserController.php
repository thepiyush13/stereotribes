<?php

/**
 * @author Kalpit Pandit <kalpit@inkoniq.com>
 */

class AppUserController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function actionCreate()
	{
		$model=new AppUser('create');
            
                if(!Yii::app()->user->isGuest)
                    $this->redirect('/');

		if(Yii::app()->request->isPostRequest)
		{
                    
                        if($model->isFbUser($_POST['email'])){
                            $this->redirect(array('AppUser/fbauth','email'=>$_POST['email']));
                        }
                        
			$model->attributes=$_POST;
			if($model->save())
				$this->redirect('/login');
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionProfile()
	{
            if(Yii::app()->user->isGuest)
                    $this->redirect('/login');
            
                $id = Yii::app()->user->id;
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(Yii::app()->request->isPostRequest)
		{
                        $model->profile_pic=CUploadedFile::getInstanceByName('profile_pic');
			$model->attributes=$_POST;
			if($model->save(false))
                        {   
                            if(!empty($model->profile_pic))
                                $model->profile_pic->saveAs(Yii::app()->basePath.'/../uploads/profile/'.$model->profile_pic);
                            Yii::app()->user->setFlash('success', "Profile updated successfully.");
                            $this->redirect(array('profile','id'=>$model->id));
		}
		}

		$this->render('profile',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AppUser');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AppUser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AppUser']))
			$model->attributes=$_GET['AppUser'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AppUser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AppUser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AppUser $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='app-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionFbauth() {
            
            $model = new AppUser();

            $this->render('fbauth',array(
			'model'=>$model,
		));
    }
}
