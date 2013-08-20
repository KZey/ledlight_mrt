<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $email;
	public $password;
	public $push_id;
	public $rememberMe = 0;
// 	public $verifyCode;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
    public function rules()
	{
		return array(
			// email and password are required
			array('email, password', 'required'),
			array('email','email'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),	
			//array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
			
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
    public function attributeLabels()
	{
		return array(
// 			'rememberMe'    =>Yii::t('public',"Remember me next time"),
			'email'      =>Yii::t('public',"Email"),
			'password'      =>Yii::t('public',"Password"),
// 			'verifyCode'    =>Yii::t('public', 'Verification Code')
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
    public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			$identity=new UserIdentity($this->email,$this->password);
			$identity->authenticate();
			switch($identity->errorCode)
			{
				case UserIdentity::ERROR_NONE:
					$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
					Yii::app()->user->login($identity,$duration);
					break;
				case UserIdentity::ERROR_EMAIL_INVALID:
					$this->addError("status",Yii::t('public',"Email is incorrect."));
					break;
				case UserIdentity::ERROR_EMAIL_INVALID:
					$this->addError("email",Yii::t('public',"Email is incorrect."));
					break;
				case UserIdentity::ERROR_STATUS_NOTACTIVE:
					$this->addError("email",Yii::t('public',"You account is not activated."));
					break;
				case UserIdentity::ERROR_STATUS_BANNED:
					$this->addError("status",Yii::t('public', 'You account is activated.'));
					break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError("password",Yii::t('public', "Password is incorrect."));
					break;
				case UserIdentity::ERROR_ACCOUNT_NOT_ALLOW:
					$this->addError("password",Yii::t('public', "You account does not allow login."));
					break;
				case UserIdentity::ERROR_OTHER:
					$this->addError("email",Yii::t('public', "You account has an error."));
					break;
			}
		}
	}

	/**
	 * Logs in the user using the given email and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
