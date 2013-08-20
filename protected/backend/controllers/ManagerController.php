<?php

class ManagerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','Changepwd'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionChangepwd()
	{
		$id = Yii::app()->user->id;
		$model=$this->loadModel($id);
		if(isset($_POST['Manager']))
		{
			$model->attributes=$_POST['Manager'];
			if(empty($model->pwd))
			{
				Yii::app()->user->setFlash('Password',Yii::t('User','pwd_blank'));
				$this->redirect(array('Changepwd'));
				Yii::app()->end();
			}
			$model->pwd = md5($model->pwd);
			$model->repwd = md5($model->repwd);
			if($model->save())
			{
				Yii::app()->user->setFlash('success',Yii::t('User','change_pwd_ok'));
				$this->redirect(array('Changepwd'));
				Yii::app()->end();
			}
		}
		$this->render('changepwd',array(
				'model'=>$model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Manager::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='manager-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
