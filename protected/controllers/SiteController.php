<?php
class SiteController extends FrontController
{
	private $_model;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
// 			'captcha'=>array(
// 				'class'=>'CCaptchaAction',
// 				'backColor'=>0xFFFFFF,
// 			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	public function actionGetLoginToken()
	{
		$token = array('logintoken'=> Yii::app()->getRequest()->getCsrfToken());
		echo json_encode($token);
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$msgLogin = array("LoginSuccess"=>1,"LoginERROR"=>2,"LoginNoPushId"=>3,"Logined"=>4);
		//if(Yii::app()->user->isGuest)
		//{
		
			$model=new LoginForm;
			
				//$model->attributes=$_POST['LoginForm'];
				$LoginForm = array();
				$LoginForm['email'] = $_REQUEST['username'];
				$LoginForm['password'] = $_REQUEST['password'];
				$LoginForm['push_id'] = $_REQUEST['push_id'];
				$model->attributes=$LoginForm;
				
				$sql = "update user set push_id='{$LoginForm['push_id']}' where push_id = '".$LoginForm['push_id']."'";
				$rs = Yii::app()->db->createCommand($sql)->query();
				
// 				echo '<pre>';var_dump($LoginForm);echo '</pre>';
// 				echo '<pre>';var_dump($model->attributes);echo '</pre>';
				
				if($model->validate())
				{
					$modelUser=$this->loadModel();
					//$modelUser->attributes=$LoginForm;
					
					$sql = "update user set push_id='{$LoginForm['push_id']}' where email = '".$LoginForm['email']."'";
					$rs = Yii::app()->db->createCommand($sql)->query();
					if($rs)
					//if($modelUser->save())
					{	
						//echo json_encode($msgLogin['LoginSuccess']);
						$sql = "select uid,email,first_name,last_name from user where email = '".$LoginForm['email']."'";
						//echo $sql;
						$command = Yii::app()->db->createCommand($sql);
						$userContact_1 = $command->queryRow();
						//echo $sql;	
						//echo '<pre>';var_dump($userContact_1);echo '</pre>';
						$aa = array("returncode"=>1,$userContact_1);
						$userContact_2 = json_encode($aa);
						echo $userContact_2;
						
					}else{
						echo json_encode(array("returncode"=>3));
					}
				}else{
					echo json_encode(array("returncode"=>2));
				}
				exit;
		//}
		//else
		//{
		//	echo 4;//logined
		//	exit;
		//}
	}
	
	/**
	 * Function Name: Forgetpwd
	 * Description  : Forgetpwd for ios
	 * Params       : email
	 * Method way   : POST or get
	 * Return       : 1:email is blank   2: email is not exists  3:send email successful 4:send email failed
	 * Note         : 
	 * API url      : http://mrt.synovainteractive.com/site/Forgetpwd
	 */
	public function actionForgetpwd()
	{
			$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
			if(empty($email))
			{
				echo json_encode(array("returncode"=>1));//email is blank
				Yii::app()->end();
			}
			
			$checkEmail = User::model()->find("email='".$email."'");
			if(empty($checkEmail))
			{
				echo json_encode(array("returncode"=>2));//email is not exists
				Yii::app()->end();
			}
			
			$forgetpwd = md5($email.time());
			$sql = "update user set forgetpwd='{$forgetpwd}' where uid={$checkEmail->uid}";
			$rs = Yii::app()->db->createCommand($sql)->query();
			if($rs)
			{
				$link = Yii::app()->request->hostInfo.'/login/setpwd?fid='.$forgetpwd;
	
				//start send email
				$fromEmail = 'mypropertyxchange@gmail.com';
				$fromName = 'mypropertyxchange@gmail.com';
				$toEmailArrary = array($email);
				$title = 'MRT:please set your password.';
				$content = '<div style="font-size:20px;font-weight:bold;">MyRealTour</div><br/><br/>'.
						Yii::t('Login','sendemail_content_1')
						.'<br/><br/>
								<a href="'.$link.'">'.$link.'</a><br/><br/>
								'.Yii::t('Login','sendemail_content_3').'<br/><br/>
								'.Yii::t('Login','sendemail_content_2').'<br/>';
				$returnCode = $this->sendemail($fromEmail,$fromName,$toEmailArrary,$title,$content,'');
				if($returnCode == 1)
				{
					echo json_encode(array("returncode"=>3));//send email successful
					Yii::app()->end();
				}else{
					echo json_encode(array("returncode"=>4));//send email failed
					Yii::app()->end();
				}
			}
	}
	
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
				$this->_model=User::model()->findbyPk(Yii::app()->user->id);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		if(!empty(Yii::app()->user->id))
		{
			$sql = "update user set push_id='' where uid = ".Yii::app()->user->id;
			$rs = Yii::app()->db->createCommand($sql)->query();
		}
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->homeUrl);
	}
}