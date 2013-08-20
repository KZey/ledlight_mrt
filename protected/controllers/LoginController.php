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
			$modelLogin=new LoginForm;
			$modelLogin->email=$_POST['email'];
			$modelLogin->password=$_POST['password'];
			$modelLogin->rememberMe=isset($_REQUEST['rememberMe']) ? $_REQUEST['rememberMe'] : 0;
			if($modelLogin->validate() && $modelLogin->login()){
				($returnUrl == '/index.php' || $returnUrl == '/' || $returnUrl == '') ?$this->redirect('/user') : $this->redirect($returnUrl);
			}else{
// 				$errors = $modelLogin->getErrors();
// 				CVarDumper::dump($var);
// 				if($modelLogin->hasErrors())
// 				{
// 					$errors = $modelLogin->getErrors();
// 					$msg = empty($errors['email'][0]) ? '' : $errors['email'][0];
// 					$msg .= empty($errors['password'][0]) ? '' : '\n'.$errors['password'][0];
					Yii::app()->user->setFlash('loginError','Email or password is incorrect.');
					$this->redirect($returnUrl);
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
	/**
	 * Displays the login page
	 */
	public function actionRegister()
	{
		/*****regirest form start*****/
        //$type = isset($_GET['type'])?$_GET['type']:2;
		$type = 1;
		$header_class_1 = $type==1 ? 'regirest_form_header_2' : 'regirest_form_header_1';
		$header_class_2 = $type==1 ? 'regirest_form_header_1' : 'regirest_form_header_2';
		
		$modelUser=new User;
		$agentList = array();

		if(isset($_POST['User']))
		{
			$modelUser=new User;
			$modelUser->attributes=$_POST['User'];
			$modelUser->type = 1;
			$pwd = $modelUser->pwd;
			$modelUser->pwd = empty($modelUser->pwd) ? '' : md5($modelUser->pwd);
			$modelUser->repwd = empty($modelUser->repwd) ? '' : md5($modelUser->repwd);
			$modelUser->logo = 'default_logo.png';
				
			if(!empty($modelUser->email))
			{
				if($modelUser->exists("email='".$modelUser->email."'"))
				{
					Yii::app()->user->setFlash('error_email_exists',Yii::t('Login','email_registered'));
				}
			}
			if($modelUser->save())
			{
				//@added by: zp
				//Making the contact relation between the new client and his chosen agent.
				$client_id = $modelUser->attributes['uid'];
				$agent_id  = $_POST['agent'];
				$sql="insert into contact (uid_parent,uid_child, type) values(".$client_id.",".$agent_id.", 7)";
				Yii::app()->db->createCommand($sql)->query();
				$sql="insert into contact (uid_parent,uid_child, type) values(".$agent_id.",".$client_id.", 1)";
				Yii::app()->db->createCommand($sql)->query();

				$model=new LoginForm;
				$model->email=$modelUser->email;
				$model->password=$pwd;
				if($model->validate() && $model->login())
					$this->redirect(array('/user'));
			}
		}else {
			/*
			 * @added by: zp
			 * generate the agent list for register form.
			 */
			$sql="select  uid, first_name, last_name  from user where type =2";
			$rs_1=Yii::app()->db->createCommand($sql)->queryAll();
			$count=count($rs_1);
			for($i=0; $i<$count;$i++) {
				$agentList[$i] = $rs_1[$i];
			}
		}
		/*****regirest form end*****/
		$this->render('register',array('modelUser'=>$modelUser,
			  'agentList'=>$agentList, 'type'=>$type, 'header_class_1'=>$header_class_1,'header_class_2'=>$header_class_2));
	}

	/*
	 * Displays the apply page step 1
	 */
	public function actionApply1()
	{
		$modelApply=new Apply;
		$this->render('apply1',array('modelApply'=>$modelApply));
	}



	/**
	 * Displays the apply page step 2
	 */
	public function actionApply()
	{
		/*****regirest form start*****/
		$modelApply=new Apply;
		if(isset($_POST['Apply']))
		{
			$modelApply=new Apply;
			$modelApply->attributes=$_POST['Apply'];
			$modelApply->add_date = date('Y-m-d',time());

			// 			if(!empty($modelApply->email))
			// 			{
			if(User::model()->exists("email='".$modelApply->email."'"))
			{
				Yii::app()->user->setFlash('error_email_exists',Yii::t('Login','email_registered'));
			}
			else if($modelApply->save())
			{
				//send to agent
				$title = 'MyRealTour : Registration';
				$content = 'Thank you for registering with MRT. Your license verification is in process.  You  will receive a confirmation email with instructions within 24 hours. If you have any questions, please direct them to support@myrealtour.com.
					<br/><br/>
					Sinceryly,<br/>
					Your MRT Admin';
				$returnCode = $this->sendemail("mypropertyxchange@gmail.com","mypropertyxchange@gmail.com",array($modelApply->email),$title,$content,'');

				//send to client team
				$title = 'MyRealTour:apply agent';
				$content = 'Someone applied agent account on MyRealTour.<br/><br/>MyRealTour Team';
				$returnCode = $this->sendemail("mypropertyxchange@gmail.com","mypropertyxchange@gmail.com",array(APPLY_TO_EMAIL),$title,$content,'');

				$this->redirectMsg('/login/apply3','Billing infomation page',$msg='Thanks.We will view your apply on MyRealTour as soon as possible.<br/><br/>MyRealTour Team');
				exit;
			}
			// 			}
		}
		/*****regirest form end*****/
		$this->render('apply',array('modelApply'=>$modelApply));
	}	



	/**
	 * Displays the apply page step 3
	 */	
	public function actionApply3()
	{
		$modelApply=new Apply;
		/*
		   With this way, use apply3_back.php
		//Yii::import('application.vendors.*');
		//require_once ('anet_php_sdk/AuthrizeNet.php'); 
		 */
		$this->render('apply3',array('modelApply'=>$modelApply));
	}


	/*
	 * 
	 * Store the billing information 
	 *
	 */
	public function actionStorebilling()
	{
		Yii::import('application.vendors.*');
		require_once ('billing/authnetfunction.php');
		require_once ('billing/data.php');

		$amount = $_POST["amount"];
		$refId = $_POST["refId"];
		$name = $_POST["name"];
		$length = $_POST["length"];
		$unit = $_POST["unit"];
		$startDate = $_POST["startDate"];
		$totalOccurrences = $_POST["totalOccurrences"];
		$trialOccurrences = $_POST["trialOccurrences"];
		$trialAmount = $_POST["trialAmount"];
		$cardNumber = $_POST["cardNumber"];
		$expirationDate = $_POST["expirationDate"];
		$firstName = $_POST["firstName"];
		$lastName = $_POST["lastName"];


		//build xml to post
		$content =
			"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
			"<ARBCreateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
			"<merchantAuthentication>".
			"<name>" . $loginname . "</name>".
			"<transactionKey>" . $transactionkey . "</transactionKey>".
			"</merchantAuthentication>".
			"<refId>" . $refId . "</refId>".
			"<subscription>".
			"<name>" . $name . "</name>".
			"<paymentSchedule>".
			"<interval>".
			"<length>". $length ."</length>".
			"<unit>". $unit ."</unit>".
			"</interval>".
			"<startDate>" . $startDate . "</startDate>".
			"<totalOccurrences>". $totalOccurrences . "</totalOccurrences>".
			"<trialOccurrences>". $trialOccurrences . "</trialOccurrences>".
			"</paymentSchedule>".
			"<amount>". $amount ."</amount>".
			"<trialAmount>" . $trialAmount . "</trialAmount>".
			"<payment>".
			"<creditCard>".
			"<cardNumber>" . $cardNumber . "</cardNumber>".
			"<expirationDate>" . $expirationDate . "</expirationDate>".
			"</creditCard>".
			"</payment>".
			"<billTo>".
			"<firstName>". $firstName . "</firstName>".
			"<lastName>" . $lastName . "</lastName>".
			"</billTo>".
			"</subscription>".
			"</ARBCreateSubscriptionRequest>";


		//send the xml via curl
		$response = send_request_via_curl($host,$path,$content);
		//if curl is unavilable you can try using fsockopen
		/*
		   $response = send_request_via_fsockopen($host,$path,$content);
		 */


		//if the connection and send worked $response holds the return from Authorize.net
		if ($response)
		{
			/*
			   a number of xml functions exist to parse xml results, but they may or may not be avilable on your system
			   please explore using SimpleXML in php 5 or xml parsing functions using the expat library
			   in php 4
			   parse_return is a function that shows how you can parse though the xml return if these other options are not avilable to you
			 */
			list ($refId, $resultCode, $code, $text, $subscriptionId) =parse_return($response);


			$html = 
				" Response Code: $resultCode <br>"
				. " Response Reason Code: $code<br>"
				. " Response Text: $text<br>"
				. " Reference Id: $refId<br>"
				. " Subscription Id: $subscriptionId <br><br>"
				. " Data has been written to data.log<br><br>"
				. $loginname
				. "<br />"
				. $transactionkey
				. "<br />"

				. "amount:"
				. $amount
				. "<br \>"

				. "refId:"
				. $refId
				. "<br \>"

				. "name:"
				. $name
				. "<br \>"

				. "amount: "
				. $_POST["amount"]
				. "<br \>"
				. "<br \>"
				. $content
				. "<br \>"
				. "<br \>";

			/*
			   $fp = fopen('data.log', "a");
			   fwrite($fp, "$refId\r\n");
			   fwrite($fp, "$subscriptionId\r\n");
			   fwrite($fp, "$amount\r\n");
			   fclose($fp);
			 */

			if($resultCode == 'Error')
				//Display the error
				$html = '<b>Error</b>: '.$text.'<br/><br/>Please go back and check your information.';
			else if($resultCode == 'Ok'){
				//start the save in the database job
				$html = 'Thanks for applying for a MyRealTour Agent account!<br/><br/> 
					One of our agents will review your information and verfiy your Agent license. You should be receiving a confirmation email within the next 24-48 hours.';
			}

		}
		else
		{
			$html =  "Transaction Failed, please contact the site admin. <br>";
		}


		$this->render('storebilling',array(
					'content'=>$html,
					));

	}






	public function actionForgetpwd()
	{
		$model=new User;
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if(empty($model->email))
			{
				Yii::app()->user->setFlash('error',Yii::t('Login','input_email'));
				// 				$this->redirect(array('forgetpwd'));
				$this->refresh();
			}
			$checkEmail = User::model()->find("email='".$model->email."'");
			if(empty($checkEmail))
			{
				Yii::app()->user->setFlash('error',Yii::t('Login','email_exist'));
				$this->refresh();
			}
			$forgetpwd = md5($model->email.time());
			$model->forgetpwd = $forgetpwd;

			$sql = "update user set forgetpwd='{$forgetpwd}' where uid={$checkEmail->uid}";
			$rs = Yii::app()->db->createCommand($sql)->query();
			if($rs)
			{
				$link = Yii::app()->request->hostInfo.'/login/setpwd?fid='.$forgetpwd;

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
				$this->redirect(array('forgetpwd','a'=>1));
			}
		}

		$this->render('forgetpwd',array('model'=>$model));
	}
	public function actionSetpwd()
	{
		$modelUser=new User;
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
			$checkEmail = User::model()->find("forgetpwd='".$fid."'");
			if(empty($checkEmail))
			{
				Yii::app()->user->setFlash('error',Yii::t('Login','link_invalid'));
				$returnCode = 2;
			}
			$modelUser->forgetpwd = $fid;

			//submit form
			if(isset($_POST['User']))
			{

				$modelUser->attributes=$_POST['User'];
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
				$sql = "update user set pwd='{$modelUser->pwd}',register_status=0,forgetpwd='' where forgetpwd='{$modelUser->forgetpwd}'";
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


	public function actionTerms()
	{
		$this->render('terms'); 
	}

	public function actionPolicy()
	{
		$this->render('policy');
	}

}
