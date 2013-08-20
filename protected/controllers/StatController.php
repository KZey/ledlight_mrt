<?php

class StatController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Rindex','update','Changepwd','Rupdate','rotherview','Broadcast','Logout','Editproperty','Rcontact','Cindex','Rlist','Cotherview','Cupdate','Broadcastlist','Createproperty','Upload'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{			
		$model=$this->loadModel(Yii::app()->user->id);
		$url = '';
		switch ($model->type)
		{
			case 1:$url = '/stat/cindex';break;
			case 2:$url = '/stat/rindex';break;
			default:$url = '/stat/rindex';
				
		}
		Yii::app()->request->redirect(Yii::app()->baseurl.$url);
	}
	/**
	 * Lists all models.
	 */
	public function actionRindex()
	{
		$model=$this->loadModel(Yii::app()->user->id);
	
		$f= '';
		if(isset($_GET['f']) && !empty($_GET['f'])) $f=$_GET['f'];
		$this->render('r_index',array(
				'model'=>$model,'f'=>$f				
		));
	}
	



	public function actionCindex()
	{
		$uid = Yii::app()->user->id;
		if(isset($_GET['uid']) && !empty($_GET['uid'])) $uid=$_GET['uid'];
		$model=$this->loadModel($uid);
		$message = 'You cannot access this resource.';
		$this->render('c_index',array(
				'message'=>$message
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
