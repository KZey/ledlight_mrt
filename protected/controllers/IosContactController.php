<?php

class IosContactController extends Controller
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
				'actions'=>array('index','view','push','mypush','Getmybroadcastlist'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','update','push','mypush','Getmybroadcastlist'),
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
		$model=new Contact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
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

		if(isset($_POST['Contact']))
		{
			$model->attributes=$_POST['Contact'];
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
		if(isset($_REQUEST['uid']) && !empty($_REQUEST['uid']))
		{
			$sql = "select * from user where uid in 
					(select c.uid_child from contact c where c.uid_parent=".$_REQUEST['uid'].")";
			
			$command = Yii::app()->db->createCommand($sql);
			$userContact_1 = $command->queryAll();
			
			//echo '<pre>';var_dump($userContact_1);echo '</pre>';
			$userContact_2 = json_encode($userContact_1);
			echo $userContact_2;
		}
	}
	/*
	 * Function   : getmybroadcastlist
	 * Param      : $uid
	 * Description: push_uid join this broadcast
	 * Return     : 
	 * 				echo 1;exit;//uid is null
	 * 				echo 2;exit;//no result
	 * API URL    : /index.php/iosContact/getmybroadcastlist?uid=1
	*/
	public function actionGetmybroadcastlist()
	{
		if(isset($_REQUEST['uid']) && !empty($_REQUEST['uid']))
		{
			$sql = "select * from tokbox_session where push_uid = ".$_REQUEST['uid'];;
			$userContact_1 = Yii::app()->db->createCommand($sql)->queryAll();
			if(!empty($userContact_1))
				echo json_encode($userContact_1);
			else 
				echo 2;exit;
		}else{
			echo 1;exit;
		}
	}
	/*
	 * Function   : Push
	 * Param      : $uid
	 * Description: push_uid join this broadcast
	 * Return     : 
	 * 				echo 1;exit;//您没有登录，登录后才能创建直播
	 * 				echo 2;exit;//您还没有创建直播，请先创建
	 * 				echo 3;//所有人，发送成功
	 * 				echo 4;//您没有选择要发送邀请的人
	 * 				echo 5;//发送 push失败(push发送到用户手机了，但没保存到数据库，所以即使收到PUSH也JOIN不进去)
	 *         		echo 6;///邀请失败：被邀请人的push_token获取失败
	 * API URL    : /index.php/iosContact/push?uid=["1","2"]
	*/
	public function actionPush()
	{
		//检测当前登录用户是否已经创建直播
		$nowUserId = Yii::app()->user->id;
		
		//echo 'nowUserId==='.$nowUserId;
		//echo 333333333;
		if(empty($nowUserId))
		{
			echo 1;exit;//您没有登录
		}
		//echo 4444;
		$sql = "select * from tokbox_session where create_uid={$nowUserId}";
		//echo '5555==='.$sql;
		$check_1 = Yii::app()->db->createCommand($sql)->queryRow();
		if(empty($check_1))
		{
			echo 2;exit;//您还没有创建直播，请先创建
		}
		//echo 66666;
		$sessionId = $check_1['sessionid'];
		$message = "Hi, your friend ".Yii::app()->user->first_name." ".Yii::app()->user->last_name." has invite you to join  a MRT live  broadcast.";
		//$_REQUEST['push_uid']，此值为tokbox_session中的push_uid，json格式：["2","5"]或{"2","5","8"}
		if(isset($_REQUEST['push_uid']) && !empty($_REQUEST['push_uid']))
		{
			$push_uid = $_REQUEST['push_uid'];
			$uidArray = json_decode($push_uid);
			$uidStr = implode(',', $uidArray);
			$sql = "select uid,email,first_name,last_name,push_id from user where uid in ({$uidStr})";
			$pushToUsers = Yii::app()->db->createCommand($sql)->queryAll();

			
			//$token = $check_1['token'];
			$push_token = OpenTok::getToken($sessionId,1);
		
			if(empty($push_token))
			{
				echo 6;
				exit;//邀请失败：被邀请人的push_token获取失败
			}
			//echo '777777'.$message;
			$pushuser_arrayemail = array();
			if(!empty($pushToUsers))
			{
				for($i=0;$i<count($pushToUsers);$i++)
				{
					if(!empty($pushToUsers[$i]['uid']))
					{
						$time = date('Y-m-d H:i:s',time());
						$sql = "insert into tokbox_session (sessionid,create_uid,create_token,push_uid,push_token,push_status,propertye_id,parent_id,create_time) 
							values('$sessionId','{$check_1['create_uid']}','{$check_1['create_token']}','{$pushToUsers[$i]['uid']}','{$push_token}',
							1,'{$check_1['propertye_id']}','{$check_1['id']}','{$time}')";
						$rs_insert = Yii::app()->db->createCommand($sql)->query();
						if(!$rs_insert)
						{
							echo 5;//发送 push失败(可能push发送到用户手机了，但没保存到数据库，所以即使收到PUSH也JOIN不进去)
						}else {
							$LastInsertID = Yii::app()->db->getLastInsertID();
							$pushuser_arrayemail[$i] = $pushToUsers[$i]['email'];
							$apns = new Apns($pushToUsers[$i]['push_id'],$message, $message,1,$nowUserId,$check_1['propertye_id']);
							$apns->doPush();
							//echo 999999;exit;
							
							$url = Yii::app()->request->hostInfo.'/user/broadcast?sid='.$LastInsertID;
							//start send email
							$title = 'Hi, you have been invited to join a broadcast of MRT.';
							$content = 'Hi, you have been invited to join a broadcast of MRT.<br/>
									Please click the follow link to join this broadcast.<br/><br/>'.$url.'<br/><br/>MRT Team';
							$returnCode = $this->sendemail(Yii::app()->user->name,Yii::app()->user->name,$pushuser_arrayemail,$title,$content,'');
							echo 3;//所有人，发送成功
						}
					}
				}
			}
		}else{
			echo 4;//您没有选择要发送邀请的人
		}
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contact('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contact']))
			$model->attributes=$_GET['Contact'];

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
		$model=Contact::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
