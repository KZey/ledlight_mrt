<?php
Class IosUserController extends Controller
{
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array(),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('GetUserDetail'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array(),
						'users'=>array('admin'),
				), 
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	public function actionGetUserDetail($id)
	{
		if(isset($id) && !empty($id))
		{
			$id = intval($id);
			$model=$this->loadModel($id);
			echo empty($model->attributes) ? '' : json_encode($model->attributes);
		}
	}
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}