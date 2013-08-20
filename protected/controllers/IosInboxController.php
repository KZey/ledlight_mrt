<?php
class IosInboxController extends Controller
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
				'actions'=>array('Myinboxlist','Detail','Send','Delone'),
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
	
	/**
	 * all contact msg list with me
	 * Params: page default 1
	 * Note  : must login 
	 */
	public function actionMyinboxlist()
	{
		if(!empty(Yii::app()->user->id))
		{
			$sql="select count(id) from (select * from inbox where type=0 and (to_uid=".Yii::app()->user->id." or from_uid=".Yii::app()->user->id.") order by date desc) as aa group by aa.parent_id";
			$rs_num=Yii::app()->db->createCommand($sql)->queryScalar();
			$rs_1='';
			if($rs_num > 0)
			{
				$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
				$Page_size=10;
				$page_count = ceil($rs_num/$Page_size);
		
				$offset=$Page_size*($page-1);
				$sql="select a.*,b.first_name as from_first_name,b.last_name as from_last_name,b.logo as from_logo,b.type as from_type,
 c.first_name as to_first_name,c.last_name as to_last_name,c.logo as to_logo,c.type as to_type from
(select aa.*,count(aa.id) as num from (select * from inbox where type=0 and (to_uid=".Yii::app()->user->id." or from_uid=".Yii::app()->user->id.") order by date desc) as aa group by aa.parent_id
) as a
left join user as b on a.from_uid=b.uid
left join user as c on a.to_uid=c.uid limit $offset,$Page_size
				";
				$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			}
			echo empty($rs_1) ? '' : json_encode($rs_1);
		}
	}
	/*
	 * one contact list
 	 * Params: uid: the list about me and one uid
	 * Note  : must login 
	 */
	public function actionDetail()
	{
		if(isset($_GET['uid']) && !empty($_GET['uid'])) $uid=$_GET['uid'];
		if(!empty(Yii::app()->user->id) && !empty($uid))
		{
			$sql="select count(id) from inbox where (from_uid=".$uid." and to_uid=".Yii::app()->user->id.")
				or (from_uid=".Yii::app()->user->id." and to_uid=".$uid.")";
			$rs_num=Yii::app()->db->createCommand($sql)->queryScalar();
			$rs_1='';
			if($rs_num > 0)
			{
				$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
				$Page_size=10;
				$page_count = ceil($rs_num/$Page_size);
				$offset=$Page_size*($page-1);
				$sql="select b.*,b.type as inbox_type,user.first_name,user.last_name,user.logo,user.type from
				(select * from inbox where (from_uid=".$uid." and to_uid=".Yii::app()->user->id.")
				or (from_uid=".Yii::app()->user->id." and to_uid=".$uid.") order by date desc) as b left join user  on b.from_uid=user.uid limit $offset,$Page_size";
				$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			}
			echo empty($rs_1) ? '' : json_encode($rs_1);
		}
	}
	/*
	 * send msg
	 * Params: to_uid
	 *         content
	 * Return: 'returnCode'=>1 : success
	 *         'returnCode'=>2 : uid or to_uid or content is null 
	 *         'returnCode'=>3 : send faild
	 * Note  : must login
	 */
	public function actionSend()
	{
		if(!empty(Yii::app()->user->id) && !empty($_POST['to_uid']) && !empty($_POST['content']))
		{
			$model=new Inbox;
			$model->content=$_POST['content'];
			$model->date = date('y-m-d H:i:s');
			$model->to_uid = $_POST['to_uid'];
			$model->from_uid = Yii::app()->user->id;

			$hidden_to_uid = $_POST['to_uid'];
			$sql = "select parent_id from inbox
								where (to_uid=".$hidden_to_uid." and from_uid=".Yii::app()->user->id.")
										or (to_uid=".Yii::app()->user->id." and from_uid=".$hidden_to_uid.") limit 1";
			$parent_id = Yii::app()->db->createCommand($sql)->queryScalar();
				
			if($model->save())
			{
				$id = Yii::app()->db->getLastInsertID();
				$new_parent_id = empty($parent_id) ? $id : $parent_id;
				$sql = "update inbox set parent_id={$new_parent_id} where id={$id}";
				Yii::app()->db->createCommand($sql)->execute();
				
				$modelUser=User::model()->findByPk($_POST['to_uid']);
				if(!empty($modelUser['push_id']))
				{
					$apns = new Apns($modelUser['push_id'], 'The message from MRT',$_POST['content'],2,Yii::app()->user->id,'message.wav');
					$apns->doPush();
				}
				echo json_encode(array('returnCode'=>1));
			}else{
				echo json_encode(array('returnCode'=>3));//send faild
			}
		}else{
			echo json_encode(array('returnCode'=>2));//uid or to_uid or content is null  
		}
	}
	/*
	 * del one contact list
	 * Params: to_uid: the list about me and one uid
     * Return: success: 'returnCode'=>1 
     *         error  : 'returnCode'=>0
	 * Note  : must login
	 */
	public function actionDelone()
	{
		if(!empty(Yii::app()->user->id) && !empty($_POST['to_uid']))
		{
			$from_uid = $_POST['to_uid'];
			$sql = "delete from inbox where (from_uid=".$from_uid." and to_uid=".Yii::app()->user->id.") or (from_uid=".Yii::app()->user->id." and to_uid=".$from_uid.")";
			if(Yii::app()->db->createCommand($sql)->query())
				echo json_encode(array('returnCode'=>1));
			else 
				echo json_encode(array('returnCode'=>0));
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