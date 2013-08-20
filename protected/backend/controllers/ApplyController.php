<?php

class ApplyController extends Controller
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
				'actions'=>array('admin','delete','Verify'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Apply;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Apply']))
		{
			$model->attributes=$_POST['Apply'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Apply']))
		{
			$model->attributes=$_POST['Apply'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionVerify()
	{
		if (Yii::app()->request->isPostRequest)
		{
			$status = $_POST['status'];
			$selectdel = $_POST['selectdel'];
			
			$criteria= new CDbCriteria;
			$criteria->addInCondition('id', $selectdel);
			
			Apply::model()->updateAll(array('status'=>$status),$criteria);
			if($status == 2)
			{
				$rs = Apply::model()->findAll($criteria);
				if(!empty($rs))
				{
					for($i=0;$i<count($rs);$i++)
					{
						$row = $rs[$i]->attributes;
						$modelUser=new User;
						$modelUser->first_name = $row['first_name'];
						$modelUser->last_name = $row['last_name'];
						$modelUser->email = $row['email'];
						$modelUser->state = $row['state'];
						$modelUser->state_license = $row['state_license'];
						$modelUser->logo = 'default_logo.png';
						$modelUser->type = 2;
						
						$pwd_old = date(time());
						$modelUser->pwd = md5($pwd_old);
						$modelUser->repwd = md5($pwd_old);
						
						$forgetpwd = md5(time());
						$modelUser->pwd = $forgetpwd;
						$modelUser->forgetpwd = $forgetpwd;
						$modelUser->register_status = 1;
						if($modelUser->save())
						{
							/*****Begin:send email*********/
							$url = Yii::app()->request->hostInfo.'/login/setpwd?fid='.$forgetpwd;
							//start send email
							$title = 'Hi, '.$modelUser->first_name.' '.$modelUser->last_name.', you have been approved on MyRealTour website.';
							$content = $title.'<br/> You can click the below URL to reset your password and then login with it.
								<br/><br/>'.$url.'<br/><br/>'.Yii::t('User','invite_email_content_4');
							$returnCode = $this->sendemail(Yii::app()->user->name,Yii::app()->user->name,array($modelUser->email),$title,$content,'');
							/*****End:send email*********/
						}
					}
				}
			}
			
			if(isset(Yii::app()->request->isAjaxRequest)) {
				echo 1;
			} else{
				echo 2;
			}
		}
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Apply');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Apply('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Apply']))
			$model->attributes=$_GET['Apply'];

		$dataProvider=new CActiveDataProvider('Apply',array(
				'criteria'=>array(
						'condition'=>'  status < 2',
				),
				'sort'=>array(
						'defaultOrder'=>'add_date DESC',
				),
		));
		
		$this->render('admin',array(
			'model'=>$model,'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Apply::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='apply-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
