<?php
class UserController extends Controller
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
	public function actionView($uid)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($uid),
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','uid'=>$model->uid));
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
			$criteria->addInCondition('uid', $selectdel);

			if($status == 2)
			 User::model()->updateAll(array('status'=>$status, 'pwd'=>md5('123456')),$criteria);
			else
			 User::model()->updateAll(array('status'=>$status, 'pwd'=>md5('1234')),$criteria);


			 echo 1;
			 exit();

			$rs = User::model()->findAll($criteria);
			if(!empty($rs))
			{
				for($i=0;$i<count($rs);$i++)
				{
					$row = $rs[$i]->attributes;
					$modelUser=new User;
					$modelUser->status = $status;
					if($modelUser->save())
					{
						if(isset(Yii::app()->request->isAjaxRequest)) {
							echo 1;
						} else{
							echo 2;
						}                          
					}
					else 
						 echo "3";
				}
			} else
			{
				echo 0;
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
	$dataProvider=new CActiveDataProvider('User');
	$this->render('index',array(
				'dataProvider'=>$dataProvider,
				));
}

/**
 * Manages all models.
 */
public function actionAdmin()
{
	$model=new User('search');
	$model->unsetAttributes();  // clear any default values
	if(isset($_GET['Apply']))
		$model->attributes=$_GET['User'];

	$dataProvider=new CActiveDataProvider('User',array(
				'criteria'=>array(
					'condition'=>'  status < 4',
					),
				'sort'=>array(
					'defaultOrder'=>'last_time DESC',
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
	$model=User::model()->findByPk($id);
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
