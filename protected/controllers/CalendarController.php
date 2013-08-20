<?php

class CalendarController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $mydata = array();
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
			/* array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			), */
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','index','create','update','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$sql = "select * from calendar where id={$id} and uid=".Yii::app()->user->id;
		$command = Yii::app()->db->createCommand($sql);
		$rs = $command->queryRow();
		if(!empty($rs))
		{
			$this->render('view',array(
				'model'=>$this->loadModel($id),
			));
		}else{
			Yii::app()->request->redirect(Yii::app()->baseurl.'/user');
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=User::model()->findByPk(Yii::app()->user->id);
		$modelCalendar=new Calendar;
		$hidden_invite_uid = '';
		
		$year = isset($_GET['year']) ? $_GET['year'] : date('Y',time());
		$month = isset($_GET['month']) ? $_GET['month'] : date('m',time());
		$day = isset($_GET['day']) ? $_GET['day'] : date('d',time());
		$hour_1 =  date('H',time() + 3600);
		$modelCalendar->start_time =$year.'-'.$month.'-'.$day.' '.date('H',time()).':'.date('i',time()).':'.date('s',time());
		$modelCalendar->end_time =$year.'-'.$month.'-'.$day.' '.$hour_1.':'.date('i',time()).':'.date('s',time());
		
		if(isset($_POST['Calendar']))
		{
			$modelCalendar->attributes=$_POST['Calendar'];
			$modelCalendar->create_time = date('y-m-d H:i:s');
			$modelCalendar->uid = Yii::app()->user->id;
			
			$modelCalendar->start_time =$_POST['Calendar_start_date'].' '.$_POST['Calendar_start_time'];
			$modelCalendar->end_time =$_POST['Calendar_end_date'].' '.$_POST['Calendar_end_time'];
			if(!empty($_POST['hidden_invite_uid']))
			{
				$hidden_invite_uid = $_POST['hidden_invite_uid'];
				$modelCalendar->invite_uid=substr($hidden_invite_uid, 0,strlen($hidden_invite_uid)-1);
			}
			if($modelCalendar->save())
			{
				if(!empty($modelCalendar->invite_uid))
				{
					$modelInbox=new Inbox;
					$name = Yii::app()->user->first_name.' '.Yii::app()->user->last_name;
					$content = $name.' is inviting you to join this event:'.$modelCalendar->content;
					$modelInbox->setAttribute('to_uid', $modelCalendar->invite_uid);
					$modelInbox->setAttribute('content', $content);
					$modelInbox->date = $modelCalendar->create_time;
					$modelInbox->from_uid = Yii::app()->user->id;
					if($modelInbox->save())
					{
						$modelUser=User::model()->findByPk($modelCalendar->invite_uid);
						if(!empty($modelUser['push_id']))
						{
							$apns = new Apns($modelUser['push_id'], Yii::t('Inbox','send_push_title'),$content,2,Yii::app()->user->id,'message.wav');
							$apns->doPush();
						}
					}
				}
				$this->redirect(array('/user/rcalendar'));
			}
		}

		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.core.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.widget.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.position.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/datepicker/WdatePicker.js');
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/autocomplete/jquery.ui.autocomplete.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.autocomplete.js');
		
		$this->render('create',array('model'=>$model,'hidden_invite_uid'=>$hidden_invite_uid,'modelCalendar'=>$modelCalendar));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=User::model()->findByPk(Yii::app()->user->id);
// 		$sql = "select * from calendar where id={$id} and uid=".Yii::app()->user->id;
// 		$rs = Calendar::model()->findAllBySql($sql);

		$modelCalendar=Calendar::model()->findByPk($id);

		$hidden_invite_uid = $modelCalendar->invite_uid;
		if(!empty($modelCalendar->invite_uid))
		{
			$invite_user_uid_info = Calendar::model()->getInvite_user_name($modelCalendar->invite_uid);
			//CVarDumper::dump($invite_user_uid_info,10,true);
			$invite_username = '';
			$num = count($invite_user_uid_info);
			if($num > 0)
			{
				for($i=0;$i<$num;$i++)
				{
					$invite_username .= $invite_user_uid_info[$i]['first_name'].'-'.$invite_user_uid_info[$i]['last_name'].'['.$invite_user_uid_info[$i]['email'].']'.',';
				}
				$modelCalendar->invite_uid = $invite_username;
			}
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Calendar']))
		{
			$modelCalendar->attributes=$_POST['Calendar'];
			$modelCalendar->create_time = date('y-m-d H:i:s');
			$modelCalendar->uid = Yii::app()->user->id;
			$modelCalendar->start_time =$_POST['Calendar_start_date'].' '.$_POST['Calendar_start_time'];
			$modelCalendar->end_time =$_POST['Calendar_end_date'].' '.$_POST['Calendar_end_time'];
			if(!empty($_POST['hidden_invite_uid']))
			{
				$hidden_invite_uid = $_POST['hidden_invite_uid'];
				$len = strlen($hidden_invite_uid);
				$modelCalendar->invite_uid=$hidden_invite_uid;
				if(',' == substr($hidden_invite_uid, $len-1,$len))
					$modelCalendar->invite_uid=substr($hidden_invite_uid, 0,$len-1);
			}
			
			if($modelCalendar->save())
				$this->redirect(array('/user/rcalendar'));
		}
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.core.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.widget.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.position.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/datepicker/WdatePicker.js');
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/autocomplete/jquery.ui.autocomplete.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.autocomplete.js');
		
		$this->render('update',array('model'=>$model,'hidden_invite_uid'=>$hidden_invite_uid,'modelCalendar'=>$modelCalendar));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
// 		if(Yii::app()->request->isPostRequest)
// 		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/user/rcalendar'));
// 		}
// 		else
// 			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Calendar',
				array(
						'criteria' => array(
								'condition'=>'uid= '.Yii::app()->user->id
						)
					)
		);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Calendar('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Calendar']))
			$model->attributes=$_GET['Calendar'];

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
		$model=Calendar::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='calendar-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
