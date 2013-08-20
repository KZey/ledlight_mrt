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
				'actions'=>array('Delprofiler', 'Delprofile1','Delprofile', 'regirest','Search','rotherview','Unsubscrible'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Rindex','update','Changepwd','Rupdate','Broadcast','Logout','Editproperty','Rcontact', 'Rclient','Cindex','Rlist','Cotherview','Cupdate','Broadcastlist','Createproperty','Upload','Newsletter','Rgroupemail','Rgroupemailsubmit','Rcalendar','Invite','Rnonlisting','Shareproperty','Ajaxcrop','Uploadavatar','Uploadpropertylogo','Rprospects','Uploadcsv','Closeproperty','Rprospectsedit','Check_array_key','Rprospectsdel','Cexpensedelete','Cnotedelete'),
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
	public function actionRlist()
	{
		$dataProvider=new CActiveDataProvider('User',array(
				'criteria'=>array(
						'condition'=>'type=2',
				),
				
				'pagination'=>array(
						'pageSize'=>20
				),
		));
		$model=$this->loadModel(Yii::app()->user->id);
		$this->render('r_list',array(
				'dataProvider'=>$dataProvider,'model'=>$model,
		));
		
	}
	public function actionUpload()
	{
	
		Yii::import("ext.EAjaxUpload.qqFileUploader");
	
		$folder=Yii::getPathOfAlias('webroot').'/upload/property/';// folder for uploaded files
		$allowedExtensions = array("jpg","jpeg","gif","png");//array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 100 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
	
		if(!empty($result['filename']))
		{
			$image = Yii::app()->image->load('upload/property/'.$result['filename']);
			$new_width = $image->width > 1000 ? 1000 : $image->width;
			$new_height = $image->height > 1000 ? 1000 : $image->height;
			$image->resize($new_width, $new_height);
			$image->save();
		}
		$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		$fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
		$fileName=$result['filename'];//GETTING FILE NAME
		//$img = CUploadedFile::getInstance($model,'image');

		echo $return;// it's array
	}
	/**
	 * open link of email, and accept the broadcast from ios
	 */
	public function actionBroadcast()
	{
		$model=$this->loadModel(Yii::app()->user->id);
		$uid = Yii::app()->user->id;
		
		$error_tokbox_session = 0;
		$apiKey=$rs='';
		$sid = isset($_GET['sid'])?$_GET['sid']:0;
		if($sid > 0)
		{
			$sql = "select * from tokbox_session where id={$sid} and push_uid={$uid}";
			$rs = Yii::app()->db->createCommand($sql)->queryRow();
			if(empty($rs))
			{
				$error_tokbox_session = 1;//link is invild
			}else{
				if($rs['push_uid'] != $uid)
					$error_tokbox_session = 2;//you are not in this broadcast
			}
			$apiKey=API_Config::API_KEY;
		}
		$userType = Yii::app()->user->type;
		$this->render('broadcast',array(
				'model'=>$model,
				'rs'=>$rs,
				'userType'=>$userType,
				'apiKey'=>$apiKey,'error_tokbox_session'=>$error_tokbox_session
		));
	}
	public function actionBroadcastlist()
	{
		$model=$this->loadModel(Yii::app()->user->id);
		$sid = Yii::app()->user->id;
		if($sid > 0)
		{
			$sql = "select * from tokbox_session where push_uid = {$sid} order by id desc";
			$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			$count=count($rs_1);
			$dataProvider=new CSqlDataProvider($sql, array(
					//'id'=>'user',
					'totalItemCount'=>$count,
					'pagination'=>array(
							'pageSize'=>10,
					),
			));
		}
		$userType = Yii::app()->user->type;
		$this->render('broadcastlist',array(
				'model'=>$model,
				'userType'=>$userType,
				'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		if(Yii::app()->user->id != $id)Yii::app()->request->redirect(Yii::app()->baseurl.'/user');
		
		$sql = "select * from user where uid=".Yii::app()->user->id;
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
	 *
	 * Delete customer profile promote
	 *
	 **/
     public function actionDelprofile()
	 {
         $uid = Yii::app()->user->id; 
		 $model = $this->loadModel($uid);
         $this->render('c_delprofile',array(
		    'model'=>$model,
	     ));
	 }


	 public function actionDelprofile1()
	 {
		 	$id = Yii::app()->user->id;
			$model = $this->loadModel($id);
				$model->status = 0;
				$model->pwd = md5('123456');
				if($model->update())
				{
					$this->render('c_delprofile1',array(
					    'model'=>$model,
				    ));
				}
	 }

	 /**
	  *
	  * Delete realtor profile promote
	  *
	  **/
	 public function actionDelprofiler()
	 {
		 $uid = Yii::app()->user->id;
		 $model = $this->loadModel($uid);
		 $rsModel = self::actionRleft();
		 $this->render('r_contact',array(
		               'model'=>$model,
		               'modelEmail'=>$rsModel['modelEmail'],
					   'hidden_to_uid'=>     $rsModel['hidden_to_uid'],
					   ));
	 }




	 /**
	  * Creates a new model.
	  * If creation is successful, the browser will be redirected to the 'view' page.
	  */
	 public function actionRegirest()
	 {
		 $model=new User;
		 $type = isset($_GET['type'])?$_GET['type']:0;
		 $model->type =$type;
		 // Uncomment the following line if AJAX validation is needed
		 // $this->performAjaxValidation($model);

		 if(isset($_POST['User']))
		 {
			 $model->attributes=$_POST['User'];
			 $model->type = $_POST['type'];
			 $model->pwd = md5($model->pwd);
			 $model->repwd = md5($model->repwd);

			 $model->logo = CUploadedFile::getInstance($model, 'logo');
			 if(!empty($model->logo->name))
			 {
				 $name = md5($model->email).strtolower(substr($model->logo->name, strlen($model->logo->name) - 4));
				 if($model->logo->saveAs(Yii::app()->basePath.'/../upload/user_logo/'.$name,true))
				 {
					 $model->logo = $name;
					 //echo 'filename==='.$name;exit;
				 }else{
					 echo 'file is null';exit;
				 }
			 }else{
				 $model->logo = 'default_logo.png';
			 }
			 if($model->save())$this->redirect(array('/login'));
		 }

		 $this->render('create',array(
					 'model'=>$model,'type'=>$type,
					 ));
	 }

	 /**
	  * Updates a particular model.
	  * If update is successful, the browser will be redirected to the 'view' page.
	  * @param integer $id the ID of the model to be updated
	  */
	 public function actionRupdate()
	 {
		 $id = Yii::app()->user->id;
		 $model=$this->loadModel($id);
		 if(isset($_POST['User']))
		 {
			 $logo_old = $model->logo;
			 $pwd_old = $model->pwd;
			 $model->attributes=$_POST['User'];
			 $model->type = $_POST['type'];
			 $model->pwd = $model->repwd = $pwd_old;
			 $model->logo = isset($_POST['hidden_logo']) ? $_POST['hidden_logo'] : $logo_old;

			 if($model->save())
			 {
				 Yii::app()->user->setFlash('Rupdate_success',Yii::t('User','edit_profile_ok'));
				 $this->refresh();
			 }
		 }

		 $rsModel = self::actionRleft();
		 $this->render('r_update',array(
					 'model'=>$model,
					 'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid']
					 ));

	 }
	 public function actionUploadpropertylogo()
	 {
		 if (in_array($_FILES["Property_logo"]["type"],array('image/jpeg','image/png','image/gif')))
		 {
			 if ($_FILES["Property_logo"]["error"] > 0)
			 {
				 echo json_encode(array('returnCode'=>3,'errors'=>$_FILES["Property_logo"]["error"]));exit;//error
			 }
			 else
			 {
				 $img_name = $_FILES["Property_logo"]["name"];
				 $photos_name = md5(time()).strtolower(substr($img_name, strlen($img_name) - 4));
				 move_uploaded_file($_FILES["Property_logo"]["tmp_name"],dirname(Yii::app()->basePath)."/upload/property/" . $photos_name);

				 $image = Yii::app()->image->load('upload/property/'.$photos_name);
				 $new_width = $image->width < 200 ? $image->width : (200 / $image->width) * $image->width;
				 $new_height = $image->height < 200 ? $image->height : (200 / $image->height) * $image->height;
				 $image->resize($new_width, $new_height);
				 $image->save();
				 echo $photos_name;
			 }
		 }
		 else
		 {
			 echo json_encode(array('returnCode'=>2));exit;//image type
		 }
	 }
	 public function actionUploadavatar()
	 {

		 if (in_array($_FILES["User_logo"]["type"],array('image/jpeg','image/png','image/gif')))
		 {
			 if ($_FILES["User_logo"]["error"] > 0)
			 {
				 echo json_encode(array('returnCode'=>3,'errors'=>$_FILES["User_logo"]["error"]));exit;//error
			 }
			 else
			 {
				 $img_name = $_FILES["User_logo"]["name"];
				 $photos_name = md5(time()).strtolower(substr($img_name, strlen($img_name) - 4));
				 move_uploaded_file($_FILES["User_logo"]["tmp_name"],dirname(Yii::app()->basePath)."/upload/user_logo/" . $photos_name);

				 $image = Yii::app()->image->load('upload/user_logo/'.$photos_name);
				 $new_width = $image->width < 200 ? $image->width : (200 / $image->width) * $image->width;
				 $new_height = $image->height < 200 ? $image->height : (200 / $image->height) * $image->height;
				 $image->resize($new_width, $new_height);
				 $image->save();
				 echo $photos_name;
			 }
		 }
		 else
		 {
			 echo json_encode(array('returnCode'=>2));exit;//image type
		 }
	 }



	 public function actionUploadavatarsss()
	 {
		 $id = Yii::app()->user->id;
		 $model=$this->loadModel($id);
		 $this->performAjaxValidation($model);

		 // 		if(isset($_POST['User']))
		 // 		{
		 $model->attributes=$_POST['User'];
		 $attach = CUploadedFile::getInstance($model, 'logo');
		 if(!empty($attach))
		 {
			 if(!in_array(strtolower($attach->extensionName), array('jpg','gif','png'))){
				 echo Yii::t('User','file_type');
			 }else if(!empty($attach->name)){
				 $name = md5($model->email).time().'.'.strtolower($attach->extensionName);
				 if($attach->saveAs(dirname(Yii::app()->basePath).'/upload/user_logo/'.$name,true))
				 {
					 $model->logo = $name;
					 $image = Yii::app()->image->load('upload/user_logo/'.$name);
					 $new_width = $image->width > 200 ? 200 : $image->width;
					 $new_height = $image->height > 200 ? 200 : $image->height;
					 $image->resize($new_width, $new_height);
					 $image->save();
					 echo $name;
				 }else{
					 echo 'Upload failed.';
				 }
			 }
		 }else{
			 echo 'The images is null.';
		 }
		 // 		}else{
		 // 				echo 1111;
		 // 		}
	 }
	 public function actionChangepwd()
	 {
		 $id = Yii::app()->user->id;
		 $model=$this->loadModel($id);
		 if(isset($_POST['User']))
		 {
			 $model->attributes=$_POST['User'];
			 if(empty($model->pwd))
			 {
				 Yii::app()->user->setFlash('Password',Yii::t('User','pwd_blank'));
				 $this->redirect(array('Changepwd'));
				 Yii::app()->end();
			 }
			 $model->type = $_POST['type'];
			 $model->pwd = md5($model->pwd);
			 $model->repwd = md5($model->repwd);
			 if($model->save())
			 {
				 Yii::app()->user->setFlash('success',Yii::t('User','change_pwd_ok'));
				 $this->redirect(array('Changepwd'));
				 Yii::app()->end();
			 }
		 }
		 $userType = Yii::app()->user->type;
		 $this->render('changepwd',array(
					 'model'=>$model,
					 'userType'=>$userType
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
	 public function actionInvite()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);
		 $modelInviteclient=new User;
		 $modelInviteclient->buyorsell = 1;
		 $modelInviteclient->first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';
		 $modelInviteclient->last_name = isset($_GET['last_name']) ? $_GET['last_name'] : '';
		 $modelInviteclient->email = isset($_GET['email']) ? $_GET['email'] : '';
		 $modelInviteclient->city = isset($_GET['city']) ? $_GET['city'] : '';
		 $modelInviteclient->mobile = isset($_GET['mobile']) ? $_GET['mobile'] : '';

		 /****invite client Start***/
		 if(isset($_POST['User']))
		 {
			 $modelInviteclient->attributes=$_POST['User'];
			 $modelInviteclient->type = 1;
			 $pwd_old = date(time());
			 $modelInviteclient->pwd = md5($pwd_old);
			 $modelInviteclient->repwd = md5($pwd_old);
			 $modelInviteclient->logo = 'default_logo.png';
			 $forgetpwd = md5(time());
			 $modelInviteclient->forgetpwd = $forgetpwd;
			 $modelInviteclient->register_status = 1;

			 // 			if($modelInviteclient->validate())
			 // 			{
			 //check email_registered
			 if($modelInviteclient->exists("email='".$modelInviteclient->email."' and register_status=0"))
			 {
				 Yii::app()->user->setFlash('error_email_exists',Yii::t('User','email_registered'));
			 }else {
				 $rs = User::model()->findBySql("select uid from user where email='".$modelInviteclient->email."' and register_status=1");
				 if(!empty($rs))
				 {
					 $rs_arr = $rs->attributes;
					 if(!empty($rs_arr['uid']))
					 {
						 User::model()->deleteByPk($rs_arr['uid']);
						 $sql="delete from contact where uid_parent='".Yii::app()->user->id."' and uid_child=".$rs_arr['uid'];
						 Yii::app()->db->createCommand($sql)->query();
					 }
				 }
				 if($modelInviteclient->save())
				 {
					 //join it to my contact
					 $sql="insert into contact (uid_parent,uid_child, type) values(".Yii::app()->user->id.",".Yii::app()->db->getLastInsertID().", 1)";
					 Yii::app()->db->createCommand($sql)->query();
					 $sql="insert into contact (uid_parent,uid_child, type) values(".Yii::app()->db->getLastInsertID().",".Yii::app()->user->id.", 7)";
					 Yii::app()->db->createCommand($sql)->query();

					 /*****Begin:send email*********/
					 $url = Yii::app()->request->hostInfo.'/login/setpwd?fid='.$forgetpwd;
					 //start send email
					 $title = Yii::t('User','invite_email_title').Yii::app()->user->first_name.' '.Yii::app()->user->last_name.').';
					 $content = Yii::t('User','invite_email_content_1').Yii::app()->user->first_name.' '.Yii::app()->user->last_name.').<br/>
						 '.Yii::app()->user->first_name.' '.Yii::app()->user->last_name.Yii::t('User','invite_email_content_2').'<br/><br/>
						 Your account : '.$modelInviteclient->email.'<br/>'.
						 Yii::t('User','invite_email_content_3').'
						 <br/><br/>'.$url.'<br/><br/>'.Yii::t('User','invite_email_content_4');
					 $returnCode = $this->sendemail(Yii::app()->user->name,Yii::app()->user->name,array($modelInviteclient->email),$title,$content,'');
					 /*****End:send email*********/

					 $enroll_ok = 'An email has been sent to '.$modelInviteclient->email.' to enroll in MRT as your client.';
					 Yii::app()->user->setFlash('successEnroll',Yii::t('User',$enroll_ok));
					 $this->redirect('/user/invite');
					 Yii::app()->end();
				 }else{
					 // 					if($modelInviteclient->hasErrors())
					 // 					{
					 Yii::app()->user->setFlash('errorEnroll', 'Enroll failed.');
					 // 					}
				 }
			 }

			 // 			}
		 }
		 /****invite client End***/
		 $rsModel = self::actionRleft();
		 $this->render('r_invite',array(
					 'model'=>$model,'modelInviteclient'=>$modelInviteclient,'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid']
					 ));
	 }
	 public function actionRleft()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);
		 $email = self::sendemailHelper();
		 $modelEmail= $email[0];
		 $hidden_to_uid = $email[1];

		 return array('modelEmail'=>$modelEmail,'hidden_to_uid'=>$hidden_to_uid,);
	 }

	 public function actionRgroupemailsubmit()
	 {
		 if(!empty(Yii::app()->user->id))
		 {
			 /**********send_email start*************/
			 $modelEmail=new Email;
			 $hidden_to_uid = '';
			 if(isset($_POST['Email']))
			 {
				 $session_uid = Yii::app()->user->id;
				 $session_uidname = Yii::app()->user->name;

				 $modelEmail->attributes=$_POST['Email'];
				 $modelEmail->send_date = date('Y-m-d');
				 $modelEmail->from_uid = $session_uid;

				 //start upload attachments
				 $modelEmail->attachments = CUploadedFile::getInstance($modelEmail, 'attachments');
				 if(!empty($modelEmail->attachments->name))
				 {
					 $name = time().strtolower(substr($modelEmail->attachments->name, strlen($modelEmail->attachments->name) - 4));
					 if($modelEmail->attachments->saveAs(Yii::app()->basePath.'/../upload/email_attachments/'.$name,true))
					 {
						 $modelEmail->attachments = Yii::getPathOfAlias('webroot').'/upload/email_attachments/'.$name;
					 }else{
						 $modelEmail->attachments = "";
					 }
				 }
				 //end upload attachments

				 /**********get email list of users*************/
				 $toUserInfo = '';
				 $newsletter_value = $_POST['newsletter_value'];

				 switch($newsletter_value)
				 {
					 case 1:
						 $sql = "select email,uid,'c' as table_name from user where uid in (select c.uid_child from contact c where c.subscribe=1 and c.uid_parent=".$session_uid.")
							 union all
							 select p.email_1 as email,uid,'p' as table_name from prospects p where p.subscribe=1 and p.uid_parent=".$session_uid;
						 $toUserInfo = Yii::app()->db->createCommand($sql)->queryAll();
						 break;
					 case 3:
						 $sql_type = '';
						 if((!isset($_POST['contact_type']))&&(!isset($_POST['prospect_type'])))
						 {
							 Yii::app()->user->setFlash('errorSendemailGroup',"Please choose at least one contact type or prospect type.");
							 $this->redirect('/user/rgroupemail',false);
							 exit();
						 }

						 $contact_type = isset($_POST['contact_type'])?$_POST['contact_type']:"";
						 $prospect_type = isset($_POST['prospect_type'])?$_POST['prospect_type']:"";

						 $contact_type_num = $prospect_type_num = 0;
						 $contact_type_str = $prospect_type_str = '';
						 if(!empty($contact_type))
						 {
							 $contact_type_num = count($contact_type);
							 $contact_type_str = implode(',', $contact_type);
						 }
						 if(!empty($prospect_type))
						 {
							 $prospect_type_num = count($prospect_type);
							 $prospect_type_str = implode(',', $prospect_type);
						 }

						 if($contact_type_num > 0 && $prospect_type_num < 1)
						 {
							 $sql_type = "select email,uid,'c' as table_name from user where uid in (select c.uid_child from contact c where c.subscribe=1 and c.type in ({$contact_type_str}) and c.uid_parent=".$session_uid.")";
						 }
						 if($prospect_type_num > 0 && $contact_type_num < 1)
						 {
							 $sql_type = "select p.email_1 as email,uid,'p' as table_name from prospects p where p.subscribe=1 and p.type in ({$prospect_type_str}) and p.uid_parent=".$session_uid;
						 }
						 if($prospect_type_num > 0 && $contact_type_num > 0)
						 {
							 $sql_type = "select email,uid,'c' as table_name from user where uid in (select c.uid_child from contact c where c.subscribe=1 and c.type in ({$contact_type_str}) and c.uid_parent=".$session_uid.")
								 union all
								 select p.email_1 as email,uid,'p' as table_name from prospects p where p.subscribe=1 and p.type in ({$prospect_type_str}) and p.uid_parent=".$session_uid;
						 }
						 // 						echo $sql_type;exit;
						 if(!empty($sql_type))$toUserInfo = Yii::app()->db->createCommand($sql_type)->queryAll();
						 break;
					 case 2:
						 $state = isset($_POST['state']) ? $_POST['state'] : '';
						 $city = isset($_POST['city']) ? $_POST['city'] : '';
						 $beds1 = isset($_POST['beds1']) ? $_POST['beds1'] : '';
						 $beds2 = isset($_POST['beds2']) ? $_POST['beds2'] : '';
						 $bath1 = isset($_POST['bath1']) ? $_POST['bath1'] : '';
						 $bath2 = isset($_POST['bath2']) ? $_POST['bath2'] : '';
						 $price_range = isset($_POST['price_range']) ? $_POST['price_range'] : '';
						 $sql_where = "";
						 $sql_where .= empty($state) ? "" : " and (state like '%".$state."%') ";
						 $sql_where .= empty($city) ? "" : " and (city like '%".$city."%') ";

						 if($beds1 > $beds2)
						  {
                               Yii::app()->user->setFlash('errorSendemailGroup',"The bed number range is incorrect.");
                               $this->redirect('/user/rgroupemail',false);
                               exit();
						  }

                          if($bath1 > $bath2)
                           {
                                Yii::app()->user->setFlash('errorSendemailGroup',"The bath number range is incorrect.");
                                $this->redirect('/user/rgroupemail',false);
                                exit();
                           } 						  
						 $sql_where .= " and ((beds > ".$beds1." or beds = ".$beds1.") or (beds < ".$beds2." or beds = ".$beds2."))";
						 $sql_where .= " and ((baths > ".$bath1." or baths = ".$bath1.") or (baths < ".$bath2." or baths = ".$bath2."))";


						 switch($price_range)
						 {
							 case 1:$sql_where .= " and price_to < 100000";break;
							 case 2:$sql_where .= " and price_from >100000 and price_to < 250000";break;
							 case 3:$sql_where .= " and price_from >250000 and price_to < 400000";break;
							 case 4:$sql_where .= " and price_from >400000 and price_to < 600000";break;
							 case 5:$sql_where .= " and price_from >600000 and price_to < 800000";break;
							 case 6:$sql_where .= " and price_from >800000 and price_to < 1000000";break;
							 case 7:$sql_where .= " and price_from >1000000 and price_to < 1250000";break;
							 case 8:$sql_where .= " and price_from >1250000";break;
						 }
						 $sql = "select email,uid,'c' as table_name from user where uid in (select c.uid_child from contact c where c.uid_parent=".$session_uid.") ".$sql_where;
						 //echo $sql; exit();
						 $toUserInfo = Yii::app()->db->createCommand($sql)->queryAll();
						 break;
				 }
				 //Start send email
				 $num = count($toUserInfo);
				 if($num>0)
				 {
					 $fromEmail = $session_uidname;
					 $fromName = $session_uidname;
					 $title = $modelEmail->title;
					 $attachment = $modelEmail->attachments;
					 $content = $modelEmail->contents.'<br/>'.str_replace("\n","<br/>",Yii::app()->user->signature);

					 $send_ok_num = $send_ok_no = 0;
					 for($i=0;$i<$num;$i++)
					 {
						 $modelEmail=new Email;
						 $modelEmail->send_date = date('Y-m-d');
						 $modelEmail->from_uid = $session_uid;
						 $modelEmail->setAttribute('to_uid', $toUserInfo[$i]["uid"]);
						 $modelEmail->title = $title;
						 $modelEmail->contents = $content;
						 $modelEmail->attachments = $attachment;
						 $modelEmail->save();

						 $link = $content_new = '';
						 $toEmailArrary = array($toUserInfo[$i]["email"]);
						 $link = '<br/><br/><a href="'.Yii::app()->request->hostInfo.'/user/unsubscrible?rid='.$session_uid.'&cid='.$toUserInfo[$i]["uid"].'&fid='.$toUserInfo[$i]["table_name"].'">Click here to unsubscribe</a>';
						 $content_new = $content.$link;
						 $returnCode = $this->sendemail($fromEmail,$fromName,$toEmailArrary,$title,$content_new,$attachment);
					 }
					 switch ($returnCode)
					 {
						 case 1:
							 Yii::app()->user->setFlash('successSendemailGroup',"Send Group Email Success.");
							 break;
						 case 2:
							 Yii::app()->user->setFlash('errorSendemailGroup',"Please check out all fileds are not blank.");
							 break;
						 default:
							 Yii::app()->user->setFlash('errorSendemailGroup',"Send Group Email Failed.");
					 }
					 $this->redirect('/user/rgroupemail',false);
					 //End send email
				 }else{
					 Yii::app()->user->setFlash('errorSendemailGroup',"There is no record matching the given criteria.");
					 $this->redirect('/user/rgroupemail',false);
				 }

			 }
		 }
	 }
	 

	 public function actionRgroupemail()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);
		 $modelEmailGroup=new Email;

		 $rsModel = self::actionRleft();
		 $this->render('r_groupemail',array(
					 'model'=>$model,'modelEmailGroup'=>$modelEmailGroup,
					 'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid']
					 ));

	 }
	 public function actionRcontact()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);

		 $dataProvider=null;
		 if(!empty(Yii::app()->user->id))
		 {
			 $sql="select user.uid as id,user.* from 
				 (select uid_child from contact where uid_parent=".Yii::app()->user->id." and type = 7) as b 
				 left join user on b.uid_child=user.uid ";
			 $rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			 $count=count($rs_1);
			 $dataProvider=new CSqlDataProvider($sql, array(
						 //'id'=>'contact',
						 'totalItemCount'=>$count,
						 'sort'=>array(
							 'attributes'=>array(
								 'id', 'uid', 'first_name','last_name','city', 'broker',
								 ),
							 ),
						 'pagination'=>array(
							 'pageSize'=>10,
							 ),
						 ));
		 }
		 $rsModel = self::actionRleft();
		 $this->render('r_contact',array(
					 'model'=>$model,'dataProvider'=>$dataProvider,
					 'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid']
					 ));

	 }


     /*
	  *  added by zhao peng  2013-08-15
	  */
	 public function actionRclient()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);

		 $dataProvider=null;
		 if(!empty(Yii::app()->user->id))
		 {
			 $sql="select user.uid as id,user.* from 
				 (select uid_child from contact where uid_parent=".Yii::app()->user->id." and type = 1) as b 
				 left join user on b.uid_child=user.uid ";
			 $rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			 $count=count($rs_1);
			 $dataProvider=new CSqlDataProvider($sql, array(
						 //'id'=>'contact',
						 'totalItemCount'=>$count,
						 'sort'=>array(
							 'attributes'=>array(
								 'id', 'uid', 'first_name','last_name','city', 'broker',
								 ),
							 ),
						 'pagination'=>array(
							 'pageSize'=>10,
							 ),
						 ));
		 }
		 $rsModel = self::actionRleft();
		 $this->render('r_client',array(
					 'model'=>$model,'dataProvider'=>$dataProvider,
					 'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid']
					 ));

	 }



	 public function actionUploadcsv()
	 {
		 // 		echo $_FILES["file_csv"]["type"];exit;
		 if(!isset($_FILES["file_csv"]))
		 {
			 echo 'Upload failed.Please reupload.';exit;
		 }
		 // 		if ($_FILES["file_csv"]["type"] != "application/vnd.ms-excel")
		 // 		{
		 // 			echo 'Please upload a csv file.';exit;
		 // 		}
		 if ($_FILES["file_csv"]["size"] > 1048576)
		 {
			 echo 'The file size must be less than 1M.';exit;
		 }

		 if ($_FILES["file_csv"]["error"] > 0)
		 {
			 echo "Error: " . $_FILES["file_csv"]["error"] . "<br />";exit;
		 }
		 else
		 {
			 $img_name = $_FILES["file_csv"]["name"];
			 $photos_name = md5(time()).strtolower(substr($img_name, strlen($img_name) - 4));
			 move_uploaded_file($_FILES["file_csv"]["tmp_name"],dirname(Yii::app()->basePath)."/upload/csv/" . $photos_name);
			 // 			echo 'Upload successful.';exit;

			 if(empty($photos_name))
			 {
				 echo 'Upload failed.';exit;
			 }

			 //add item to db
			 $csv_array_0 = array();
			 $handle = fopen(Yii::app()->request->hostInfo."/upload/csv/".$photos_name, "r");
			 while (($data = fgetcsv($handle)) !== FALSE) {$csv_array_0[] = $data;}

			 /********START:add title to every row*************/
			 $csv_array = array();
			 if(!empty($csv_array_0))
			 {
				 $temp_num = count($csv_array_0);
				 for($i=1;$i<$temp_num;$i++)
				 {
					 $temp_row = $csv_array_0[$i];
					 $temp_row_num = count($temp_row);
					 for($j=0;$j<$temp_row_num;$j++)
					 {
						 if(isset($csv_array_0[0][$j]))$csv_array[$i-1][$csv_array_0[0][$j]] = $csv_array_0[$i][$j];
					 }
				 }
			 }
			 /********END:add title to every row*************/

			 /********START:add every row to db*************/
			 if(!empty($csv_array))
			 {
				 $session_uid = Yii::app()->user->id;
				 $num = count($csv_array);
				 $num_success = 0;
				 $emailError = '';
				 for($i=0;$i<$num;$i++)
				 {
					 if(!empty($csv_array[$i]))
					 {
						 $modelProspects = new Prospects();
						 $modelProspects->uid_parent = $session_uid;

						 $modelProspects->title = $this->actionCheck_array_key('Title',$csv_array[$i]);
						 $modelProspects->first_name = $this->actionCheck_array_key('First Name',$csv_array[$i]);
						 $modelProspects->middle_name = $this->actionCheck_array_key('Middle Name',$csv_array[$i]);
						 $modelProspects->last_name = $this->actionCheck_array_key('Last Name',$csv_array[$i]);
						 $modelProspects->suffix = $this->actionCheck_array_key('Suffix',$csv_array[$i]);
						 $modelProspects->email_1 = $this->actionCheck_array_key('E-mail Address',$csv_array[$i]);
						 $modelProspects->email_2 = $this->actionCheck_array_key('E-mail 2 Address',$csv_array[$i]);
						 $modelProspects->email_3 = $this->actionCheck_array_key('E-mail 3 Address',$csv_array[$i]);
						 $modelProspects->mobile = $this->actionCheck_array_key('Mobile Phone',$csv_array[$i]);
						 $modelProspects->notes = $this->actionCheck_array_key('Notes',$csv_array[$i]);
						 $modelProspects->profession = $this->actionCheck_array_key('Profession',$csv_array[$i]);
						 $modelProspects->referred_buy = $this->actionCheck_array_key('Referred Buy',$csv_array[$i]);
						 $modelProspects->birthday = $this->actionCheck_array_key('Birthday',$csv_array[$i]);
						 $modelProspects->spouse = $this->actionCheck_array_key('Spouse',$csv_array[$i]);
						 $modelProspects->gender = $this->actionCheck_array_key('Gender',$csv_array[$i]);
						 $modelProspects->home_street_1 = $this->actionCheck_array_key('Home Street',$csv_array[$i]);
						 $modelProspects->home_street_2 = $this->actionCheck_array_key('Home Street 2',$csv_array[$i]);
						 $modelProspects->home_street_3 = $this->actionCheck_array_key('Home Street 3',$csv_array[$i]);
						 $modelProspects->home_address_po_box = $this->actionCheck_array_key('Home Address PO Box',$csv_array[$i]);
						 $modelProspects->home_city = $this->actionCheck_array_key('Home City',$csv_array[$i]);
						 $modelProspects->home_state = $this->actionCheck_array_key('Home State',$csv_array[$i]);
						 $modelProspects->home_postal_code = $this->actionCheck_array_key('Home Postal Code',$csv_array[$i]);
						 $modelProspects->home_country_region = $this->actionCheck_array_key('Home Country / Region',$csv_array[$i]);
						 $modelProspects->home_phone_1 = $this->actionCheck_array_key('Home Phone',$csv_array[$i]);
						 $modelProspects->home_phone_2 = $this->actionCheck_array_key('Home Phone 2',$csv_array[$i]);
						 $modelProspects->home_fax = $this->actionCheck_array_key('Home Fax',$csv_array[$i]);
						 $modelProspects->company = $this->actionCheck_array_key('Company',$csv_array[$i]);
						 $modelProspects->department = $this->actionCheck_array_key('Department',$csv_array[$i]);
						 $modelProspects->job_title = $this->actionCheck_array_key('Job Title',$csv_array[$i]);
						 $modelProspects->business_street_1 = $this->actionCheck_array_key('Business Street',$csv_array[$i]);
						 $modelProspects->business_street_2 = $this->actionCheck_array_key('Business Street 2',$csv_array[$i]);
						 $modelProspects->business_street_3 = $this->actionCheck_array_key('Business Street 3',$csv_array[$i]);
						 $modelProspects->business_address_po_box = $this->actionCheck_array_key('Business Address PO Box',$csv_array[$i]);
						 $modelProspects->business_city = $this->actionCheck_array_key('Business City',$csv_array[$i]);
						 $modelProspects->business_state = $this->actionCheck_array_key('Business State',$csv_array[$i]);
						 $modelProspects->business_postal_code = $this->actionCheck_array_key('Business Postal Code',$csv_array[$i]);
						 $modelProspects->business_country_region = $this->actionCheck_array_key('Business Country / Region',$csv_array[$i]);
						 $modelProspects->company_main_phone = $this->actionCheck_array_key('Company Main Phone',$csv_array[$i]);
						 $modelProspects->business_phone_1 = $this->actionCheck_array_key('Business Phone',$csv_array[$i]);
						 $modelProspects->business_phone_2 = $this->actionCheck_array_key('Business Phone 2',$csv_array[$i]);
						 $modelProspects->business_fax = $this->actionCheck_array_key('Business Fax',$csv_array[$i]);
						 $modelProspects->web_page = $this->actionCheck_array_key('Web Page',$csv_array[$i]);
						 $modelProspects->assistants_name = $this->actionCheck_array_key("Assistant's Name",$csv_array[$i]);
						 $modelProspects->assistants_phone = $this->actionCheck_array_key("Assistant's Phone",$csv_array[$i]);
						 $modelProspects->managers_name = $this->actionCheck_array_key("Manager's Name",$csv_array[$i]);
						 $modelProspects->other_street_1 = $this->actionCheck_array_key('Other Street',$csv_array[$i]);
						 $modelProspects->other_street_2 = $this->actionCheck_array_key('Other Street 2',$csv_array[$i]);
						 $modelProspects->other_street_3 = $this->actionCheck_array_key('Other Street 3',$csv_array[$i]);
						 $modelProspects->other_address_po_box = $this->actionCheck_array_key('Other Address PO Box',$csv_array[$i]);
						 $modelProspects->other_city = $this->actionCheck_array_key('Other City',$csv_array[$i]);
						 $modelProspects->other_state = $this->actionCheck_array_key('Other State',$csv_array[$i]);
						 $modelProspects->other_postal_code = $this->actionCheck_array_key('Other Postal Code',$csv_array[$i]);
						 $modelProspects->other_country_region = $this->actionCheck_array_key('Other Country / Region',$csv_array[$i]);
						 $modelProspects->other_phone = $this->actionCheck_array_key('Other Phone',$csv_array[$i]);
						 $modelProspects->other_fax = $this->actionCheck_array_key('Other Fax',$csv_array[$i]);
						 $modelProspects->isdn = $this->actionCheck_array_key('ISDN',$csv_array[$i]);
						 $modelProspects->account = $this->actionCheck_array_key('Account',$csv_array[$i]);
						 $modelProspects->anniversary = $this->actionCheck_array_key('Anniversary',$csv_array[$i]);
						 $modelProspects->billing_information = $this->actionCheck_array_key('Billing Information',$csv_array[$i]);
						 $modelProspects->callback = $this->actionCheck_array_key('Callback',$csv_array[$i]);
						 $modelProspects->car_phone = $this->actionCheck_array_key('Car Phone',$csv_array[$i]);
						 $modelProspects->categories = $this->actionCheck_array_key('Categories',$csv_array[$i]);
						 $modelProspects->children = $this->actionCheck_array_key('Children',$csv_array[$i]);
						 $modelProspects->directory_server = $this->actionCheck_array_key('Directory Server',$csv_array[$i]);
						 $modelProspects->email_2_display_name = $this->actionCheck_array_key('E-mail 2 Display Name',$csv_array[$i]);
						 $modelProspects->email_2_type = $this->actionCheck_array_key('E-mail 2 type',$csv_array[$i]);
						 $modelProspects->email_3_display_name = $this->actionCheck_array_key('E-mail 3 Display Name',$csv_array[$i]);
						 $modelProspects->email_3_type = $this->actionCheck_array_key('E-mail 3 type',$csv_array[$i]);
						 $modelProspects->email_display_name = $this->actionCheck_array_key('E-mail Display Name',$csv_array[$i]);
						 $modelProspects->email_type = $this->actionCheck_array_key('E-mail Type',$csv_array[$i]);
						 $modelProspects->government_id_number = $this->actionCheck_array_key('Government ID Number',$csv_array[$i]);
						 $modelProspects->hobby = $this->actionCheck_array_key('Hobby',$csv_array[$i]);
						 $modelProspects->pager = $this->actionCheck_array_key('Pager',$csv_array[$i]);
						 $modelProspects->primary_phone = $this->actionCheck_array_key('Primary Phone',$csv_array[$i]);
						 $modelProspects->radio_phone = $this->actionCheck_array_key('Radio Phone',$csv_array[$i]);
						 $modelProspects->telex = $this->actionCheck_array_key('Telex',$csv_array[$i]);
						 $modelProspects->tty_tdd_phone = $this->actionCheck_array_key('TTY/TDD Phone',$csv_array[$i]);
						 $modelProspects->initials = $this->actionCheck_array_key('Initials',$csv_array[$i]);
						 $modelProspects->internet_free_busy = $this->actionCheck_array_key('Internet Free Busy',$csv_array[$i]);
						 $modelProspects->keywords = $this->actionCheck_array_key('Keywords',$csv_array[$i]);
						 $modelProspects->language = $this->actionCheck_array_key('Language',$csv_array[$i]);
						 $modelProspects->location = $this->actionCheck_array_key('Location',$csv_array[$i]);
						 $modelProspects->mileage = $this->actionCheck_array_key('Mileage',$csv_array[$i]);
						 $modelProspects->office_location = $this->actionCheck_array_key('Office Location',$csv_array[$i]);
						 $modelProspects->orgainization_id_number = $this->actionCheck_array_key('Orgainization ID Number',$csv_array[$i]);
						 $modelProspects->priority = $this->actionCheck_array_key('Priority',$csv_array[$i]);
						 $modelProspects->private = $this->actionCheck_array_key('Private',$csv_array[$i]);
						 $modelProspects->sensitivity = $this->actionCheck_array_key('Sensitivity',$csv_array[$i]);
						 $modelProspects->user_1 = $this->actionCheck_array_key('User 1',$csv_array[$i]);
						 $modelProspects->user_2 = $this->actionCheck_array_key('User 2',$csv_array[$i]);
						 $modelProspects->user_3 = $this->actionCheck_array_key('User 3',$csv_array[$i]);
						 $modelProspects->user_4 = $this->actionCheck_array_key('User 4',$csv_array[$i]);

						 if(!empty($modelProspects->email_1) && !$modelProspects->validate(array('email_1')))
						 { 
							 $emailError .= empty($emailError) ? $modelProspects->email_1 : ' , '.$modelProspects->email_1;
						 }else{
							 if($modelProspects->save())$num_success++;
						 }
					 }
				 }
				 $msg_email = empty($emailError) ? '' : ' Invalid email: '.$emailError.'.';
				 echo 'Upload '.$num_success.' items successful.'.$msg_email;exit;
			 }else{
				 echo 'No contents in the file.';exit;
			 }
			 /********END:add every row to db*************/
		 }
	 }
	 public function actionCheck_array_key($name,$arr_data)
	 {
		 return array_key_exists($name,  $arr_data) ? $arr_data[$name] : '';
	 }
	 public function actionRprospects()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);
		 $dataProvider=null;
		 if(!empty(Yii::app()->user->id))
		 {
			 $dataProvider=new CActiveDataProvider('Prospects',array(
						 'criteria'=>array('condition'=>'uid_parent='.Yii::app()->user->id),
						 'pagination'=>array('pageSize'=>25),
						 ));
		 }
		 $rsModel = self::actionRleft();
		 $this->render('r_prospects',array(
					 'model'=>$model,'dataProvider'=>$dataProvider,
					 'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid']
					 ));

	 }
	 public function actionRprospectsdel()
	 {
		 if (Yii::app()->request->isPostRequest)
		 {
			 $criteria= new CDbCriteria;
			 $criteria->addInCondition('uid', $_POST['selectdel']);
			 Prospects::model()->deleteAll($criteria);

			 if(isset(Yii::app()->request->isAjaxRequest)) {
				 echo 1;
			 } else{
				 echo 2;
			 }
		 }
	 }
	 public function actionCexpensedelete()
	 {
		 if (Yii::app()->request->isPostRequest)
		 {
			 $criteria= new CDbCriteria;
			 $criteria->addInCondition('id', $_POST['selectdel_expense']);
			 ClientExpense::model()->deleteAll($criteria);

			 if(isset(Yii::app()->request->isAjaxRequest)) {
				 echo 1;
			 } else{
				 echo 2;
			 }
		 }
	 }
	 public function actionCnotedelete()
	 {
		 if (Yii::app()->request->isPostRequest)
		 {
			 $criteria= new CDbCriteria;
			 $criteria->addInCondition('id', $_POST['selectdel_note']);
			 ClientNotes::model()->deleteAll($criteria);

			 if(isset(Yii::app()->request->isAjaxRequest)) {
				 echo 1;
			 } else{
				 echo 2;
			 }
		 }
	 }
	 public function actionRprospectsedit()
	 {
		 $uid = isset($_GET['id']) ? intval($_GET['id']) : '';
		 $model=$this->loadModel(Yii::app()->user->id);
		 $rsModel = self::actionRleft();

		 $modelProspects=Prospects::model()->findByAttributes(array("uid_parent"=>Yii::app()->user->id,"uid"=>$uid));
		 if(isset($_POST['Prospects']))
		 {
			 $modelProspects->attributes=$_POST['Prospects'];
			 if($modelProspects->save())
				 $this->redirect('/user/rprospects');
		 }

		 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/datepicker/WdatePicker.js');

		 $this->render('r_prospectsedit',array(
					 'model'=>$model,'modelProspects'=>$modelProspects,'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid']
					 ));
	 }
	 public function actionCloseproperty()
	 {
		 //user moder
		 $model=$this->loadModel(Yii::app()->user->id);

		 //init edit property page
		 $property_id = isset($_GET['pid']) ? intval($_GET['pid']) : '';
		 if(!empty(Yii::app()->user->id) && !empty($property_id))
		 {
			 $rs = Property::model()->findByAttributes(array("uid"=>Yii::app()->user->id,"property_id"=>$property_id));
			 // 			$rs = Property::model()->findByPk($property_id);
			 if(!empty($rs))
			 {
				 $modelProperty=$rs;
				 $modelProperty->setScenario('cloesd_property');
			 }else{
				 $this->redirect('/user');
			 }
		 }else{
			 $this->redirect('/user');
		 }
		 if($modelProperty->mrt_status == 1)$this->redirect('/user');

		 //post edit property page
		 if(isset($_POST['Property']))
		 {
			 $modelProperty->attributes=$_POST['Property'];
			 $modelProperty->update_date = date('Y-m-d H:i:s',time());
			 $modelProperty->mrt_status = 1;
			 $old_videos = $modelProperty->videos;
			 $modelProperty->videos = '';
			 $modelProperty->date = substr($modelProperty->date,0,10);

			 $modelProperty->transaction_price = !is_numeric($modelProperty->transaction_price) ? str_replace(',', '', $modelProperty->transaction_price) : $modelProperty->transaction_price;
			 $modelProperty->expense_gas = !is_numeric($modelProperty->expense_gas) ? str_replace(',', '', $modelProperty->expense_gas) : $modelProperty->expense_gas;
			 $modelProperty->expense_meals = !is_numeric($modelProperty->expense_meals) ? str_replace(',', '', $modelProperty->expense_meals) : $modelProperty->expense_meals;
			 $modelProperty->expense_advertising = !is_numeric($modelProperty->expense_advertising) ? str_replace(',', '', $modelProperty->expense_advertising) : $modelProperty->expense_advertising;
			 $modelProperty->expense_1 = !is_numeric($modelProperty->expense_1) ? str_replace(',', '', $modelProperty->expense_1) : $modelProperty->expense_1;

			 if($modelProperty->save())
			 {
				 // 				if(!empty($old_videos))
				 // 				{
				 // 					$old_videos_arr = explode(',', $old_videos);
				 // 					$num = count($old_videos_arr);
				 // 					if($num > 0)
				 // 					{
				 // 						$path = Yii::app()->request->hostInfo.'/upload/video/';
				 // 						for($i=0;$i<$num;$i++)
				 // 						{
				 // 							$path_file = $path.$old_videos_arr[$i];
				 // 							echo $path_file;
				 // // 							if(file_exists($path_file)){
				 // 								if(!is_writeable($path_file))
				 // 								{
				 // 									echo 2;
				 // 									if(chmod($path_file, 0755))
				 // 										echo 5;
				 // 									else
				 // 										echo 6;
				 // 								}
				 // 								echo 3;
				 // 								unlink($path_file);
				 // 								echo 4;
				 // // 							}else{
				 // // 								echo 1;
				 // // 							}
				 // 						}
				 // 					}
				 // 				}
				 $this->redirect(array('/user'));
			 }
		 }

		 //init left page
		 $rsModel = self::actionRleft();
		 $this->render('closeproperty',array('model'=>$model,'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid'],'modelProperty'=>$modelProperty));

	 }
	 public function actionEditproperty()
	 {
		 //user moder
		 $model=$this->loadModel(Yii::app()->user->id);

		 //init edit property page
		 $dataProvider=null;
		 $property_id = isset($_GET['pid']) ? intval($_GET['pid']) : '';
		 if(!empty(Yii::app()->user->id) && !empty($property_id))
		 {
			 $rs = Property::model()->findByAttributes(array("uid"=>Yii::app()->user->id,"property_id"=>$property_id));
			 // 			$rs=Property::model()->findByPk($property_id);
			 if(!empty($rs))
				 $modelProperty=$rs;
			 else
				 $this->redirect('/user');
		 }else{
			 $this->redirect('/user');
		 }
		 if($modelProperty->mrt_status == 1)$this->redirect('/user');
		 $old_logo = $modelProperty->logo;

		 $change = isset($_GET['change']) ? intval($_GET['change']) : 0;
		 if($modelProperty->non_listing == 1)
		 {
			 $modelProperty->scenario = $change == 1 ? 'current_property' : null;
		 }else{
			 $modelProperty->scenario = 'current_property';
		 }
		 //post edit property page
		 if(isset($_POST['Property']))
		 {
			 // 			$modelPostProperty=new Property;
			 $modelProperty->attributes=$_POST['Property'];

			 $modelProperty->price = !is_numeric($modelProperty->price) ? str_replace(',', '', $modelProperty->price) : $modelProperty->price;
			 $modelProperty->house_size = !is_numeric($modelProperty->house_size) ? str_replace(',', '', $modelProperty->house_size) : $modelProperty->house_size;
			 $modelProperty->lot_size = !is_numeric($modelProperty->lot_size) ? str_replace(',', '', $modelProperty->lot_size) : $modelProperty->lot_size;

			 $modelProperty->uid = Yii::app()->user->id;
			 $modelProperty->property_id = $property_id;
			 $modelProperty->logo = isset($_POST['hidden_logo']) ? $_POST['hidden_logo'] : $old_logo;
			 $modelProperty->update_date = date('Y-m-d H:i:s',time());
			 $modelProperty->address = '';
			 $modelProperty->address .= $modelProperty->street; 
			 $modelProperty->address .= empty($modelProperty->address) ? '' : ' '.$modelProperty->city;
			 $modelProperty->address .= empty($modelProperty->address) ? '' : ' '.$modelProperty->state;
			 $modelProperty->address .= empty($modelProperty->address) ? '' : ' '.$modelProperty->zip;

			 if($modelProperty->save())$this->redirect(array('/property/'.$modelProperty->property_id));
		 }

		 //init left page
		 $rsModel = self::actionRleft();
		 $this->render('editproperty',array(
					 'model'=>$model,'modelEmail'=>$rsModel['modelEmail'],'change'=>$change,
					 'hidden_to_uid'=>$rsModel['hidden_to_uid'],'modelProperty'=>$modelProperty
					 ));

	 }


	 public function actionCreateproperty()
	 {
		 //user moder
		 $model=$this->loadModel(Yii::app()->user->id);

		 //init edit property page
		 $modelProperty = new Property('current_property');
		 $modelProperty->logo = 'default_property.png';

		 if(isset($_POST['Property']))
		 {
			 $modelProperty->attributes=$_POST['Property'];

			 $modelProperty->price = !is_numeric($modelProperty->price) ? str_replace(',', '', $modelProperty->price) : $modelProperty->price;
			 $modelProperty->house_size = !is_numeric($modelProperty->house_size) ? str_replace(',', '', $modelProperty->house_size) : $modelProperty->house_size;
			 $modelProperty->lot_size = !is_numeric($modelProperty->lot_size) ? str_replace(',', '', $modelProperty->lot_size) : $modelProperty->lot_size;

			 $modelProperty->uid = Yii::app()->user->id;
			 $modelProperty->logo = 'default_property.png';
			 $time = date('Y-m-d H:i:s',time());
			 $modelProperty->date = $time;
			 $modelProperty->logo = isset($_POST['hidden_logo']) ? $_POST['hidden_logo'] : $old_logo;
			 $modelProperty->update_date = $time;
			 
			 /* 	$attach = CUploadedFile::getInstance($modelProperty, 'logo');
					if(!empty($attach))
					{
					if(!in_array(strtolower($attach->extensionName), array('jpg','gif','png'))){
					Yii::app()->user->setFlash('errorUpload',Yii::t('User','file_type'));
					$this->refresh();
			 // 			 	}else if($attach->size > 2000000){
			 // 					Yii::app()->user->setFlash('errorUpload',Yii::t('User','file_size'));
			 // 					$this->refresh(); 
			 }else if(!empty($attach->name)){
			 $name = md5(time()).'.'.strtolower($attach->extensionName);
			 if($attach->saveAs(dirname(Yii::app()->basePath).'/upload/property/'.$name,true))$modelProperty->logo = $name;
			 }
			 }  */
			 
			 $modelProperty->address = '';
			 $modelProperty->address .= $modelProperty->street;
			 $modelProperty->address .= empty($modelProperty->address) ? '' : ' '.$modelProperty->city;
			 $modelProperty->address .= empty($modelProperty->address) ? '' : ' '.$modelProperty->state;
			 $modelProperty->address .= empty($modelProperty->address) ? '' : ' '.$modelProperty->zip;
			 if($modelProperty->save())
				 $this->actionCreatepropertyEmail($modelProperty->uid, $modelProperty);
				 $this->redirect(array('/property/'.$modelProperty->property_id));
		 }

		 //init left page
		 $rsModel = self::actionRleft();
		 $this->render('createproperty',array(
					 'model'=>$model,'modelEmail'=>$rsModel['modelEmail'],
					 'hidden_to_uid'=>$rsModel['hidden_to_uid'],'modelProperty'=>$modelProperty
					 ));
	 }


	 /*
	  *
	  * @author:        Zhao Peng
	  * @description:   To send emails to the agent's clients whose profile-setting fit the listing properties.
	  *
	  */
	 public function actionCreatepropertyEmail($uid, $modelProperty)
	 {
		 $pid    =  $modelProperty->property_id;
		 $type   =  $modelProperty->property_type;
		 $price  =  $modelProperty->price;
		 $house_size = $modelProperty->house_size;
		 $beds   =  $modelProperty->beds;
		 $baths  =  $modelProperty->baths;
		 $levels =  $modelProperty->levels;
		 $pool   =  $modelProperty->pool; 
		 $fromEmail = 'info@myrealtour.com';
		 $fromName  = 'MyRealTour';

	     $sql = "select uid, email from user where property_type = ".$type." and beds = '".$beds."' and baths = '".$baths."' and pool = '".$pool."' and  ((price_from < ".$price.") or (price_from =  ".$price.")) and ((price_to >".$price.") or (price_to = ".$price."))";
		 $client_list = Yii::app()->db->createCommand($sql)->queryAll();
		 if(count($client_list)>0)
		 {
             foreach($client_list as $client) 
			 {
				 echo "Send email to user ".$client['uid']." <br/>"; 
				 $modelEmail=new Email;
				 $modelEmail->send_date = date('Y-m-d');
				 $modelEmail->from_uid = $uid;
				 $modelEmail->setAttribute('to_uid', $client["uid"]);
				 $modelEmail->title = "New Property recommendation";
				 $modelEmail->contents = 'Your realtor has created a new listing on MRT, you migh find it interesting:<br/><br/><a href="'.Yii::app()->request->hostInfo.'/property/'.$pid.'">Click here to view it</a>';
				 $modelEmail->attachments = '';
				 $modelEmail->save();

				 $toEmailArrary = array($client["email"]);
				 $content_new = 'Your realtor has created a new listing on MRT, you migh find it interesting:<br/><br/><a href="'.Yii::app()->request->hostInfo.'/property/'.$pid.'">Click here to view it</a>';
				 $returnCode = $this->sendemail($fromEmail,$fromName,$toEmailArrary,$modelEmail->title,$content_new,$modelEmail->attachments);
			 }
		 }
	 }



	 public function actionIndex()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);
		 $url = '';
		 switch ($model->type)
		 {
			 case 1:$url = '/user/cindex';break;
			 case 2:$url = '/user/rindex';break;
			 default:$url = '/user/rindex';

		 }
		 Yii::app()->request->redirect(Yii::app()->baseurl.$url);
	 }


	 public function actionAjaxcrop()
	 {
		 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			 $targ_w = $targ_h = 150; //保存的图片的大小
			 $jpeg_quality = 100;

			 $img_path = $_POST['img_path'];
			 $file_type = strtolower(substr($img_path, strlen($img_path) - 3));
			 $src = dirname(Yii::app()->basePath).$img_path;
			 if ($file_type == 'jpg') {
				 $img_r = imagecreatefromjpeg($src);
			 }
			 if ($file_type == 'png') {
				 $img_r = imagecreatefrompng($src);
			 }
			 if ($file_type == 'gif') {
				 $img_r = imagecreatefromgif($src);
			 }
			 $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			 imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);

			 if ($file_type == 'jpg') {
				 if(imagejpeg($dst_r,$src,$jpeg_quality))echo $img_path;else echo 2;
			 }
			 if ($file_type == 'png') {
				 if(imagepng($dst_r,$src,9))echo $img_path;else echo 2;
			 }
			 if ($file_type == 'gif') {
				 if(imagegif($dst_r,$src,$jpeg_quality))echo $img_path;else echo 2;
			 }

			 // 			header('Content-type: image/jpeg');
			 // 			if(imagejpeg($dst_r,$src,$jpeg_quality))echo $img_path;else echo 2;
			 // 			echo $img_path;
			 // 			exit;
		 }

		 /* Yii::import('ext.jcrop.EJCropper');
			$jcropper = new EJCropper();
			$app_path = dirname(Yii::app()->basePath);
			$jcropper->thumbPath = $app_path.'/upload/user_logo';

		 // some settings ...
		 $jcropper->jpeg_quality = 95;
		 $jcropper->png_compression = 8;

		 // get the image cropping coordinates (or implement your own method)
		 $coords = $jcropper->getCoordsFromPost('imageId');

		 $someParam = $_POST['someParam'];
		 // returns the path of the cropped image, source must be an absolute path.
		 $thumbnail = $jcropper->crop($app_path.$someParam, $coords);
		 echo $thumbnail; */
	 }
	 /**
	  * Lists all models.
	  */
	 public function actionRindex()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);
		 $rsModel = self::actionRleft();

		 $dataProvider=new CActiveDataProvider('Property',array(
					 'criteria'=>array(
						 'condition'=>'uid='.Yii::app()->user->id.' and non_listing=0',
						 //'order'=>'date desc',
						 ),
					 'sort'=>array(
						 'defaultOrder'=>'update_date DESC',
						 ),
					 'pagination'=>array(
						 'pageSize'=>5
						 ),
					 ));

		 $f= '';
		 if(isset($_GET['f']) && !empty($_GET['f'])) $f=$_GET['f'];
		 $this->render('r_index',array(
					 'model'=>$model,'dataProvider'=>$dataProvider,'f'=>$f,
					 'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid']
					 ));
	 }
	 public function actionRnonlisting()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);
		 $rsModel = self::actionRleft();

		 //init non-listing
		 $dataProvider=new CActiveDataProvider('Property',array(
					 'criteria'=>array(
						 'condition'=>'uid='.Yii::app()->user->id.' and mrt_status=0 and non_listing=1',
						 ),
					 'sort'=>array(
						 'defaultOrder'=>'update_date DESC',
						 ),
					 'pagination'=>array(
						 'pageSize'=>5
						 ),
					 ));

		 //select my clients
		 /* 		$sql = "select client_list.*,share.property_id from 
					(select u.uid,u.first_name,u.last_name from contact as c left join user as u on c.uid_child=u.uid where c.uid_parent=".Yii::app()->user->id."  and type=1) as client_list
					left join share_non_listing as share 
					on client_list.uid = share.uid  "; */
		 $sql = "select u.uid,u.first_name,u.last_name from contact as c left join user as u on c.uid_child=u.uid where c.uid_parent=".Yii::app()->user->id."  and u.type=1";
		 // 		echo $sql;exit;
		 $client_list = Yii::app()->db->createCommand($sql)->queryAll();

		 //do shared
		 $modelShareNonListing=new ShareNonListing();
		 $this->performAjaxValidation($modelShareNonListing);
		 if(isset($_POST['ShareNonListing'])){
			 $num_share_success = 0;//share success
			 $modelShareNonListing->attributes=$_POST['ShareNonListing'];
			 $share_uid=$_POST['share_uid'];
			 $property_id = $modelShareNonListing->property_id;

			 //check have shared uid
			 $str_uid = implode(',', $share_uid);
			 $sql = "select uid from share_non_listing where uid  in ($str_uid) and property_id={$property_id}";
			 $have_share_uid = Yii::app()->db->createCommand($sql)->queryAll();
			 $have_share_uid_num = count($have_share_uid);
			 if($have_share_uid_num > 0)
			 {
				 for($i=0;$i<$have_share_uid_num;$i++)
				 {
					 $key = array_search($have_share_uid[$i]['uid'], $share_uid);
					 if($key !== false)unset($share_uid[$key]);
				 }
			 }

			 $no_share_uid_num = count($share_uid);
			 sort($share_uid);

			 if(!empty($modelShareNonListing->property_id) && $no_share_uid_num>0){
				 for($i=0;$i<$no_share_uid_num;$i++){
					 if(!empty($share_uid[$i]))
					 {
						 $modelShareNonListing_new=new ShareNonListing();
						 $modelShareNonListing_new->uid = $share_uid[$i];
						 $modelShareNonListing_new->property_id = $property_id;
						 if($modelShareNonListing_new->save())$num_share_success++;
					 }
				 }
			 }

			 // 			if($num_share_success > 0)
			 // 			{    
			 // 				$all = $num_share_success + $have_share_uid_num;
			 $msg_shared = 'Share successful';
			 Yii::app()->user->setFlash('successShared',$msg_shared);
			 $this->refresh();
			 // 			}else{
			 // 				Yii::app()->user->setFlash('errorShared','Shared failed.');
			 // 				$this->refresh();
			 // 			}
		 }

		 $this->render('r_nonlisting',array(
					 'model'=>$model,'dataProvider'=>$dataProvider,'client_list'=>$client_list,
					 'modelEmail'=>$rsModel['modelEmail'],'hidden_to_uid'=>$rsModel['hidden_to_uid']
					 ));
	 }
	 public function actionShareproperty()
	 {
		 // 		$model=$this->loadModel($id);
		 $modelShareNonListing=new ShareNonListing();
		 $this->performAjaxValidation($modelShareNonListing);

		 if(isset($_POST['ShareNonListing'])){
			 $num_share_success = 0;
			 $modelShareNonListing->attributes=$_POST['ShareNonListing'];
			 $share_uid=$_POST['share_uid'];
			 $num_share_uid = count($share_uid);

			 if(!empty($modelShareNonListing->property_id) && $num_share_uid>0){
				 for($i=0;$i<$num_share_uid;$i++){
					 $modelShareNonListing->uid = $share_uid[$i];
					 if($modelShareNonListing->save())$num_share_success++;
				 }
			 }
			 if($num_share_success > 0)
			 {
				 Yii::app()->user->setFlash('successShared','Shared successful for '.$num_share_success.' clients.');
				 $this->refresh();
			 }else{
				 Yii::app()->user->setFlash('errorShared','Shared failed.');
				 $this->refresh();
			 }
		 }

	 }
	 public function actionRcalendar()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);

		 $action = isset($_GET['action']) ? $_GET['action'] : '';
		 $year = isset($_GET['year']) ? $_GET['year'] : date('Y',time());
		 $month = isset($_GET['month']) ? $_GET['month'] : date('m',time());
		 $day = isset($_GET['day']) ? $_GET['day'] : date('d',time());

		 if($action == 'create')
		 {
			 header('Location:/calendar/create?year='.$year.'&month='.$month.'&day='.$day);
		 }

		 /******Begin:get events*****/
		 $wim = GoogleCalendar::weeks_in_month($month, $year);
		 $first_day = 1 - GoogleCalendar::day_of_week($month, 1, $year);
		 $from_stamp = mktime(0, 0, 0, $month, $first_day, $year);
		 $last_day = $wim * 7 - GoogleCalendar::day_of_week($month, 1, $year);
		 $to_stamp = mktime(0, 0, 0, $month, $last_day, $year);

		 $from_date = date('Y-m-d', $from_stamp);
		 $to_date = date('Y-m-d', $to_stamp);
		 $sql = "select aa.* from (select id,uid,start_time,end_time,title,content,create_time,invite_uid,
			 DATE_FORMAT(`start_time`, '%Y%m%d') AS `start_date`, DATE_FORMAT(`end_time`, '%Y%m%d') AS `end_date` , 
			 UNIX_TIMESTAMP(start_time) AS start_ts, UNIX_TIMESTAMP(end_time) AS end_ts 
				 from calendar where uid=".Yii::app()->user->id." ) as aa where 
				 DATE(aa.start_date) <= DATE('$to_date')   
				 and DATE(aa.end_date) >= DATE('$from_date') 
				 ORDER BY aa.start_ts"; 


				 /* $sql = "select id,uid,start_time,end_time,title,content,create_time,invite_uid,
					UNIX_TIMESTAMP(start_time) AS start_ts, UNIX_TIMESTAMP(end_time) AS end_ts
					from calendar where uid=".Yii::app()->user->id."
					AND DATE(start_time) <= DATE('$from_date')
					AND DATE(end_time) >= DATE('$to_date')
					ORDER BY start_time";  */

				 $result_events = Yii::app()->db->createCommand($sql)->queryAll();
		 // 		CVarDumper::dump($result_events,10,true);
		 // 		echo $sql;exit;
		 /******End:get events*******/

		 $now_month_name = GoogleCalendar::get_month_name($month);
		 $month_data = GoogleCalendar::month_view($month,$year,$wim,$first_day,$from_stamp,$last_day,$to_stamp,$result_events);

		 $month_table = $month_data['month_table'];
		 $month_navbar = $month_data['month_navbar'];

		 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/customer/calendar.js');

		 /******Begin:init add event*******/
		 $modelCalendar=new Calendar;
		 $hidden_invite_uid = $modelCalendar->invite_uid;
		 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');
		 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.core.js');
		 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.widget.js');
		 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.position.js');
		 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/datepicker/WdatePicker.js');
		 Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/autocomplete/jquery.ui.autocomplete.css');
		 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.autocomplete.js');
		 /******End:init add event*******/

		 $this->render('r_calendar',array(
					 'model'=>$model,'month_table'=>$month_table,'month_navbar'=>$month_navbar,'hidden_invite_uid'=>$hidden_invite_uid,
					 'now_month_name'=>$now_month_name,'now_year'=>$year,'modelCalendar'=>$modelCalendar
					 ));
	 }

	 public function actionRotherview()
	 {
		 $uid = Yii::app()->user->id;

		 if(empty($uid)){
			 $this->redirectMsg('/','Login or Register page',$msg='Please Login or Create a account to view it.');exit;
		 }
		 if(isset($_GET['uid']) && !empty($_GET['uid'])) $uid=$_GET['uid'];
		 $model=$this->loadModel($uid);

		 /****Begin: Inbox send msg*******/
		 $modelInbox=new Inbox;
		 $hidden_to_uid = $uid;
		 // 		$this->performAjaxValidation($modelInbox);
		 if(isset($_POST['Inbox']))
		 {

			 $modelInbox->attributes=$_POST['Inbox'];
			 $modelInbox->date = date('y-m-d H:i:s');
			 $modelInbox->from_uid = Yii::app()->user->id;
			 if(!empty($_POST['hidden_to_uid']))
			 {
				 $hidden_to_uid = $_POST['hidden_to_uid'];
				 if(Yii::app()->user->id == $hidden_to_uid)
				 {
					 Yii::app()->user->setFlash('error','You can not send message to yourself.');
					 $this->refresh();
					 Yii::app()->end();
				 }
				 $modelInbox->setAttribute('to_uid', $hidden_to_uid);

				 $sql = "select parent_id from inbox
					 where (to_uid=".$hidden_to_uid." and from_uid=".Yii::app()->user->id.")
					 or (to_uid=".Yii::app()->user->id." and from_uid=".$hidden_to_uid.") limit 1";
				 $parent_id = Yii::app()->db->createCommand($sql)->queryScalar();

				 if($modelInbox->save())
				 {
					 $id = Yii::app()->db->getLastInsertID();
					 $new_parent_id = empty($parent_id) ? $id : $parent_id;
					 $sql = "update inbox set parent_id={$new_parent_id} where id={$id}";
					 Yii::app()->db->createCommand($sql)->execute();

					 if(!empty($model['push_id']))
					 {
						 $apns = new Apns($model['push_id'], Yii::t('Inbox','send_push_title'),$modelInbox->content,2,Yii::app()->user->id,'message.wav');
						 $apns->doPush();
					 }
					 Yii::app()->user->setFlash('success',Yii::t('Inbox','Send_message_ok'));
					 $this->refresh();
				 }
			 }
		 }
		 /****End: Inbox send msg*******/

		 /****Begin: add it to my contact*******/
		 $modelContact=new Contact;
		 $modelContact->uid_parent = Yii::app()->user->id;
		 $modelContact->uid_child = $uid;
		 $this->performAjaxValidation($modelContact);


		 $check_repeat = $subscribe_status = $subscribe_show = 0;

		 $sql = "select count(id) from contact where  uid_child=".Yii::app()->user->id." or uid_parent=".Yii::app()->user->id;
		 $rs_check_repeat=Yii::app()->db->createCommand($sql)->queryScalar();
		 if($rs_check_repeat > 0)$check_repeat = 1;


		 $sql = "select * from contact where  uid_child=".Yii::app()->user->id." and uid_parent=".$uid;
		 $rs_subscribe=Yii::app()->db->createCommand($sql)->queryRow();
		 if(!empty($rs_subscribe))
		 {
			 $subscribe_status = $rs_subscribe['subscribe'];
			 $subscribe_show = 1;
		 }


		 if(isset($_POST['Contact']))
		 {
			 $modelContact->attributes=$_POST['Contact'];
			 //check myself 
			 if($modelContact->uid_parent == $modelContact->uid_child)
			 {
				 Yii::app()->user->setFlash('errorContact',Yii::t('User','add_yourselves'));
				 $this->refresh();
			 }
			 //check repeat
			 $sql="select count(id) from contact
				 where (uid_parent=".$modelContact->uid_parent." and uid_child=".$modelContact->uid_child.") 
				 or (uid_parent=".$modelContact->uid_child." and uid_child=".$modelContact->uid_parent.")";
			 $rs_1=Yii::app()->db->createCommand($sql)->queryScalar();
			 if($rs_1 > 0)
			 {
				 Yii::app()->user->setFlash('errorContact',"We are already connected on MRT.");
				 $this->refresh();
			 }
			 $uid_child_info = User::model()->findByPk($modelContact->uid_child);
			 $uid_child_info_arr = $uid_child_info->attributes;
			 $modelContact->type = $uid_child_info_arr['type'] == 2 ? 7 : 1;
			 //save
			 if($modelContact->save())
			 {
				 $type = Yii::app()->user->type == 2 ? 7 : 1;
				 $sql="insert into contact (uid_parent,uid_child,type) values(".$modelContact->uid_child.",".$modelContact->uid_parent.",".$type.")";
				 if(Yii::app()->db->createCommand($sql)->query())
				 {
					 Yii::app()->user->setFlash('successContact',"We are now connected on MRT.");
					 $this->refresh();
				 }else{
					 $sql="delete from contact 
						 where (uid_parent=".$modelContact->uid_parent." and uid_child=".$modelContact->uid_child.") 
						 or (uid_parent=".$modelContact->uid_child." and uid_child=".$modelContact->uid_parent.")";
					 Yii::app()->db->createCommand($sql)->query();

					 Yii::app()->user->setFlash('errorContact',Yii::t('User','add_yourselves'));
					 $this->refresh();
				 }
			 }
		 }
		 /****End: add it to my contact*******/

		 $dataProvider=new CActiveDataProvider('Property',array(
					 'criteria'=>array(
						 'condition'=>' non_listing = 0 and uid='.$uid,
						 ),
					 'pagination'=>array(
						 'pageSize'=>5
						 ),
					 ));
		 $userType = Yii::app()->user->type;
		 $this->render('r_otherview',array(
					 'model'=>$model,'modelContact'=>$modelContact,'check_repeat'=>$check_repeat,'dataProvider'=>$dataProvider,'subscribe_show'=>$subscribe_show,
					 'userType'=>$userType,
					 'hidden_to_uid'=>$hidden_to_uid,'modelInbox'=>$modelInbox,'realtor_uid'=>$uid,'subscribe_status'=>$subscribe_status,
					 ));
	 }

	 public function actionNewsletter()
	 {
		 $uid = Yii::app()->user->id;
		 if(isset($_GET['realtor_uid']) && !empty($_GET['realtor_uid']))
		 {
			 $realtor_uid=$_GET['realtor_uid'];
			 $status=isset($_GET['status']) && $_GET['status']==1 ? 1 : 0;
			 if($uid == $realtor_uid)
			 {
				 echo 3;exit;
			 }

			 $sql="select * from contact where uid_parent=".$realtor_uid." and uid_child=".$uid;
			 $rs=Yii::app()->db->createCommand($sql)->queryRow();
			 if(!empty($rs))
			 {
				 $sql="update contact set subscribe={$status} where uid_parent=".$realtor_uid." and uid_child=".$uid;
				 Yii::app()->db->createCommand($sql)->execute();
				 echo 1;exit;
			 }else{
				 echo 4;exit;
			 }

		 }else{
			 echo 2;exit;
		 }
	 }
	 public function actionUnsubscrible()
	 {
		 if(isset($_GET['rid']) && isset($_GET['cid']) && isset($_GET['fid']))
		 {
			 $uid_parent=intval($_GET['rid']);
			 $uid_child=intval($_GET['cid']);
			 $fid= $_GET['fid'] == 'c' ? 'c' : 'p';

			 if(!in_array($fid,array('c','p')))
			 {
				 echo '<script>alert("Unsubscrible failed");location.href="/user";</script>';
				 exit;
			 }
			 if($uid_parent > 0 && $uid_child > 0)
			 {

				 if($fid == 'c')
				 {
					 if(Yii::app()->user->id > 0 && Yii::app()->user->id == $uid_child)
					 {
						 $sql="update contact set subscribe=0 where uid_parent=".$uid_parent." and uid_child=".$uid_child;
					 }else{
						 echo '<script>alert("Please login");location.href="/user";</script>';
						 exit;
					 }
				 }
				 if($fid == 'p')
				 {
					 $sql="update prospects set subscribe=0 where uid_parent=".$uid_parent." and uid=".$uid_child;
				 }
				 if(Yii::app()->db->createCommand($sql)->execute() > 0)
				 {
					 echo '<script>alert("Unsubscrible successful");location.href="/user";</script>';
					 exit;
				 }else{
					 echo '<script>alert("Unsubscrible failed");location.href="/user";</script>';
					 exit;
				 }

			 }else{
				 echo '<script>alert("Unsubscrible failed");location.href="/user";</script>';
				 exit;
			 }
		 }else{
			 echo '<script>alert("Unsubscrible failed");location.href="/user";</script>';
			 exit;
		 }
	 }


	 public function actionCindex()
	 {
		 $uid = Yii::app()->user->id;
		 if(isset($_GET['uid']) && !empty($_GET['uid'])) $uid=$_GET['uid'];
		 $model=$this->loadModel($uid);

		 //favorite
		 $sql = "select property.property_id as id,property.*,property_id_table.property_id from (select property_id from favorite where uid=".$uid.") as property_id_table 
			 left join property on property_id_table.property_id=property.property_id where property.non_listing = 0";
		 $rs_1=Yii::app()->db->createCommand($sql)->queryAll();
		 $count=count($rs_1);
		 $dataProvider=new CSqlDataProvider($sql, array(
					 'totalItemCount'=>$count,
					 'sort'=>array(
						 'attributes'=>array(
							 'price','lot_size','pool','house_size'
							 ),
						 ),
					 'pagination'=>array(
						 'pageSize'=>10,
						 ),
					 ));

		 //share_non_listing
		 $sql = "select property.property_id as id,property.*,property_id_table.property_id from (select property_id from share_non_listing where uid=".$uid.") as property_id_table
			 left join property on property_id_table.property_id=property.property_id where property.non_listing=1";
		 $rs_1=Yii::app()->db->createCommand($sql)->queryAll();
		 $count=count($rs_1);
		 $dataProviderShare=new CSqlDataProvider($sql, array(
					 'totalItemCount'=>$count,
					 'sort'=>array(
						 'attributes'=>array(
							 'price','lot_size','pool','house_size'
							 ),
						 ),
					 'pagination'=>array(
						 'pageSize'=>10,
						 ),
					 ));

		 $this->render('c_index',array(
					 'model'=>$model,'dataProvider'=>$dataProvider,'dataProviderShare'=>$dataProviderShare
					 ));
	 }
	 public function actionCnonlisting()
	 {
		 $model=$this->loadModel(Yii::app()->user->id);
		 $rsModel = self::actionRleft();

		 //init non-listing
		 $dataProvider=new CActiveDataProvider('Property',array(
					 'criteria'=>array(
						 'condition'=>'uid='.Yii::app()->user->id.' and mrt_status=0 and non_listing=1',
						 ),
					 'sort'=>array(
						 'defaultOrder'=>'update_date DESC',
						 ),
					 'pagination'=>array(
						 'pageSize'=>5
						 ),
					 ));
		 $this->render('r_nonlisting',array(
					 'model'=>$model,'dataProvider'=>$dataProvider,
					 ));
	 }
	 public function actionCotherview()
	 {
		 //$uid = Yii::app()->user->id;
		 if(isset($_GET['uid']) && !empty($_GET['uid'])) $uid=$_GET['uid'];
		 $model=$this->loadModel($uid);

		 /*******Begin favorite*********/
		 $sql = "select property.property_id as id,property.*,property_id_table.property_id from (select property_id from favorite where uid=".$uid.") as property_id_table 
			 left join property on property_id_table.property_id=property.property_id";
		 $rs_1=Yii::app()->db->createCommand($sql)->queryAll();
		 $count=count($rs_1);
		 $dataProvider_favorites=new CSqlDataProvider($sql, array(
					 'totalItemCount'=>$count,
					 'sort'=>array(
						 'attributes'=>array(
							 'price','lot_size','pool','house_size'
							 ),
						 ),
					 'pagination'=>array(
						 'pageSize'=>10,
						 ),
					 ));
		 /*******End favorite*********/


		 $dataProvider_expenses=null;
		 if(!empty(Yii::app()->user->id))
		 {
			 $dataProvider_expenses=new CActiveDataProvider('ClientExpense',array(
						 'criteria'=>array('condition'=>'realtor_uid='.Yii::app()->user->id.' and client_uid='.$uid),
						 'sort'=>array('defaultOrder'=>'add_date DESC',),
						 'pagination'=>array('pageSize'=>25),
						 ));
		 }

		 $dataProvider_notes=null;
		 if(!empty(Yii::app()->user->id))
		 {
			 $dataProvider_notes=new CActiveDataProvider('ClientNotes',array(
						 'criteria'=>array('condition'=>'realtor_uid='.Yii::app()->user->id.' and client_uid='.$uid),
						 'sort'=>array('defaultOrder'=>'add_date DESC',),
						 'pagination'=>array('pageSize'=>10),
						 ));
		 }


		 /*******Begin client expense*********/
		 $check_repeat = $expense_total= 0;
		 $modelClientExpense=new ClientExpense;
		 $sql = "select count(id) from contact where  uid_child=".$uid." and uid_parent=".Yii::app()->user->id;
		 $rs_1=Yii::app()->db->createCommand($sql)->queryScalar();
		 if($rs_1 > 0)
		 {
			 $check_repeat = 1;

			 /******Begin: assign type*******/
			 $modelContact=Contact::model()->findByAttributes(array("uid_parent"=>Yii::app()->user->id,"uid_child"=>$uid));
			 if(isset($_POST['Contact']))
			 {
				 $modelContact->attributes=$_POST['Contact'];
				 if($modelContact->save())
				 {
					 //$this->redirect('/user/cotherview?uid='.$uid);
					 // 					Yii::app()->user->setFlash('successClientExpense','Save successful');
					 $this->refresh();
					 Yii::app()->end();
				 }

			 }
			 /******End: assign type*******/

			 /******Begin: expense*******/
			 $sql = "select sum(total) as expense_total from client_expense where realtor_uid=".Yii::app()->user->id." and client_uid=".$uid;
			 $expense_total=Yii::app()->db->createCommand($sql)->queryScalar();

			 $sql = "select * from client_expense where realtor_uid=".Yii::app()->user->id." and client_uid=".$uid;
			 $expense_list=Yii::app()->db->createCommand($sql)->queryRow();

			 $modelClientExpense->realtor_uid = Yii::app()->user->id;
			 $modelClientExpense->client_uid = $uid;
			 $modelClientExpense->advertising = '';
			 $modelClientExpense->gas = '';
			 $modelClientExpense->meals = '';
			 $modelClientExpense->others = '';

			 if(isset($_POST['ClientExpense']))
			 {
				 $temp = $_POST['ClientExpense'];
				 if(!empty($temp['id']))$modelClientExpense = ClientExpense::model()->findByPk($temp['id']);
				 $modelClientExpense->attributes=$temp;
				 $modelClientExpense->advertising = !is_numeric($modelClientExpense->advertising) ? str_replace(',', '', $modelClientExpense->advertising) : $modelClientExpense->advertising;
				 $modelClientExpense->gas = !is_numeric($modelClientExpense->gas) ? str_replace(',', '', $modelClientExpense->gas) : $modelClientExpense->gas;
				 $modelClientExpense->meals = !is_numeric($modelClientExpense->meals) ? str_replace(',', '', $modelClientExpense->meals) : $modelClientExpense->meals;
				 $modelClientExpense->others = !is_numeric($modelClientExpense->others) ? str_replace(',', '', $modelClientExpense->others) : $modelClientExpense->others;

				 $modelClientExpense->total = $modelClientExpense->total + intval($modelClientExpense->advertising) + intval($modelClientExpense->gas) + intval($modelClientExpense->meals) + intval($modelClientExpense->others);

				 if($modelClientExpense->total == 0)
				 {
					 // 					Yii::app()->user->setFlash('successClientExpense','');
					 $this->refresh();
					 Yii::app()->end();
				 }
				 if($modelClientExpense->total != 0 && $modelClientExpense->save())
				 {
					 Yii::app()->user->setFlash('showExpenseList',1);
					 $this->refresh();
					 Yii::app()->end();
				 }
			 }
			 /******End: expense*******/

			 /******Begin: ClientNotes*******/
			 $modelClientNotes=new ClientNotes;
			 if(isset($_POST['ClientNotes']))
			 {
				 $modelClientNotes->attributes=$_POST['ClientNotes'];
				 $modelClientNotes->realtor_uid = Yii::app()->user->id;
				 $modelClientNotes->client_uid = $uid;
				 $modelClientNotes->add_date = date('Y-m-d H:i:s',time());
				 if($modelClientNotes->save())
				 {
					 Yii::app()->user->setFlash('showNoteList',2);
					 $this->refresh();
					 Yii::app()->end();
				 }
			 }
			 /******End: ClientNotes*******/

		 }
		 /*******End client expense*********/
		 Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/datepicker/WdatePicker.js');
		 $this->render('c_otherview',array(
					 'model'=>$model,'modelClientExpense'=>$modelClientExpense,'realtor_uid'=>Yii::app()->user->id,'client_uid'=>$uid,
					 'dataProvider_favorites'=>$dataProvider_favorites,'dataProvider_expenses'=>$dataProvider_expenses,'dataProvider_notes'=>$dataProvider_notes,
					 'expense_total'=>$expense_total,'check_repeat'=>$check_repeat,'modelContact'=>$modelContact,'modelClientNotes'=>$modelClientNotes,
					 ));
	 }
	 public function actionCupdate()
	 {
		 $uid = Yii::app()->user->id;
		 if(isset($_GET['uid']) && !empty($_GET['uid'])) $uid=$_GET['uid'];
		 $model=$this->loadModel($uid);

		 if(isset($_POST['User']))
		 {
			 $logo_old = $model->logo;
			 $pwd_old = $model->pwd;
			 $model->attributes=$_POST['User'];
			 $model->type = $_POST['type'];
			 $model->pwd = $model->repwd = $pwd_old;
			 $model->logo = isset($_POST['hidden_logo']) ? $_POST['hidden_logo'] : $logo_old;

			 if($model->save())
			 {
				 Yii::app()->user->setFlash('success',Yii::t('User','edit_profile_ok'));
				 $this->redirect(array('cupdate'));
				 Yii::app()->end();
			 }
		 }

		 $this->render('c_update',array(
					 'model'=>$model
					 ));
	 }

	 /**
	  * Manages all models.
	  */
	 public function actionSearch()
	 {
		 $model=new User('search');
		 $model->unsetAttributes();
		 if(isset($_GET['User']))
		 {
			 $criteria = new CDbCriteria();
			 $criteria->select 		= " * ";
			 // 			$criteria->order        = ' t.status DESC,t.uid ASC';

			 $attributes=$_GET['User'];		
			 $criteria->compare('type',2);						
			 if($attributes['first_name']!='') $criteria->compare('first_name',$attributes['first_name'],true);
			 if($attributes['last_name']!='') $criteria->compare('last_name',$attributes['last_name'],true);
			 if($attributes['broker']!='') $criteria->compare('broker',$attributes['broker'],true);
			 if($attributes['team']!='') $criteria->compare('team',$attributes['team'],true);
			 if($attributes['state']!='') $criteria->compare('state',$attributes['state'],true);
			 if($attributes['city']!='') $criteria->compare('city',$attributes['city'],true);

			 $dataProvider=new CActiveDataProvider('User', array(
						 'criteria'=>$criteria,
						 'pagination'=>array(
							 'pageSize'=>20,
							 ),
						 ));
			 $this->render('r_list',array('dataProvider'=>$dataProvider));exit;
		 }
		 $this->render('_search',array('model'=>$model));
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
		 if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		 {
			 echo CActiveForm::validate($model);
			 Yii::app()->end();
		 }
	 }
	 public static function getUserInfo($id)
	 {
		 if(!empty($id) && is_numeric($id))
		 {
			 return $this->loadModel($id);
		 }
	 }
	 public function actionLogout()
	 {
		 Yii::app()->user->logout();
		 $this->redirect(Yii::app()->homeUrl);
	 }
}
