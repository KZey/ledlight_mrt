<?php

class LoginController extends Controller
{
	public $layout='column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
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


	public function actionLogin()
	{
		/*****Login form start*****/
		if(Yii::app()->user->isGuest)
		{
			$returnUrl=Yii::app()->user->returnUrl;
			$modelLogin=new AdminLogin;
			$modelLogin->email=$_POST['email'];
			$modelLogin->password=$_POST['password'];
			$modelLogin->rememberMe=isset($_REQUEST['rememberMe']) ? $_REQUEST['rememberMe'] : 0;
			if($modelLogin->validate() && $modelLogin->login()){
// 				($returnUrl == '/admin.php' || $returnUrl == '/' || $returnUrl == '') ?$this->redirect('/user') : $this->redirect($returnUrl);
				$this->redirect('/'.BACKEND_ENTRY_NAME.'/apply/admin');
// 				echo 1111;exit;
			}else{
// 				echo 222;exit;
// 				$errors = $modelLogin->getErrors();
// 				CVarDumper::dump($var);
// 				if($modelLogin->hasErrors())
// 				{
// 					$errors = $modelLogin->getErrors();
// 					$msg = empty($errors['email'][0]) ? '' : $errors['email'][0];
// 					$msg .= empty($errors['password'][0]) ? '' : '\n'.$errors['password'][0];
					Yii::app()->user->setFlash('loginError','Email or password is incorrect.');
					$this->redirect('/'.BACKEND_ENTRY_NAME);
					Yii::app()->end();
// 				}
			} 
		}
		/*****Login form end*****/
	}
	/**
	 * Displays the login page
	 */
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionForgetpwd()
	{
		$model=new Manager;
		if(isset($_POST['Manager']))
		{
			$model->attributes=$_POST['Manager'];
			if(empty($model->email))
			{
				Yii::app()->user->setFlash('error',Yii::t('Login','input_email'));
// 				$this->redirect(array('forgetpwd'));
				$this->refresh();
			}
			$checkEmail = Manager::model()->find("email='".$model->email."'");
			if(empty($checkEmail))
			{
				Yii::app()->user->setFlash('error',Yii::t('Login','email_exist'));
				$this->refresh();
			}
			$forgetpwd = md5($model->email.time());
			$model->forgetpwd = $forgetpwd;
			
			$sql = "update Manager set forgetpwd='{$forgetpwd}' where uid={$checkEmail->uid}";
			$rs = Yii::app()->db->createCommand($sql)->query();
			if($rs)
			{
				$link = Yii::app()->request->hostInfo.'/'.BACKEND_ENTRY_NAME.'/login/setpwd?fid='.$forgetpwd;
				
				//start send email
				$fromEmail = 'mypropertyxchange@gmail.com';
				$fromName = 'mypropertyxchange@gmail.com';
				$toEmailArrary = array($model->email);
				$title = 'MRT:please set your password.';
				$content = '<div style="font-size:20px;font-weight:bold;">MyRealTour</div><br/><br/>'.
								Yii::t('Login','sendemail_content_1')
								.'<br/><br/>
								<a href="'.$link.'">'.$link.'</a><br/><br/>
								'.Yii::t('Login','sendemail_content_3').'<br/><br/>
								'.Yii::t('Login','sendemail_content_2').'<br/>';
				$attachment = '';
				//$mrtSendMail = new MrtSendMail();
				$returnCode = $this->sendemail($fromEmail,$fromName,$toEmailArrary,$title,$content,$attachment);
				switch ($returnCode)
				{
					case 1:
						Yii::app()->user->setFlash('success',Yii::t('Login','tip_sendemail_ok'));
						//$this->refresh();
						break;
					case 2:
						Yii::app()->user->setFlash('error',Yii::t('Login','fileds_blank'));
						$this->refresh();
						break;
					default:
						Yii::app()->user->setFlash('error',Yii::t('Login','email_failed').$returnCode);
						$this->refresh();
						//break;
				}
				//end
				$this->redirect('/'.BACKEND_ENTRY_NAME.'/login/forgetpwd');
			}
		}
		
		$this->render('forgetpwd',array('model'=>$model));
	}
	public function actionSetpwd()
	{
		$modelUser=new Manager;
		$returnCode = 0;
		$a = isset($_GET['a']) ? $_GET['a'] : 0;
		if($a != 1)
		{
			$fid = $_GET['fid'];
			if(empty($fid))
			{
				Yii::app()->user->setFlash('error',Yii::t('Login','link_invalid'));
				$returnCode = 1;
			}
			//check the forgetpwd
			$checkEmail = Manager::model()->find("forgetpwd='".$fid."'");
			if(empty($checkEmail))
			{
				Yii::app()->user->setFlash('error',Yii::t('Login','link_invalid'));
				$returnCode = 2;
			}
			$modelUser->forgetpwd = $fid;
			
			//submit form
			if(isset($_POST['Manager']))
			{
				
				$modelUser->attributes=$_POST['Manager'];
				if(empty($modelUser->pwd) || empty($modelUser->repwd))
				{
					Yii::app()->user->setFlash('error',Yii::t('Login','input_pwd'));
					$this->refresh();
				}
				if($modelUser->pwd !== $modelUser->repwd)
				{
					Yii::app()->user->setFlash('error',Yii::t('Login','password_same'));
					$this->refresh();
				}
				
				$modelUser->pwd = md5($modelUser->pwd);
				$modelUser->repwd = md5($modelUser->repwd);
				$sql = "update Manager set pwd='{$modelUser->pwd}',forgetpwd='' where forgetpwd='{$modelUser->forgetpwd}'";
				$rs = Yii::app()->db->createCommand($sql)->query();
				if($rs)
				{
					Yii::app()->user->setFlash('success',Yii::t('Login','reset_password_ok'));
					$returnCode = 3;
					//$this->refresh();
					$this->redirect(array('setpwd','a'=>1));
				}
			}
		}else{
			$returnCode = 3;
		}
		$this->render('setpwd',array('modelUser'=>$modelUser,'returnCode'=>$returnCode));
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}