<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	protected $_view = array();
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function redirectMsg($to_url,$page_name,$msg='')
	{
		$this->render('/layouts/msg',array('to_url'=>$to_url,'page_name'=>$page_name,'msg'=>$msg));
	}
	
	public function render($view,$data=null,$return=false)
	{
		CHtml::$afterRequiredLabel = ' <span class="required">*</span>';
		if($data===null) $data=$this->_view;
		if($return)
			return parent::render($view, $data, $return);
		else
			parent::render($view, $data, $return);
	}
	public function sendemail($fromEmail,$fromName,$toEmailArrary,$title,$content,$attachment)
	{
		if(empty($fromEmail) || empty($toEmailArrary) || empty($title) || empty($content))return 2;
	
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Username = "mypropertyxchange@gmail.com";
		$mail->Password = "mypropertyxchange";
		$mail->Port=465;
		$mail->IsHTML(true);
	
		$mail->From= $fromEmail;
		$mail->FromName = empty($fromName) ? $fromEmail:$fromName;
	
		if(count($toEmailArrary) > 0)
		{
			for($i=0;$i<count($toEmailArrary);$i++)
			{
				$mail->AddAddress($toEmailArrary[$i]);
			}
		}
		$mail->AddReplyTo($fromEmail);
		if(!empty($attachment))$mail->AddAttachment($attachment);

		$mail->Subject =$title;
		$mail->Body = $content;

		if(!$mail->Send())
		{
		return $mail->ErrorInfo;//send failed
		}
		return 1;//send ok
	}
	public function sendemailHelper($redirect=array('/user'))
	{
		/**********send_email start*************/
		$modelEmail=new Email;
		$hidden_to_uid = '';
		if(isset($_POST['Email']))
		{
			$modelEmail->attributes=$_POST['Email'];
			$modelEmail->send_date = date('Y-m-d H:i:s');
			$modelEmail->from_uid = Yii::app()->user->id;
	
			$cs = Yii::app()->getClientScript();
			$cs->registerScriptFile('/js/jquery.zxxbox.3.0.js');
			$hidden_to_uid = $_POST['hidden_to_uid'];
			if(empty($hidden_to_uid))
			{
				Yii::app()->user->setFlash('errorSendemailTitleto_uid',"Please input a correct client of your contact.");
				//$this->refresh();
				$cs->registerScript('f1',"show_send_email();");
			}
			$modelEmail->setAttribute('to_uid', $hidden_to_uid);
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
			//end
			if($modelEmail->save())
			{
				//start send email
				$fromEmail = Yii::app()->user->name;
				$fromName = Yii::app()->user->name;
				$toUserInfo = User::model()->findByPk($hidden_to_uid);;
				$toEmailArrary = array($toUserInfo->email);
				$title = $modelEmail->title;
				$content = $modelEmail->contents.'<br/>'.str_replace("\n","<br/>",Yii::app()->user->signature);
				$attachment = $modelEmail->attachments;
				$returnCode = $this->sendemail($fromEmail,$fromName,$toEmailArrary,$title,$content,$attachment);
				switch ($returnCode)
				{
					case 1:
						Yii::app()->user->setFlash('successSendemail',"Send email success.");$this->refresh();
// 						$this->redirect($redirect);
						break;
					case 2:
						Yii::app()->user->setFlash('errorSendemail',"Please check out all fileds are not blank.");$this->refresh();
// 						$this->redirect($redirect);
						break;
					default:
						Yii::app()->user->setFlash('errorSendemail',"Send email failed.".$returnCode);$this->refresh();
// 						$this->redirect($redirect);
						//break;
				}
// 				Yii::app()->user->setFlash('success',"Send message successful.");
				$this->refresh();
			}else{
				$cs->registerScript('f1',"show_send_email();");
			}
	
		}
		return array($modelEmail,$hidden_to_uid);
		// 		$this->_view['hidden_to_uid']=$hidden_to_uid;
		// 		$this->_view['modelEmail']=$modelEmail;
		/**********send_email End*************/
	}
	public function getPost($param)
	{
		return isset($param) ? $_REQUEST[$param] : '';
	}
}