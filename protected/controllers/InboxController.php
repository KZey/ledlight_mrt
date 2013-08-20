<?php

class InboxController extends Controller
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
				'actions'=>array('create','update','Detail','index','view','Send','Del','Sendjoin','Inviteaccept'),
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
		$model=new Inbox;

		$hidden_to_uid = '';
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Inbox']))
		{
			$model->attributes=$_POST['Inbox'];
			$model->date = date('Y-m-d H:i:s',time());
			$model->from_uid = Yii::app()->user->id;
			
			if(!empty($_POST['hidden_to_uid']))
			{
				$hidden_to_uid = $_POST['hidden_to_uid'];
				
				if(empty($hidden_to_uid))
				{
					Yii::app()->user->setFlash('error',Yii::t('Inbox','select_client'));
					Yii::app()->end();
				}
				$model->setAttribute('to_uid', $hidden_to_uid);
				$model->save();
			}
			Yii::app()->user->setFlash('success',Yii::t('Inbox','Send_message_ok'));
			$this->refresh();
			//$this->redirect(array('create'));
		}

		$this->_view['hidden_to_uid']=$hidden_to_uid;
		$this->_view['model']=$model;
		$this->render('create');
	}
	public function actionSend()
	{
		$model=new Inbox;
		$hidden_to_uid = '';
		$this->performAjaxValidation($model);
		if(isset($_POST['Inbox']))
		{
			$model->attributes=$_POST['Inbox'];
			$model->date = date('y-m-d H:i:s');
			$model->from_uid = Yii::app()->user->id;
			if(!empty($_POST['hidden_to_uid']))
			{
				$hidden_to_uid = $_POST['hidden_to_uid'];
				if(empty($hidden_to_uid))
				{
					Yii::app()->user->setFlash('error',Yii::t('Inbox','select_client'));
					Yii::app()->end();
				}
				$model->setAttribute('to_uid', $hidden_to_uid);
				if($model->save())
				{
					$modelUser=User::model()->findByPk($_POST['hidden_to_uid']);
					if(!empty($modelUser['push_id']))
					{
						$apns = new Apns($modelUser['push_id'], Yii::t('Inbox','send_push_title'),$_POST['content'],2,Yii::app()->user->id,'message.wav');
						$apns->doPush();
					}
				}
			}
			Yii::app()->user->setFlash('success',Yii::t('Inbox','Send_message_ok'));
			$this->refresh();
		}
		$this->_view['hidden_to_uid']=$hidden_to_uid;
		$this->_view['model']=$model;
		$this->render('create');
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

		if(isset($_POST['Inbox']))
		{
			$model->attributes=$_POST['Inbox'];
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
	public function actionDelete($uid)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($uid)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	public function actionDel()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$from_uid = $_POST['uid'];
			$sql = "delete from inbox where (from_uid=".$from_uid." and to_uid=".Yii::app()->user->id.") or (from_uid=".Yii::app()->user->id." and to_uid=".$from_uid.")";
			//echo $sql;exit;
			if(Yii::app()->db->createCommand($sql)->query())echo 1;else echo 0;
		}else{
			//throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
// 		$modelUser=User::model()->findByPk(Yii::app()->user->id);
		/*******Begin:msg list********/
		$dataProvider=null;
		if(!empty(Yii::app()->user->id))
		{
/* $sql="select b.*,user.first_name,user.last_name,user.logo,user.type from 
		(select table_from_uid.num,inbox.* from 
			(select from_uid,count(from_uid) as num from inbox where to_uid=".Yii::app()->user->id." or from_uid=".Yii::app()->user->id." group by from_uid) as table_from_uid 
				left join inbox 
			on table_from_uid.from_uid=inbox.from_uid where inbox.to_uid=".Yii::app()->user->id." or inbox.from_uid=".Yii::app()->user->id." order by inbox.date desc
		) as b 
left join user on b.from_uid=user.uid group by b.from_uid order by b.date desc"; */
		$sql="select a.*,b.first_name as from_first_name,b.last_name as from_last_name,b.logo as from_logo,b.type as from_type,
 c.first_name as to_first_name,c.last_name as to_last_name,c.logo as to_logo,c.type as to_type from 
(select aa.*,count(aa.id) as num from (select * from inbox where to_uid=".Yii::app()->user->id." or from_uid=".Yii::app()->user->id." order by date desc) as aa group by aa.parent_id
) as a 
left join user as b on a.from_uid=b.uid   
left join user as c on a.to_uid=c.uid
				";
// 				echo $sql;
			$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			$count=count($rs_1);
			$dataProvider=new CSqlDataProvider($sql, array(
					//'id'=>'user',
					'totalItemCount'=>$count,
					'pagination'=>array('pageSize'=>10,),
			));
		}
		/*******End:msg list********/
		
		/*******Begin:send msg********/
		$modelInbox=new Inbox;
		$hidden_to_uid = '';
		$this->performAjaxValidation($modelInbox);
		if(isset($_POST['Inbox']))
		{
			$modelInbox->attributes=$_POST['Inbox'];
			$modelInbox->date = date('y-m-d H:i:s');
			$modelInbox->from_uid = Yii::app()->user->id;
			if(!empty($_POST['hidden_to_uid']))
			{
				$hidden_to_uid = $_POST['hidden_to_uid'];
				if(empty($hidden_to_uid))
				{
					Yii::app()->user->setFlash('error',Yii::t('Inbox','select_client'));
					Yii::app()->end();
				}
				$modelInbox->setAttribute('to_uid', $hidden_to_uid);
				
				$sql = "select parent_id from inbox
							where (to_uid=".$hidden_to_uid." and from_uid=".Yii::app()->user->id.")
									or (to_uid=".Yii::app()->user->id." and from_uid=".$hidden_to_uid.") limit 1";
				//echo $sql; exit();
				$parent_id = Yii::app()->db->createCommand($sql)->queryScalar();
				
				if($modelInbox->save())
				{
					$id = Yii::app()->db->getLastInsertID();
					$new_parent_id = empty($parent_id) ? $id : $parent_id;
					$sql = "update inbox set parent_id={$new_parent_id} where id={$id}";
					Yii::app()->db->createCommand($sql)->execute();
					
					$modelUser=User::model()->findByPk($hidden_to_uid);
					if(!empty($modelUser['push_id']))
					{
						$apns = new Apns($modelUser['push_id'], Yii::t('Inbox','send_push_title'),$modelInbox->content,2,Yii::app()->user->id,'message.wav');
						$apns->doPush();
					}
					Yii::app()->user->setFlash('success',Yii::t('Inbox','Send_message_ok'));
					$this->refresh();
				}
			}
		}
		/*******End:send msg********/
	    $userType = Yii::app()->user->type;	
		$this->render('index',array(
				'dataProvider' => $dataProvider,'modelInbox'=>$modelInbox,'hidden_to_uid'=>$hidden_to_uid,
				'userType'     => $userType 
		));
	}
	public function actionDetail()
	{
		if(isset($_GET['uid']) && !empty($_GET['uid'])) $uid=$_GET['uid'];
		if($uid == Yii::app()->user->id)
		{
			Yii::app()->user->setFlash('error',"Please select a correct client.");
			$this->redirect(Yii::app()->user->returnUrl);
			Yii::app()->end();
		}
		$modelUser=User::model()->findByPk(Yii::app()->user->id);
		$dataProvider=null;
		if(!empty(Yii::app()->user->id) && !empty($uid))
		{
			$sql="select b.*,user.first_name,user.last_name,user.logo,user.type from 
				(select * from inbox where (from_uid=".$uid." and to_uid=".Yii::app()->user->id.") 
				or (from_uid=".Yii::app()->user->id." and to_uid=".$uid.") order by date desc) as b left join user  on b.from_uid=user.uid";
			$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			$count=count($rs_1);
			$dataProvider=new CSqlDataProvider($sql, array(
					//'id'=>'user',
					'totalItemCount'=>$count,
					'pagination'=>array(
							'pageSize'=>10,
					),
			));
		
			$model=new Inbox;
			$hidden_to_uid = $uid;
			$this->performAjaxValidation($model);
			if(isset($_POST['Inbox']))
			{
				$model->attributes=$_POST['Inbox'];
				$model->date = date('y-m-d H:i:s');
				$model->from_uid = Yii::app()->user->id;
				if(!empty($_POST['hidden_to_uid']))
				{
					$hidden_to_uid = $_POST['hidden_to_uid'];
					$model->setAttribute('to_uid', $hidden_to_uid);
					
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
					
						$modelUser=User::model()->findByPk($_POST['hidden_to_uid']);
						if(!empty($modelUser['push_id']))
						{
							$apns = new Apns($modelUser['push_id'], Yii::t('Inbox','send_push_title'),$model->content,2,Yii::app()->user->id,'message.wav');
							$apns->doPush();
						}
						Yii::app()->user->setFlash('success',Yii::t('Inbox','Send_message_ok'));
						$this->refresh();
					}
				}
			}
			$this->_view['hidden_to_uid']=$hidden_to_uid;
			$this->_view['model']=$model;
		}
		$this->render('detail',array(
				'dataProvider'=>$dataProvider,'model'=>$model,'hidden_to_uid'=>$hidden_to_uid,'modelUser'=>$modelUser,
		));
	}
	
	public function actionSendjoin()
	{
		$from_uid = isset($_GET['uid']) ? intval($_GET['uid']) : '';
		$session_uid = Yii::app()->user->id;
		if($from_uid > 0 && $session_uid > 0)
		{
			$sql="select count(id) from contact where (uid_parent=".$session_uid." and uid_child=".$from_uid.") or (uid_parent=".$from_uid." and uid_child=".$session_uid.")";
			$rs_1=Yii::app()->db->createCommand($sql)->queryScalar();
			if($rs_1 > 0)
			{
				echo "Please don't repeat. You have been made connection with him(her).";exit;
			}else{
				$model = new Inbox;
				$model->date = date('y-m-d H:i:s');
				$model->from_uid = $session_uid;
				$model->to_uid=$from_uid;
				$model->type = 1;
				$accept = '<input type=button id="button_accept" name="button_accept" value="Accept" onclick="invite_accept('.$session_uid.')" />';
				$model->content = '<p style="color:gray">MyRealTour Tips: '.Yii::app()->user->first_name.' would like to connect with you on MyRealTour to help you with your real estate needs.  Would you like to accept their invitation?'.$accept;
				
				$sql = "select parent_id from inbox where (to_uid=".$from_uid." and from_uid=".$session_uid.") or (to_uid=".$session_uid." and from_uid=".$from_uid.") limit 1";
				$parent_id = Yii::app()->db->createCommand($sql)->queryScalar();
				
				if($model->save())
				{
					$id = Yii::app()->db->getLastInsertID();
					$new_parent_id = empty($parent_id) ? $id : $parent_id;
					$sql = "update inbox set parent_id={$new_parent_id} where id={$id}";
					Yii::app()->db->createCommand($sql)->execute();
					
					echo 'Send successful.';
				}else{
					echo 'Send faild.';
				}
			}
		}else{
			echo 'Send faild.';exit;
		}
	}
	
	public function actionInviteaccept()
	{
		$from_uid = isset($_GET['uid']) ? intval($_GET['uid']) : '';
		$session_uid = Yii::app()->user->id;
		if($from_uid > 0 && $session_uid > 0)
		{
			if($from_uid == $session_uid){echo "You can't make connection with yourselves. ";exit;}
			
			$sql="select count(id) from contact where (uid_parent=".$session_uid." and uid_child=".$from_uid.") or (uid_parent=".$from_uid." and uid_child=".$session_uid.")";
			$rs_1=Yii::app()->db->createCommand($sql)->queryScalar();
			if($rs_1 > 0)
			{
				echo "Already connected. No need to accept again.";exit;
			}else{
				$modelContact = new Contact();
				$modelContact->uid_parent = $session_uid;
				$modelContact->uid_child=$from_uid;
				$uid_child_info = User::model()->findByPk($modelContact->uid_child);
				$uid_child_info_arr = $uid_child_info->attributes;
				$modelContact->type = $uid_child_info_arr['type'];
				if($modelContact->save())
				{
					$modelContact_2 = new Contact();
					$modelContact_2->uid_parent = $from_uid;
					$modelContact_2->uid_child=$session_uid;
					$modelContact_2->subscribe=1;
					$modelContact_2->type = Yii::app()->user->type == 2 ? 7 : 1;
					if($modelContact_2->save())
					{
						echo 'Accept successful. You have connected to your realtor.';exit;
					}else{
						$modelContact->delete();
					}
				}
			}
		}else{
			echo 'Accept faild.';exit;
		}
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Inbox('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Inbox']))
			$model->attributes=$_GET['Inbox'];

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
		$model=Inbox::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='inbox-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
