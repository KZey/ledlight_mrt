<?php

class EmailController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
		/**********send_email start*************/
		$model=new Email;
		$hidden_to_uid = '';
		if(isset($_POST['Email']))
		{
			$model->attributes=$_POST['Email'];
			$model->send_date = date('y-m-d H:i:s');
			$model->from_uid = Yii::app()->user->id;
			
			if(!empty($_POST['hidden_to_uid']))
			{
				$hidden_to_uid = $_POST['hidden_to_uid'];
			
				if(empty($hidden_to_uid))
				{
					Yii::app()->user->setFlash('error',"Please select a correct client.");
					Yii::app()->end();
				}
				$model->setAttribute('to_uid', $hidden_to_uid);
				
				//start upload attachments
				$model->attachments = CUploadedFile::getInstance($model, 'attachments');
				if(!empty($model->attachments->name))
				{
					$name = time().strtolower(substr($model->attachments->name, strlen($model->attachments->name) - 4));
					if($model->attachments->saveAs(Yii::app()->basePath.'/../upload/email_attachments/'.$name,true))
					{
						$model->attachments = Yii::getPathOfAlias('webroot').'/upload/email_attachments/'.$name;
// 						echo Yii::getPathOfAlias('webroot');exit;
					}else{
						$model->attachments = "";
					}
				}
				//end
				
				//start send email
				$fromEmail = Yii::app()->user->name;
				$fromName = Yii::app()->user->name;
				$toUserInfo = User::model()->findByPk($hidden_to_uid);;
				$toEmailArrary = array($toUserInfo->email);
				$title = $model->title;
				$content = $model->contents;
				$attachment = $model->attachments;
				$returnCode = $this->sendemail($fromEmail,$fromName,$toEmailArrary,$title,$content,$attachment);
				switch ($returnCode)
				{
					case 1:
						Yii::app()->user->setFlash('success',Yii::t('Email','Send_email_ok'));
						//$this->refresh();
						break;
					case 2:
						Yii::app()->user->setFlash('error',"Please check out all fileds are not blank.");
						$this->redirect(array('/user'));
						break;
					default:
						Yii::app()->user->setFlash('error',"email send failed.".$returnCode);
						$this->redirect(array('/user'));
						//break;
				}
				//end
				
				if($model->save())
				{
					Yii::app()->user->setFlash('success',"Send message successful.");
					$this->redirect(array('/user'));
				}
			}
		}

		$this->_view['hidden_to_uid']=$hidden_to_uid;
		$this->_view['model']=$model;
		$this->render('create');
		/**********send_email End*************/
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

		if(isset($_POST['Email']))
		{
			$model->attributes=$_POST['Email'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('Email');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Email('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Email']))
			$model->attributes=$_GET['Email'];

		$this->render('admin',array(
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
		$model=Email::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='email-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
