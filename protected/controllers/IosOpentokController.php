<?php

class IosOpentokController extends Controller
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
				'actions'=>array('index','view','push','mypush','AddFriend','CountUser','DelContact'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('DelSessionidUid','GetApikeySessionidToken','JoinBroadcast','DelSessionid','AddFriend'),
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

	public function actionCountUser()
	{
		$sql = "select count(*) as count_user from user";
		$command = Yii::app()->db->createCommand($sql);
		$rs = $command->queryRow();
		print_r($rs);
	}
	public function actionDelContact()
	{
		$sql = "delete from contact";
		$command = Yii::app()->db->createCommand($sql);
		if($command->execute())echo 'ok';else echo 'sorry';
	}
	public function actionAddFriend()
	{
		$sql = "select *  from user";
		$command = Yii::app()->db->createCommand($sql);
		$rs = $command->queryAll();
		$uid_num = count($rs) > 0 ? count($rs) : 0;
		
		$num = 0;
		if($uid_num > 0)
		{
			for($i=0;$i<$uid_num;$i++)
			{
				for($j=0;$j<$uid_num;$j++)
				{
					if($i != $j)
					{
						$sql = "insert into contact(uid_parent,uid_child) values({$rs[$i]['uid']},{$rs[$j]['uid']});";
// 						echo $sql.'<br/>';
						$command = Yii::app()->db->createCommand($sql);
						if($command->execute())$num++;
					}
				}
			}
			
			$sql = "delete from contact where uid_parent = uid_child";
			Yii::app()->db->createCommand($sql)->execute();
			
		}else{
			echo 'uid_num必须是contact表的总记录数;请务必先执行DelContact方法';
		}
		echo 'num=='.$num;
	}
	
	/*
	 * Function   : DelSessionid
	 * Param      : create_uid
	 * Description: When the create_uid want to quit, system will delete all items of this broadcast from db
	 * Return     : 1:success 2:failed 3:this create_uid is not exist 4:create_uid is null
	 * API URL    : /index.php/iosOpentok/DelSessionid
	*/
	public function actionDelSessionid()
	{
		if(isset($_REQUEST['create_uid']) && !empty($_REQUEST['create_uid']))
		{
			$create_uid = $_REQUEST['create_uid'];
			//验证tokbox_session是否有此人的记录，如果有则删除
			$sql = "select id from tokbox_session where create_uid={$create_uid}";
			$checkUserSession = Yii::app()->db->createCommand($sql)->queryRow();
			if(!empty($checkUserSession))
			{
				$sql = "delete from tokbox_session where create_uid={$create_uid}";
				$command = Yii::app()->db->createCommand($sql);
				if($command->execute())
					echo 1;
				else
					echo 2;
			}else{
				echo 3;
			}
		}else {
			echo 4;
		}
	}
	/*
	 * Function   : DelSessionidUid
	 * Param      : create_uid push_uid
	 * Description: When the push_uid want to quit, system will delete the item from db
	 * Return     : 1:success 2:failed 3:this push_uid is not exist 4:create_uid or push_uid is null
	 * API URL    : /index.php/iosOpentok/DelSessionidUid
	 */
	public function actionDelSessionidUid()
	{
		if(isset($_REQUEST['create_uid']) && !empty($_REQUEST['create_uid']) && isset($_REQUEST['push_uid']) && !empty($_REQUEST['push_uid']))
		{
			$create_uid = $_REQUEST['create_uid'];
			$push_uid = $_REQUEST['push_uid'];
			
			$sql = "select id,create_uid from tokbox_session where create_uid={$create_uid} and push_uid={$push_uid}";
			$checkUserSession = Yii::app()->db->createCommand($sql)->queryRow();
			
			if(!empty($checkUserSession))
			{
				$create_uid = $checkUserSession['create_uid'];
				$sql = "delete from tokbox_session where id={$checkUserSession['id']}";
				$command = Yii::app()->db->createCommand($sql);
				if($command->execute())
				{
					/* if(!empty($create_uid))
					{
						$create_userinfo = User::model()->findByPk($create_uid);
						if(!empty($create_userinfo))
						{
							if(!empty($create_userinfo['push_id']))
							{
								$push_userinfo = User::model()->findByPk($push_uid);
								$message = $push_userinfo['first_name'].$push_userinfo['last_name'].'rejected your broadcast';
								$apns = new Apns($create_userinfo['push_id'],$message, $message,1,$push_uid,3);
								$apns->doPush();
							}
						}
					} */
					echo 1;
				}else{
					echo 2;
				}
			}else{
				echo 3;
			}
		}else {
			echo 4;
		}
	}
	/*
	 * Function   : GetApikeySessionidToken
	 * Param      : create_uid role propertye_id
	 * Description: realtor create broadcast
	 * Return     : 1:create broadcast falid
	 *              array($apiKey,(string)$sessionId,$token)
	 * API URL    : /index.php/iosOpentok/GetApikeySessionidToken?create_uid=1&role=3&propertye_id=2
	*/
	public function actionGetApikeySessionidToken()
	{
		
		if(isset($_REQUEST['create_uid']) && !empty($_REQUEST['create_uid']))
		{
			$create_uid = $_REQUEST['create_uid'];
			$propertye_id = $_REQUEST['propertye_id'];
			switch($_REQUEST['role'])
			{
				case 1:$role = 1;break;
				case 2:$role = 2;break;
				case 3:$role = 3;break;
				default:$role = 3;
			}
			
			//验证tokbox_session是否有此人的记录，如果有则删除
			$sql = "select id from tokbox_session where create_uid={$create_uid}";
			$checkUserSession = Yii::app()->db->createCommand($sql)->queryRow();
			if(!empty($checkUserSession))
			{
				$sql = "delete from tokbox_session where create_uid={$create_uid}";
				Yii::app()->db->createCommand($sql)->execute();
			}
			
			//obtain
			$apiKey = OpenTok::getApiKey();
			$rs = OpenTok::getRS();
			$sessionId = $rs[0];
			$token = $rs[1];
			$time = date('Y-m-d H:i:s',time());

			//save to tokbox_session
			$sql = "insert into tokbox_session(sessionid,create_uid,create_token,propertye_id,create_time) values('{$sessionId}',{$create_uid},'{$token}',
			'{$propertye_id}','{$time}')";
			$command = Yii::app()->db->createCommand($sql);
			if($command->execute())
			{
				//goto ios
				$ApikeySessionidToken = array($apiKey,(string)$sessionId,$token);
				echo json_encode($ApikeySessionidToken);exit;
			}else{
				echo 1;exit;//create broadcast falid
			}
		}
		
	}
	/*
	 * Function   : JoinBroadcast
	 * Param      : create_uid push_uid
	 * Description: push_uid join this broadcast
	 * Return     : 1:this broadcast info is not exist
	 *              2:create_uid or push_uid is null
	 *              broadcast info (array)
	 * API URL    : /index.php/iosOpentok/JoinBroadcast?create_uid=2&push_uid=1
	*/
	public function actionJoinBroadcast()
	{
	
		//$nowUserId = Yii::app()->user->id;
		if(isset($_REQUEST['create_uid']) && !empty($_REQUEST['create_uid']) && isset($_REQUEST['push_uid']) && !empty($_REQUEST['push_uid']))
		{
			$create_uid = $_REQUEST['create_uid'];
			$push_uid = $_REQUEST['push_uid'];
			$sql = "select * from tokbox_session where create_uid={$create_uid} and push_uid={$push_uid}";
			$check_1 = Yii::app()->db->createCommand($sql)->queryRow();
			if(!empty($check_1))
			{
				echo json_encode($check_1);exit;
			}else{
				echo 1;exit;
			}
		}else{
			echo 2;exit;
		}
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

}
?>